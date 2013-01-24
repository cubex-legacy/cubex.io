<?php
/**
 * @author brooke.bryan
 * @author gareth.evans
 */

namespace CubexIo\Applications\Www\Controllers;

use Cubex\Core\Controllers\WebpageController;
use Cubex\View\Templates\Errors\Error404;
use CubexIo\Applications\Www\Views\Cubes\Web;
use CubexIo\Applications\Www\Views\Index;
use CubexIo\Applications\Www\Views\Section\CubesNav;
use CubexIo\Applications\Www\Views\Section\MainNav;

class DefaultController extends WebpageController
{

  public function preProcess()
  {
    $this->requireCss(
      "//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combine".
      "d.min.css"
    );
    $this->requireCss(
      "http://fonts.googleapis.com/css?family=Open+Sans:400,600,700"
    );
    $this->requireCss("/base");
    $this->webpage()->addHeaderElement(
      "<!--[if IE]><script src=\"http://html5shiv.googlecode.com/svn/trunk/htm".
      "l5.js\"></script><![endif]-->"
    );
  }

  public function preRender()
  {
    $this->nest("mainNav", new MainNav($this->getRouteResult()));
    $this->nest(
      "cubesNav",
      new CubesNav($this->request(), $this->getRouteResult())
    );
  }

  public function renderIndex()
  {
    return new Index();
  }

  public function renderAbout()
  {
    return null;
  }

  public function renderLearn()
  {
    return null;
  }

  public function renderDocs()
  {
    return null;
  }

  public function renderCommunity()
  {
    return null;
  }

  public function renderCubes($cube)
  {
    switch($cube)
    {
      case 'web':
        return new Web();
    }

    return $this->renderNotFound();
  }

  public function renderNotFound()
  {
    $this->webpage()->setStatusCode("404");

    return new Error404();
  }

  public function getRoutes()
  {
    return array(
      "/(|get-started)"  => "index",
      "/about"           => "about",
      "/learn"           => "learn",
      "/docs"            => "docs",
      "/community"       => "community",
      "/cubes/:cube@all" => "cubes"
    );
  }

  public function defaultAction()
  {
    return "notFound";
  }
}
