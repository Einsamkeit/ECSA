<?php namespace Ecco\Ecsa\Models\Relations\Traits;

trait BelongsToOrganizationTraits {
    
    public function organization()
    {
        return $this->belongsTo('Ecco\Ecsa\Models\Organization');
    }
    
}

?>
