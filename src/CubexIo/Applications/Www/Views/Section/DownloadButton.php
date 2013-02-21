<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Www\Views\Section;

use Cubex\View\HtmlElement;
use Cubex\View\ViewModel;

class DownloadButton extends ViewModel
{
  public function render()
  {
    $link = new HtmlElement(
      'a', [
           'href'    => 'https://github.com/qbex/project',
           'onclick' => 'window.open(this.href); return false;',
           'class'   => 'btn btn-large btn-xlarge btn-warning strtoupper'
           ],
      'Download Cubex'
    );

    return (new HtmlElement("div", ['class' => 'row']))->nest(
      (new HtmlElement('div', ['class' => 'span12']))->nest(
        (new HtmlElement('div', ['class' => 'download text-center'], $link))
      )
    );
  }
}
