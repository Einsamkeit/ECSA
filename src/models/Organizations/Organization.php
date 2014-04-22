<?php namespace Ecco\Ecsa\Models\Organizations;

use Ecco\Ecsa\Models\Exceptions\OrganizationException;
use Ecco\Ecsa\Models\Classes\Model;
use Ecco\Ecsa\Models\Relations\Interfaces\HasManyOrganizationsInterface;
use Ecco\Ecsa\Models\Relations\Traits\HasManyOrganizationsTraits;
use Ecco\Ecsa\Models\Relations\Interfaces\BelongsToOrganizationInterface;
use Ecco\Ecsa\Models\Relations\Traits\BelongsToOrganizationTraits;

class Organization extends Model implements HasManyOrganizationsInterface,
        BelongsToOrganizationInterface
{
    use HasManyOrganizationsTraits, BelongsToOrganizationTraits;
    
    public static $name = 'organization';
    
    /*
     *  Tabla a la cual hace referencia el modelo 
     */
    protected $table = 'organizations';
    
    protected $fillable = array('name','logo','municipio','estado','dir','tel1','tel2','firma','correo','status');
    
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required|min:2|max:32'
    );
    
    public function rules()
    {
        return array(
            'name' => 'required|min:2|max:32'
        );
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    /*
     *  Guarda las organizaciones
     */
    public function save(array $options = array())
    {
        return parent::save($options);
    }
    
}

?>
