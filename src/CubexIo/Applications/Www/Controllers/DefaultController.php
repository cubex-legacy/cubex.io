<?php
/**
 * @author brooke.bryan
 * @author gareth.evans
 */

namespace CubexIo\Applications\Www\Controllers;

use Cubex\Core\Controllers\WebpageController;
use Cubex\View\HtmlElement;
use Cubex\View\Templates\Errors\Error404;
use CubexIo\Applications\Www\Views\Index;

class DefaultController extends WebpageController
{

  public function preProcess()
  {
    $this->requireCss("//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css");
    $this->requireCss("http://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
    $this->requireCss("/base");
  }

  public function renderIndex()
  {
    return new Index();
  }

  public function renderNotFound()
  {
    $this->webpage()->setStatusCode("404");

    return new Error404();
  }

  public function getRoutes()
  {
    return array(
      '/' => 'index'
    );
  }

  public function defaultAction()
  {
    return "notFound";
  }
}
