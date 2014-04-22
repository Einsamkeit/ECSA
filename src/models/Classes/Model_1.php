<?php namespace Ecco\Ecsa\Models\Classes;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Ecco\Ecsa\Models\Interfaces\BaseModelInterface;
use Ecco\Ecsa\Models\Traits\BaseModelTrait;

abstract class Model extends Eloquent implements BaseModelInterface {
    use BaseModelTrait;
    
    protected $guarder = array('_token','_method','id');
    
}

?>
