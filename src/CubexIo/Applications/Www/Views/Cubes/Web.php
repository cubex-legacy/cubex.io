<?php
/**
 * @author  gareth.evans
 */
namespace CubexIo\Applications\Www\Views\Cubes;

use Cubex\View\Impart;
use Cubex\View\ViewModel;

class Web extends ViewModel
{
  public function render()
  {
    return new Impart("Web Cube");
  }
}
