<?php
/**
 * @author: brooke.bryan
 *        Application: Documentor
 */
namespace CubexIo\Applications\Documentor\Views;

use Cubex\Container\Container;
use Cubex\Form\Form;
use Cubex\Form\FormElement;
use Cubex\View\HtmlElement;
use Cubex\View\Impart;
use Cubex\View\Partial;
use Cubex\View\ViewModel;
use CubexIo\Components\Documentor\Mappers\Article;

class Index extends ViewModel
{
  public function render()
  {

    $pat         = '';
    $parts       = explode('/', $this->request()->path());
    $pathPartial = new Partial('<a href="%s">%s</a>');
    $pathPartial->setGlue(" / ");
    foreach($parts as $part)
    {
      if(!empty($part))
      {
        $pat .= '/' . $part;
        $pathPartial->addElement($pat, $part);
      }
    }

    /**
     * @var $article Article
     */
    $article = Article::loadWhereOrNew(
      "%C = %s",
      "slug",
      $this->request()->path()
    );

    $article->slug = $this->request()->path();

    $form = new Form("");
    $form->bindMapper($article);
    $form->get("content")
    ->addAttribute("rows", 15)
    ->addAttribute("class", "span12")
    ->setType(FormElement::TEXTAREA);

    if($form->isValid() && $this->request()->isForm())
    {
      $form->hydrate($this->request()->postVariables());
      $form->saveChanges();
    }

    $producer = new \Cubex\Remarkup\Producer($article->content);
    $this->setTitle($article->title);

    $output = new HtmlElement("div", ['class' => 'row-fluid']);
    $output->renderBefore($pathPartial);
    $output->renderBefore(new Impart("<hr/>"));

    $regex = $article->conn()->escapeString($article->slug);

    $articles = Article::collection();
    $articles->setColumns(['title', 'slug']);
    $articles->loadWhere("%C REGEXP '^" . $regex . "(.[^/]*)$'", "slug");
    $articles->get();

    $partial = new Partial('<li><a href="%s">%s</a></li>', null, false);
    $partial->addElements($articles->getKeyedArray("slug", ['slug', 'title']));
    $output->nestElement('ul', ['class' => 'span2'], $partial);

    $output->nestElement(
      'div',
      ['class' => 'span5', 'id' => 'producer'],
      $producer
    );
    $output->nestElement(
      'div',
      ['class' => 'span5'],
      ('<h3>Update This Page</h3>' . $form->render())
    );

    return $output;
  }
}
