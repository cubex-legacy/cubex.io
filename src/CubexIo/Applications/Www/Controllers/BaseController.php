<?php
/**
 * @author brooke.bryan
 * @author gareth.evans
 */

namespace CubexIo\Applications\Www\Controllers;

use Cubex\Core\Controllers\WebpageController;
use Cubex\View\Templates\Errors\Error404;
use CubexIo\Applications\Www\Views\Section\MainNav;

abstract class BaseController extends WebpageController
{

  public function preProcess()
  {
    $this->addMeta(
      "google-site-verification",
      "OMmhqGbIMw4L8Es3hOT4fLs_44nBVI3aJ3MsYUCYy6c"
    );
    $this->requireCss(
      "//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/" .
      "bootstrap-combined.min.css"
    );
    $this->requireCss(
      "http://fonts.googleapis.com/css?family=Open+Sans:400,600,700"
    );
    $this->requireCss("/base");
    $this->webpage()->addHeaderElement(
      "<!--[if IE]><script src=\"http://html5shiv.googlecode.com/svn/trunk/" .
      "html5.js\"></script><![endif]-->"
    );
  }

  public function preRender()
  {
    $this->nest("mainNav", new MainNav($this->getRouteResult()));
  }

  public function renderNotFound()
  {
    $this->webpage()->setStatusCode("404");
    return new Error404();
  }

  public function defaultAction()
  {
    return "NotFound";
  }
}
