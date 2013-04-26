<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Controllers;

use Cubex\Facade\Redirect;
use Cubex\View\RenderGroup;
use CubexIo\Applications\Www\Views\About;
use CubexIo\Applications\Www\Views\Docs;
use CubexIo\Applications\Www\Views\Index;
use CubexIo\Applications\Www\Views\Licence;
use CubexIo\Applications\Www\Views\Section\DownloadButton;
use CubexIo\Applications\Www\Views\Section\HomeCubes;

class DefaultController extends BaseController
{
  public function renderIndex()
  {
    $this->requireCss("home");
    $this->nest(
      "cubesNav",
      new RenderGroup(
        new HomeCubes($this->request(), $this->getRouteResult()),
        new DownloadButton()
      )
    );
    return new Index();
  }

  public function renderDocs()
  {
    $this->layout()->setData("caption", "Cubex Documentation");
    return new Docs();
  }

  public function renderAbout()
  {
    return new About();
  }

  public function renderLicence()
  {
    return new Licence();
  }

  public function getRoutes()
  {
    return array(
      "/$"           => "index",
      "/get-started" => "index",
      "/about"       => "about",
      "/docs(.*)"    => "docs",
      "/licen(c|s)e" => "licence",
      "/community"   => "http://phabricator.cubex.io/",
      "/blog"        => "http://blog.cubex.io/",
    );
  }
}
