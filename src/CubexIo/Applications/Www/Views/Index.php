<?php
/**
 * @author brooke.bryan
 * @autho gareth.evans
 */
namespace CubexIo\Applications\Www\Views;

use Cubex\Remarkup\Producer;
use Cubex\View\ViewModel;
use CubexIo\Components\Documentor\Mappers\Article;

class Index extends ViewModel
{
  public function __construct()
  {
    $this->setTitle($this->t("Cubex : Index Page"));
  }

  public function render()
  {
    /**
     * @var $article Article
     */
    $article = Article::loadWhereOrNew(["slug" => '/docs/setup']);
    return new Producer($article->content);
  }
}
