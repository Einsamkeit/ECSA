<?php namespace Ecco\Ecsa\Controllers;

use Ecco\Ecsa\Controllers\BaseController;
use Ecco\Ecsa\Models\Organizations\Organization;

class OrganizationController extends BaseController {

    public function __construct() {
        // Protection CSRF Attak
        $this->afterFilter('csrf', ['on'=>'post']);
    }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $org = new \Organization;
            $user = \Sentry::getUser();
            $this->layout = \View::make('ecsa::organizations.index')->with('user',$user)->with('org',$org::all());
            $this->layout->title = trans('ecsa::titles.organization.index');
            $this->layout->active = 2;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $org = new \Organization;
            $user = \Sentry::getUser();
            $this->layout = \View::make('ecsa::organizations.create')->with('user',$user)->with('org',$org::all());
            $this->layout->title = trans('ecsa::titles.organization.new');
            $this->layout->active = 2;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{   
            // Class Organization Instance
            $org = new \Organization;
            // Get Rules Information 
            $rules = $org::rules();
            
            if(!\File::isDirectory(\Config::get('ecsa::image.path')))
                \File::makeDirectory(\Config::get('ecsa::image.path'));
            
            $data = array(
                'name'      => \Binput::get('name'),
                'municipio' => \Binput::get('municipio'),
                'estado'    => \Binput::get('estado'),
                'dir'       => \Binput::get('dir'),
                'tel1'      => \Binput::get('tel1'),
                'tel2'      => \Binput::get('tel2'),
                'correo'    => \Binput::get('correo'),
                'logo'      => \Binput::file('logo'),
                'firma'     => \Binput::file('firma')
            );
            $validation = \Validator::make($data, $rules, trans('ecsa::validation') );
            
            if($validation->fails()){
               return \Redirect::route(\Config::get('ecsa::prefix').'.organization.create')
                    ->withInput()->withErrors($validation);
            } else {
                
                $name_company = \Str::slug(\Binput::get('name'), '-');
                // Creamos el Directorio
                if(!\File::isDirectory(\Config::get('ecsa::image.path').$name_company))
                    \File::makeDirectory(\Config::get('ecsa::image.path').$name_company.'/');
                
                // Obtenemos el logo
                $image = \Binput::file('logo');
                $logo = \Str::random(8).$image->getClientOriginalName();
                
                $fulllogopath = \Config::get('ecsa::image.path').$name_company.'/'.$logo;
                $logopath = $name_company.'/'.$logo;
                
                // Guardamos el logo en el servidor 
                \Image::make(\Binput::file('logo')->getrealPath())
                    ->resize(\Config::get('ecsa::image.width'), \Config::get('ecsa::image.height'))
                    ->save($fulllogopath);
                // --------------------------------------------------
                // Obtenemos la firma
                $imagef = \Binput::file('firma');
                $firma = \Str::random(8).$imagef->getClientOriginalName();
                
                $fullfirmapath = \Config::get('ecsa::image.path').$name_company.'/'.$firma;
                $firmapath = $name_company.'/'.$firma;
                
                // Guardamos la firma en el servidor 
                \Image::make(\Binput::file('firma')->getrealPath())
                    ->resize(\Config::get('ecsa::image.width'), \Config::get('ecsa::image.height'))
                    ->save($fullfirmapath);
                //------------------------------------------------------------------
                
                $data = array(
                    'name'      => \Binput::get('name'),
                    'municipio' => \Binput::get('municipio'),
                    'estado'    => \Binput::get('estado'),
                    'dir'       => \Binput::get('dir'),
                    'tel1'      => \Binput::get('tel1'),
                    'tel2'      => \Binput::get('tel2'),
                    'correo'    => \Binput::get('correo'),
                    'logo'      => $logopath,
                    'firma'     => $firmapath,
                    'status'    => 1
                );
                
                $save = $org::create($data);
                if($save){
                    \Session::flash('success', 'Guardado con Exito');
                    return \Redirect::route(\Config::get('ecsa::prefix').'.organization.create');
                } else {
                    \Session::flash('error', 'Ocurrio un Erro');
                    return \Redirect::route(\Config::get('ecsa::prefix').'.organization.create');
                }
            }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $id = \Crypt::decrypt($id);
            if(is_int($id)){
                $org = new \Organization;
                $val = $org::findById($id);
                $user = \Sentry::getUser();
                $this->layout = \View::make('ecsa::organizations.show')->with('user',$user)->with('org',$val);
                $this->layout->title = 'Modificar Empresa';
                $this->layout->active = 2;
                
            } else {
                return \Redirect::back();
            }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    $id = \Crypt::decrypt($id);
            $org = new \Organization();
            $user = \Sentry::getUser();
            $val = $org::findById($id);
            if($val){
                $this->layout = \View::make('ecsa::organizations.update')->with('user',$user)->with('org',$val)
                        ->with('orgs',$org::all());
                $this->layout->title = 'Modificar Empresa';
                $this->layout->active = 2;
            }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            if(\Request::ajax()){
                $id = \Crypt::decrypt($id);
                if(\Request::get('option')==1){
                    $org = new \Organization();
                    $val = $org::findById($id);
                    if(($val)){
                        $val->status = 1;
                        $val->update();
                        return "<div class='alert alert-success text-center' ><b>Empresa Activada con Exito</b></div>";
                    } else {
                        return "<div class='alert alert-danger text-center' ><b>Hay un Error</b></div>";
                    }
                } else {
                    $org = new \Organization();
                    $val = $org::findById($id);
                    if(($val)){
                        $val->status = 0;
                        $val->update();
                        return "<div class='alert alert-success text-center' ><b>Baja realizada con Exito</b></div>";
                    } else {
                        return "<div class='alert alert-danger text-center' ><b>Hay un Error</b></div>";
                    }
                }
            }
            
	    if(!empty($id)){
                $id = \Crypt::decrypt($id);
                if(is_int($id)){
                    // Class Organization Instance
                    $org = new \Organization;
                    // Get Rules Information 
                    $rules = $org::rulesU();
                    $data = array(
                        'name'      => \Binput::get('name'),
                        'municipio' => \Binput::get('municipio'),
                        'estado'    => \Binput::get('estado'),
                        'dir'       => \Binput::get('dir'),
                        'tel1'      => \Binput::get('tel1'),
                        'tel2'      => \Binput::get('tel2'),
                        'correo'    => \Binput::get('correo')
                    );
                    $validation = \Validator::make($data, $rules, trans('ecsa::validation') );

                    if($validation->fails()){
                       return \Redirect::route(\Config::get('ecsa::prefix').
                               '.organization.edit', array(\Crypt::encrypt($id)))
                            ->withInput()->withErrors($validation);
                    } else {
                        $filey = 0;
                        if(\Binput::file('logo')){
                            $name_company = \Str::slug(\Binput::get('name'), '-');
                            // Creamos el Directorio
                            if(!\File::isDirectory(\Config::get('ecsa::image.path').$name_company))
                                \File::makeDirectory(\Config::get('ecsa::image.path').$name_company.'/');
                            // Obtenemos el logo
                            $image = \Binput::file('logo');
                            $logo = \Str::random(8).$image->getClientOriginalName();

                            $fulllogopath = \Config::get('ecsa::image.path').$name_company.'/'.$logo;
                            $logopath = $name_company.'/'.$logo;

                            // Guardamos el logo en el servidor 
                            \Image::make(\Binput::file('logo')->getrealPath())
                                ->resize(\Config::get('ecsa::image.width'), \Config::get('ecsa::image.height'))
                                ->save($fulllogopath);
                            
                            $filey = 1;
                        }
                        if(\Binput::file('firma')){
                            $name_company = \Str::slug(\Binput::get('name'), '-');
                            // Creamos el Directorio
                            if(!\File::isDirectory(\Config::get('ecsa::image.path').$name_company))
                                \File::makeDirectory(\Config::get('ecsa::image.path').$name_company.'/');
                            // Obtenemos la firma
                            $imagef = \Binput::file('firma');
                            $firma = \Str::random(8).$imagef->getClientOriginalName();

                            $fullfirmapath = \Config::get('ecsa::image.path').$name_company.'/'.$firma;
                            $firmapath = $name_company.'/'.$firma;

                            // Guardamos la firma en el servidor 
                            \Image::make(\Binput::file('firma')->getrealPath())
                                ->resize(\Config::get('ecsa::image.width'), \Config::get('ecsa::image.height'))
                                ->save($fullfirmapath);
                            $filey = 1;
                        }
                        
                        if($filey == 0){
                            $val = $org::findById($id);
                            $val->name      = \Binput::get('name');
                            $val->municipio = \Binput::get('municipio');
                            $val->estado    = \Binput::get('estado');
                            $val->dir       = \Binput::get('dir');
                            $val->tel1      = \Binput::get('tel1');
                            $val->tel2      = \Binput::get('tel2');
                            $val->correo    = \Binput::get('correo');

                            $save = $val->update();
                            if($save){
                                \Session::flash('success', 'Guardado con Exito');
                                return \Redirect::route(\Config::get('ecsa::prefix').
                                        '.organization.edit', array(\Crypt::encrypt($id)));
                            } else {
                                \Session::flash('error', 'Ocurrio un Erro');
                                return \Redirect::route(\Config::get('ecsa::prefix').
                                        '.organization.edit', array(\Crypt::encrypt($id)));
                            }
                        } else if($filey == 1) {
                            $val = $org::findById($id);
                            $val->name      = \Binput::get('name');
                            $val->municipio = \Binput::get('municipio');
                            $val->estado    = \Binput::get('estado');
                            $val->dir       = \Binput::get('dir');
                            $val->tel1      = \Binput::get('tel1');
                            $val->tel2      = \Binput::get('tel2');
                            $val->correo    = \Binput::get('correo');
                            if(\Binput::file('logo'))
                                $val->logo      = $logopath;
                            if(\Binput::file('firma'))
                                $val->firma      = $firmapath;
                                
                            $save = $val->update();
                            if($save){
                                \Session::flash('success', 'Guardado con Exito');
                                return \Redirect::route(\Config::get('ecsa::prefix').
                                        '.organization.edit', array(\Crypt::encrypt($id)));
                            } else {
                                \Session::flash('error', 'Ocurrio un Erro');
                                return \Redirect::route(\Config::get('ecsa::prefix').
                                        '.organization.edit', array(\Crypt::encrypt($id)));
                            }
                        } 
                        
                    }
                    
                } else {
                    return \Redirect::back();
                }
            } else {
                return \Redirect::back();
            }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $id = \Crypt::decrypt($id);
            $messages = array();
            $org = new \Organization();
            $val = $org::findById($id);
            if($val){
                $val->status = 0;
                $val->update();
                return 'organization';
            }
	}
        
        public function modify(){}

}