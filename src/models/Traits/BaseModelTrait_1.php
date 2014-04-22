<?php namespace Ecco\Ecsa\Models\Traits;

trait BaseModelTrait
{
    public static function create(array $input)
    {
        static::beforeCreate($input);
        static::afterCreate($input, $return);
        return $return;
    }
    
    public static function beforeCreate(array $input){ }
    
    public static function afterCreate(array $input, $return){ }
    
    public function update(array $input = array())
    {
        $this->beforeUpdate($input);
        $return = parent::update($input);
        $this->afterUpdate($input, $return);
        return $return;
    }
    
    public function beforeUpdate(array $input){ }
    
    public function afterUpdate(array $input, $return){ }
    
    public function delete()
    {
        $this->beforeDelete();
        $return = parent::delete();
        $this->afterDelete($return);
        return $return;
    }
    
    public function beforeDelete(){ }
    
    public function afterDelete($return){ }
    
}

