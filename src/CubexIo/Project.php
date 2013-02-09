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

  public function getBySubDomainAndPath($subdomain, $path)
  {
    if(in_array('docs', [$subdomain, substr($path, 1, 4)]))
    {
      return new Applications\Documentor\Documentor();
    }
    return null;
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
