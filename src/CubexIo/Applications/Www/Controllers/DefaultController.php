<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Controllers;

use Cubex\View\RenderGroup;
use CubexIo\Applications\Www\Views\About;
use CubexIo\Applications\Www\Views\Docs;
use CubexIo\Applications\Www\Views\Index;
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

  public function getRoutes()
  {
    return array(
      "/(|get-started)" => "index",
      "/about"          => "about",
      "/learn"          => "learn",
      "/docs"           => "docs",
      "/community"      => "community"
    );
  }
}
