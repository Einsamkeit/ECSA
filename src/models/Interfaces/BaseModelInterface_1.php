<?php namespace Ecco\Ecsa\Models\Interfaces;

interface BaseModelInterface {
    
    public static function create(array $input);
    public static function beforeCreate(array $input);
    public static function afterCreate(array $input, $return);
    public function update(array $input = array());
    public function beforeUpdate(array $input);
    public function afterUpdate(array $input, $return);
    public function delete();
    public function beforeDelete();
    public function afterDelete($return);
    
}

?>
