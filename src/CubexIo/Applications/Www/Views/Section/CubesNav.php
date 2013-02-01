<?php
/**
 * @author  gareth.evans
 */
namespace CubexIo\Applications\Www\Views\Section;

use Cubex\Core\Http\Request;
use Cubex\View\HtmlElement;
use Cubex\View\Impart;
use Cubex\View\Partial;
use Cubex\View\RenderGroup;
use Cubex\View\ViewModel;

class CubesNav extends ViewModel
{
  private $_navItems = [
    "performance" => [
      "href" => "performance",
      "name" => "Performance"
    ],
    "gitrepo"     => [
      "href" => "gitrepo",
      "name" => "Git Repo"
    ],
    "web"         => [
      "href" => "web",
      "name" => "Web"
    ],
    "caching"     => [
      "href" => "caching",
      "name" => "Caching"
    ],
    "database"    => [
      "href" => "database",
      "name" => "Database"
    ],
    "scalable"    => [
      "href" => "scalable",
      "name" => "Scalable"
    ],
    "modular"     => [
      "href" => "modular",
      "name" => "Modular"
    ],
    "cronjob"     => [
      "href" => "cronjob",
      "name" => "Cron Job"
    ],
    "translation" => [
      "href" => "translation",
      "name" => "Translation"
    ]
  ];

  private $_cube;

  public function __construct(Request $request, $routeResult)
  {
    $pathParts = explode("/", ltrim($request->path(), "/"));
    $cube      = "";

    if($routeResult === "cubes")
    {
      $cube = isset($pathParts[1]) ? $pathParts[1] : "";
    }

    $this->_cube = $cube;
  }

  public function render()
  {
    $nav = new Partial(
      '<li class="%s"><a href="/cubes/%s"><i class="icon-cubes-%s"></i><br />' .
      '%s</a></li>'
    );

    foreach($this->_navItems as $navItemKey => $navItem)
    {
      $class = $navItemKey === $this->_cube ? "active" : "";
      $href  = $navItem["href"];
      $icon  = $navItemKey;
      $name  = $navItem["name"];

      $nav->addElement($class, $href, $icon, $name);
    }

    $contain = (new HtmlElement("div", ['class' => 'row']))->nest(
      (new HtmlElement('div', ['class' => 'span12']))->nest(
        (new HtmlElement('nav', ['class' => 'cubes']))->nestElement(
          'ul', ['class' => 'inline nav strtoupper text-center'], $nav
        )
      )
    );

    $link = new HtmlElement(
      'a', [
           'href'    => 'https://github.com/qbex/project',
           'onclick' => 'window.open(this.href); return false;',
           'class'   => 'btn btn-large btn-xlarge btn-warning strtoupper'
           ],
      'Download Cubex'
    );

    $downloadButton = (new HtmlElement("div", ['class' => 'row']))->nest(
      (new HtmlElement('div', ['class' => 'span12']))->nest(
        (new HtmlElement('div', ['class' => 'download text-center'], $link))
      )
    );

    return new RenderGroup($contain, $downloadButton);
  }
}
