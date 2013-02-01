<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Controllers;

use CubexIo\Applications\Www\Views\Index;

class DefaultController extends BaseController
{
  public function renderIndex()
  {
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
