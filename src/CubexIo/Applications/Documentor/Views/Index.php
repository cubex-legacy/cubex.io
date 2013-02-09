<?php
/**
 * @author: brooke.bryan
 *        Application: Documentor
 */
namespace CubexIo\Applications\Documentor\Views;

use Cubex\Container\Container;
use Cubex\Form\Form;
use Cubex\Form\FormElement;
use Cubex\View\ViewModel;
use CubexIo\Components\Documentor\Mappers\Article;

class Index extends ViewModel
{
  public function render()
  {
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
    ->addAttribute("rows", 20)
    ->addAttribute("class", "span10")
    ->setType(FormElement::TEXTAREA);

    if($form->isValid() && $this->request()->isForm())
    {
      $form->hydrate($this->request()->postVariables());
      $form->saveChanges();
    }

    $producer = new \Cubex\Remarkup\Producer($article->content);
    $this->setTitle($article->title);
    return $producer->render() . $form;
  }
}
