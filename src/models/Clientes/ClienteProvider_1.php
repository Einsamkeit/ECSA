<?php namespace Ecco\Ecsa\Models\Clientes;

use Illuminate\Support\Facades\Facade;
use Ecco\Ecsa\Models\Exceptions\ClienteException;

class ClienteProvider 
{
    protected $_model = 'Ecco\Ecsa\Models\Clientes\Cliente';
    
    public function all(array $columns = array('*'))
    {
        $model = $this->_model;
        return $model::all($columns);
    }
   
    public function where($column, $binding, $value)
    {
        $model = $this->_model;
        return $model::where($column,$binding,$value);
    }
    
    /*
     *   Protecetd Rules Sanitize Information
     */
    public function  rules(){
        return array(
            'name'      => 'required|min:3|max:255|unique:clientes',
            'municipio' => 'required|min:3|max:255',
            'estado'    => 'required|min:3|max:255',
            'dir'       => 'required|min:3|max:255',
            'tel1'      => 'required|min:10|max:10',
            'nextel'    => 'required|min:11|max:11',
            'correo'    => 'required|email',
            'url'       => 'url',
        );
    }
    
    /*
     *   Protecetd Rules Sanitize Information
     */
    public function  rulesU(){
        return array(
            'name'      => 'required|min:3|max:255',
            'municipio' => 'required|min:3|max:255',
            'estado'    => 'required|min:3|max:255',
            'dir'       => 'required|min:3|max:255',
            'tel1'      => 'required|min:10|max:10',
            'nextel'    => 'required|min:11|max:11',
            'correo'    => 'required|email',
            'url'       => 'url',
        );
    }
    
    /*
     *  Crea una nueva organizacion 
     */
    public function create($data)
    {
        $model = $this->createModel();
        $model->fill($data);
        $model->save();
        return $model;
    }
    
    /*
     *   Crea el Modelo
     */
    public function createModel()
    {
        $class = '\\'. ltrim($this->_model, '\\');
        return new $class;
    }
    
    /*
     *  Lista todas las organizaciones
     */
    public function findAll()
    {
        return $this->createModel()->newQuery()->get()->all();
    }
    
    /*
     *  Devuelve todos las Organizaciones 
     */
    public function findById($id)
    {
        if(!$org = $this->createModel()->newQuery()->find($id))
        {
            throw new ClienteException('Not Foud Organizations');
        }
        return $org;
    }
    
}

?>
