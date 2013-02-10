<?php
/**
 * @author brooke.bryan
 * @author gareth.evans
 */

namespace CubexIo;

class Project extends \Cubex\Core\Project\Project
{
  /**
   * Project Name
   *
   * @return string
   */
  public function name()
  {
    return "Public Cubex Website";
  }

  /**
   * @return \Cubex\Core\Application\Application
   */
  public function defaultApplication()
  {
    return new Applications\Www\WwwApplication();
  }

  public function getBundles()
  {
    return [];
    return [
      'debugger' => new \Bundl\Debugger\DebuggerBundle()
    ];
  }
}
