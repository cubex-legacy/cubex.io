<?php
/**
 * @author: brooke.bryan
 *        Application: Documentor
 */
namespace CubexIo\Applications\Www\Views;

use Cubex\Container\Container;
use Cubex\Facade\FeatureSwitch;
use Cubex\Form\Form;
use Cubex\Form\FormElement;
use Cubex\Foundation\Config\Config;
use Cubex\View\HtmlElement;
use Cubex\View\Partial;
use Cubex\View\ViewModel;
use CubexIo\Components\Documentor\Mappers\Article;

class Docs extends ViewModel
{
  public function render()
  {

    $showEdit = Container::config()->get("docs", new Config())
    ->getBool("allow_edit", false);
    if(!$showEdit)
    {
      $showEdit = FeatureSwitch::isEnabled("allow_edit", "cookiefsw");
    }

    $pat         = '';
    $parts       = explode('/', $this->request()->path());
    $pathPartial = new Partial('<li><a href="%s">%s</a>%s</li>', null, false);
    foreach($parts as $part)
    {
      if(!empty($part))
      {
        $pat .= '/' . $part;
        $append = '';
        if($pat != $this->request()->path())
        {
          $append = ' <span class="divider">/</span>';
        }
        $pathPartial->addElement(
          $pat,
          ucwords(implode(" ", explode('-', $part))),
          $append
        );
      }
    }

    /**
     * @var $article Article
     */
    $article = Article::loadWhereOrNew(["slug" => $this->request()->path()]);

    $article->slug = $this->request()->path();

    if($showEdit)
    {
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
    }

    $producer = new \Cubex\Remarkup\Producer($article->content);
    $this->setTitle($article->title);

    $output = new HtmlElement("div", ['class' => 'row-fluid']);
    $output->renderBefore(
      new HtmlElement('ul', ['class' => 'breadcrumb'], $pathPartial)
    );
    $regex = $article->conn()->escapeString($article->slug);

    $articles = Article::collection();
    $articles->setColumns(['title', 'slug']);
    $articles->loadWhere("%C REGEXP '^" . $regex . "(.[^/]*)$'", "slug");
    $articles->get();

    $partial = new Partial('<li><a href="%s">%s</a></li>', null, false);
    $partial->addElements($articles->getKeyedArray("slug", ['slug', 'title']));
    $output->nestElement(
      'ul',
      ['class' => 'span2 nav nav-pills nav-stacked'],
      $partial
    );

    $output->nestElement(
      'div',
      ['class' => 'span' . ($showEdit ? 5 : 10), 'id' => 'producer'],
      $producer
    );

    if($showEdit)
    {
      $output->nestElement(
        'div',
        ['class' => 'span5'],
        ('<h3>Update This Page</h3>' . $form->render())
      );
    }

    return $output;
  }
}
