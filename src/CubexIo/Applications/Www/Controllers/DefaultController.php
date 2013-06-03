<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Controllers;

use Cubex\Facade\Redirect;
use Cubex\View\RenderGroup;
use Cubex\View\TemplatedView;
use CubexIo\Applications\Www\Views\About;
use CubexIo\Applications\Www\Views\Docs;
use CubexIo\Applications\Www\Views\Documentation;
use CubexIo\Applications\Www\Views\Index;
use CubexIo\Applications\Www\Views\Licence;
use CubexIo\Applications\Www\Views\Section\DownloadButton;
use CubexIo\Applications\Www\Views\Section\HomeCubes;

class DefaultController extends BaseController
{
  public function renderIndex()
  {
    $this->includePrettify();
    $this->requireCss("home");
    $this->nest(
      "cubesNav",
      new RenderGroup(
        new HomeCubes($this->request(), $this->getRouteResult()),
        new DownloadButton()
      )
    );
    return new TemplatedView('Homepage', $this);
  }

  public function renderDocs($page = 'welcome')
  {
    $this->includePrettify();

    $docRoot = $this->getConfig()
               ->get("documentation")
               ->getStr("source_path", 'docs');
    if(substr($docRoot, 0, 1) !== '/' && substr($docRoot, 1, 1) !== ':')
    {
      $docRoot = dirname(WEB_ROOT) . DS . $docRoot . DS;
    }

    $sidebar = file_get_contents($docRoot . 'contents.md');
    if(file_exists($docRoot . $page . '.md') || $page == 'welcome')
    {
      $content = file_get_contents($docRoot . $page . '.md');
    }
    else
    {
      \Redirect::to('/docs')->with("error", 404)->now();
      return null;
    }

    $this->layout()->setData("caption", "Cubex Documentation");
    return $this->createView(new Documentation($sidebar, $content));
  }

  public function renderAbout()
  {
    $this->layout()->setData("caption", "About Cubex");
    return new TemplatedView('About', $this);
  }

  public function renderLicence()
  {
    $this->layout()->setData("caption", "Cubex Licence Information");
    return new TemplatedView('Licence', $this);
  }

  public function getRoutes()
  {
    return array(
      "/$"           => "index",
      "/get-started" => "index",
      "/about"       => "about",
      "/docs"        => [
        '/'              => 'docs',
        '/(?P<page>.*)/' => 'docs'
      ],
      "/licen(c|s)e" => "licence",
      "/phabricator" => "@301!http://phabricator.cubex.io/",
      "/blog"        => "http://blog.cubex.io/",
    );
  }
}
