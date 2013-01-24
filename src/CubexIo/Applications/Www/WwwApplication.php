<?php
/**
 * @author brooke.bryan
 * @author gareth.evans
 */
namespace CubexIo\Applications\Www;

use Cubex\Core\Application\Application;

class WwwApplication extends Application
{
  public function defaultDispatcher()
  {
    return 'DefaultController';
  }

  public function name()
  {
    return "Public Cubex Website";
  }

  public function getNamespace()
  {
    return __NAMESPACE__;
  }
}
