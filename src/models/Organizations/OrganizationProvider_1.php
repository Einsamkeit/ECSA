<?php namespace Ecco\Ecsa\Models\Organizations;

use Illuminate\Support\Facades\Facade;
use Ecco\Ecsa\Models\Exceptions\OrganizationException;

class OrganizationProvider 
{
    protected $_model = 'Ecco\Ecsa\Models\Organizations\Organization';
    
    public function all(array $columns = array('*'))
    {
        $model = $this->_model;
        return $model::all($columns);
    }
    
    /*
     *   Protecetd Rules Sanitize Information
     */
    public function  rules(){
        return array(
            'name'      => 'required|min:3|max:32|unique:organizations',
            'municipio' => 'required|min:3|max:255',
            'estado'    => 'required|min:3|max:255',
            'dir'       => 'required|min:3|max:255',
            'tel1'      => 'required|min:10|max:10',
            'tel2'      => 'required|min:10|max:10',
            'correo'    => 'required|email',
            'logo'      => 'required|image',
            'firma'     => 'required|image'
        );
    }
    
    public function  rulesU(){
        return array(
            'name'      => 'required|min:3|max:32',
            'municipio' => 'required|min:3|max:255',
            'estado'    => 'required|min:3|max:255',
            'dir'       => 'required|min:3|max:255',
            'tel1'      => 'required|min:10|max:10',
            'tel2'      => 'required|min:10|max:10',
            'correo'    => 'required|email'
        );
    }
    
    /*
     *  Protected Rules of Images
     */
    public function rulesImage()
    {
        return array(
            'logo' => 'image'
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
            throw new OrganizationException('Not Foud Organizations');
        }
        return $org;
    }
    
}

?>
