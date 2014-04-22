<?php namespace Ecco\Ecsa\Models\Clientes;

use Ecco\Ecsa\Models\Exceptions\ClienteException;
use Ecco\Ecsa\Models\Classes\Model;

class Cliente extends Model 
{
   
    
    public static $name = 'cliente';
    
    /*
     *  Tabla a la cual hace referencia el modelo 
     */
    protected $table = 'clientes';
    
    protected $fillable = array('name','municipio','estado','dir','tel1','nextel','correo','url','organizations_id','status');
    
    protected $guarded = array('id');
    
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
