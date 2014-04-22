<?php namespace Ecco\Ecsa\Models\Relations\Traits;

trait HasManyOrganizationsTraits {
    
    public function organizations()
    {
        return $this->hasMany('Ecco\Ecsa\Models\Organizations');
    }
    
    public function deleteOrganizations()
    {
        foreach($this->organizations()->get(array('id')) as $organization )
        {
            $organization->delete();
        }
    }
    
}

?>
