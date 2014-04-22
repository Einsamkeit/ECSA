<?php namespace Ecco\Ecsa\Controllers;

use Ecco\Ecsa\Controllers\BaseController;

class UserController extends BaseController {
    
    // --> Proteccion CSRF en las peticiones del usuario
    public function __construct() {
        $this->afterFilter('csrf', ['on'=>'post']);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $this->layout = \View::make('ecsa::user.index');
            $this->layout->title = trans('ecsa::titles.user.titlehead');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $this->layout = \View::make('ecsa::user.create');
            $this->layout->title = trans('ecsa::titles.user.new');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $rules = array(
                'first_name' => 'required|min:2|max:16',
                'last_name'  => 'required|min:2|max:16',
                'email'      => 'required|email|max:32',
                'username'   => 'required|alpha_num'
            );
            $validator = \Validator::make(\Binput::all(), $rules, trans('ecsa::validation'));
            if($validator->fails()){
                // Regresa al Formulario con los errores Encontrados
                return \Redirect::route(\Config::get('ecsa::prefix').'.user.create')->withInput()->withErrors($validator->errors());
            } else {
                try{
                    $password = \Str::random();
                    $user = array(
                        'first_name' => \Binput::get('first_name'),
                        'last_name'  => \Binput::get('last_name'),
                        'email'      => \Binput::get('email'),
                        'username'   => \Binput::get('username'),
                        'password'   => $password
                    );
                
                    $users = \Sentry::createUser($user);
                    \Session::flash('success', trans('ecsa::messages.form.success').' '.$password);
                    return \Redirect::route(\Config::get('ecsa::prefix').'.user.create');
                }
                catch (Cartalyst\Sentry\Users\UserExistsException $e)
                {
                    // Usuario Existente
                    \Session::flash('error', trans('ecsa::messages.exists',['option'=>'El Usuario ']));
                    return \Redirect::route('users.create')->withInput()->withErrors($validator);
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}