<?php
/**
 * @author: brooke.bryan
 *        Application: Www
 */
namespace CubexIo\Applications\Www\Views;

use Cubex\View\TemplatedViewModel;
use CubexIo\Components\Documentor\Markdown\SiteMarkdown;

class Documentation extends TemplatedViewModel
{
  protected $_sidebarMd;
  protected $_contentMd;
  protected $_mdEngine;

  public function __construct($sidebarMarkdown, $contentMarkdown)
  {
    $this->_sidebarMd = $sidebarMarkdown;
    $this->_contentMd = $contentMarkdown;
    $this->_mdEngine  = new SiteMarkdown();
    $this->_error     = \Session::getFlash("error", null);
    $this->setTitle($this->t("Cubex : Documentation"));
  }

  public function hasError()
  {
    return $this->_error !== null;
  }

  public function getError()
  {
    switch($this->_error)
    {
      case 404:
        return "The page you requested was not found.";
        break;
    }
    return null;
  }

  public function getSidebar()
  {
    return $this->_mdEngine->transformMarkdown($this->_sidebarMd);
  }

  public function getContent()
  {
    return $this->_mdEngine->transformMarkdown($this->_contentMd);
  }
}
