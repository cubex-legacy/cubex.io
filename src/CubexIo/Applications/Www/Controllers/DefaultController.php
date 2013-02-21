<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Controllers;

use CubexIo\Applications\Www\Views\Docs;
use CubexIo\Applications\Www\Views\Index;
use CubexIo\Applications\Www\Views\Section\HomeCubes;

class DefaultController extends BaseController
{
  public function renderIndex()
  {
    $this->requireCss("home");
    $this->nest(
      "cubesNav",
      new HomeCubes($this->request(), $this->getRouteResult())
    );
    return new Index();
  }

  public function renderDocs()
  {
    $this->layout()->setData("caption", "Cubex Documentation");
    return new Docs();
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
