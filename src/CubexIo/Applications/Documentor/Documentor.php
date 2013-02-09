<?php
/**
* @author: brooke.bryan
* Application: Documentor
*/

namespace CubexIo\Applications\Documentor;

use Cubex\Core\Application\Application;

class Documentor extends Application
{
  public function getRoutes()
  {
    return [
    ];
  }

  public function defaultController()
  {
    return new Controllers\DefaultController();
  }
}
