<?php
/**
 * @author: brooke.bryan
 *        Application: Documentor
 */
namespace CubexIo\Applications\Documentor\Controllers;

use Cubex\Core\Controllers\WebpageController;

abstract class BaseController extends WebpageController
{
  public function preProcess()
  {
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

  public function defaultAction()
  {
    return "index";
  }
}
