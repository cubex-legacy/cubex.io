<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Controllers;

use CubexIo\Applications\Www\Views\Index;
use CubexIo\Applications\Www\Views\Section\CubesNav;

class DefaultController extends BaseController
{
  public function renderIndex()
  {
    $this->nest(
      "cubesNav",
      new CubesNav($this->request(), $this->getRouteResult())
    );
    return new Index();
  }

  public function getRoutes()
  {
    return array(
      "/(|get-started)"  => "index",
      "/about"           => "about",
      "/learn"           => "learn",
      "/docs"            => "docs",
      "/community"       => "community"
    );
  }
}
