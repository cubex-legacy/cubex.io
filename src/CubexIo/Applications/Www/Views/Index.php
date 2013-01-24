<?php
/**
 * @author brooke.bryan
 * @autho gareth.evans
 */
namespace CubexIo\Applications\Www\Views;

use Cubex\View\TemplatedViewModel;

class Index extends TemplatedViewModel
{
  public function __construct()
  {
    $this->setTitle($this->t("Cubex : Index Page"));
  }
}
