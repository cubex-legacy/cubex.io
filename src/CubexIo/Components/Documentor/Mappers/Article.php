<?php
/**
 * @author: brooke.bryan
 *        Component: Documentor
 */
namespace CubexIo\Components\Documentor\Mappers;

use Cubex\Mapper\Database\RecordMapper;

class Article extends RecordMapper
{
  public $content;
  public $title;
  public $slug;
}
