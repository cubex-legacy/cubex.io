<?php
/**
 * @author  brooke.bryan
 */

namespace CubexIo\Applications\Documentor\Controllers;

use CubexIo\Applications\Documentor\Views\Index;

class DefaultController extends BaseController
{
  public function renderIndex()
  {
    return new Index();
  }
}
