<?php namespace Ecco\Ecsa\Controllers;

use Ecco\Ecsa\Controllers\BaseController;

class ClienteController extends BaseController {

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
            $org = new \Cliente;
            $id = \Crypt::decrypt(\Session::get('company'));
            $orgs = $org::where('organizations_id','=',$id)->get();
            $user = \Sentry::getUser();
            $this->layout = \View::make('ecsa::clientes.index')->with('user',$user)->with('org',$orgs);
            $this->layout->title = "Clientes";
            $this->layout->active = 3;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $org = new \Cliente;
            $id = \Crypt::decrypt(\Session::get('company'));
            $orgs = $org::where('organizations_id','=',$id)->take(5)->get();
            $user = \Sentry::getUser();
            
            $this->layout = \View::make('ecsa::clientes.create')->with('user',$user)->with('org',$orgs);
            $this->layout->title = "Nuevo Cliente";
            $this->layout->active = 3;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{   
            // Class Organization Instance
            $org = new \Cliente;
            // Get Rules Information 
            $rules = $org::rules();
            
            $data = array(
                'name'      => \Binput::get('name'),
                'municipio' => \Binput::get('municipio'),
                'estado'    => \Binput::get('estado'),
                'dir'       => \Binput::get('dir'),
                'tel1'      => \Binput::get('tel1'),
                'nextel'    => \Binput::get('nextel'),
                'correo'    => \Binput::get('correo'),
                'url'       => \Binput::get('url'),
                'status'    => 1
            );
            $validation = \Validator::make($data, $rules, trans('ecsa::validation') );
            
            if($validation->fails()){
               return \Redirect::route(\Config::get('ecsa::prefix').'.clientes.create')
                    ->withInput()->withErrors($validation);
            } else {
                $id = \Crypt::decrypt(\Session::get('company'));
                $data = array(
                    'name'      => \Binput::get('name'),
                    'municipio' => \Binput::get('municipio'),
                    'estado'    => \Binput::get('estado'),
                    'dir'       => \Binput::get('dir'),
                    'tel1'      => \Binput::get('tel1'),
                    'nextel'    => \Binput::get('nextel'),
                    'correo'    => \Binput::get('correo'),
                    'url'       => \Binput::get('url'),
                    'organizations_id' => $id,
                    'status'    => 1
                );
                
                $save = $org::create($data);
                if($save){
                    \Session::flash('success', 'Guardado con Exito');
                    return \Redirect::route(\Config::get('ecsa::prefix').'.clientes.create');
                } else {
                    \Session::flash('error', 'Ocurrio un Erro');
                    return \Redirect::route(\Config::get('ecsa::prefix').'.clientes.create');
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
                $org = new \Cliente;
                $val = $org::findById($id);
                $user = \Sentry::getUser();
                $this->layout = \View::make('ecsa::clientes.show')->with('user',$user)->with('org',$val);
                $this->layout->title = 'Informaci&oacute;n de Cliente';
                $this->layout->active = 3;
                
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
            $org = new \Cliente();
            $id = \Crypt::decrypt(\Session::get('company'));
            $orgs = $org::where('organizations_id','=',$id)->take(5)->get();
            $user = \Sentry::getUser();
            $val = $org::findById($id);
            if($val){
                $this->layout = \View::make('ecsa::clientes.update')->with('user',$user)->with('org',$val)
                        ->with('orgs',$orgs);
                $this->layout->title = 'Modificar Cliente';
                $this->layout->active = 3;
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
                    $org = new \Cliente();
                    $val = $org::findById($id);
                    if(($val)){
                        $val->status = 1;
                        $val->update();
                        return "<div class='alert alert-success text-center' ><b>Cliente Activado con Exito</b></div>";
                    } else {
                        return "<div class='alert alert-danger text-center' ><b>Hay un Error</b></div>";
                    }
                } else {
                    $org = new \Cliente();
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
                    $org = new \Cliente;
                    // Get Rules Information 
                    $rules = $org::rulesU();

                    $data = array(
                        'name'      => \Binput::get('name'),
                        'municipio' => \Binput::get('municipio'),
                        'estado'    => \Binput::get('estado'),
                        'dir'       => \Binput::get('dir'),
                        'tel1'      => \Binput::get('tel1'),
                        'nextel'    => \Binput::get('nextel'),
                        'correo'    => \Binput::get('correo'),
                        'url'       => \Binput::get('url'),
                        'status'    => 1
                    );
                    $validation = \Validator::make($data, $rules, trans('ecsa::validation') );

                    if($validation->fails()){
                        return \Redirect::route(\Config::get('ecsa::prefix').'.clientes.edit',
                                array(\Crypt::encrypt($id)))
                            ->withInput()->withErrors($validation);
                    } else {
                        $val = $org::findById($id);
                        $val->name      = \Binput::get('name');
                        $val->municipio = \Binput::get('municipio');
                        $val->estado    = \Binput::get('estado');
                        $val->dir       = \Binput::get('dir');
                        $val->tel1      = \Binput::get('tel1');
                        $val->nextel    = \Binput::get('nextel');
                        $val->correo    = \Binput::get('correo');
                        $val->url       = \Binput::get('url');

                        $save = $val->update();
                        if($save){
                            \Session::flash('success', 'Guardado con Exito');
                            return \Redirect::route(\Config::get('ecsa::prefix').
                                    '.clientes.edit', array(\Crypt::encrypt($id)));
                        } else {
                            \Session::flash('error', 'Ocurrio un Erro');
                            return \Redirect::route(\Config::get('ecsa::prefix').
                                    '.clientes.edit', array(\Crypt::encrypt($id)));
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
            $org = new \Cliente();
            $val = $org::findById($id);
            if($val){
                $val->status = 0;
                $val->update();
                return 'clientes';
            }
	}

}