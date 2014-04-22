<?php
/*
 *   Rutas del SISTEMA ECSA
 */

// Prefijo ECSA
Route::group(['prefix'=> \I18n::setLocale(),'after'=>'LaravelLocalizationRedirectFilter' ], function(){
    // Prefijo I8N
    Route::group(['prefix'=>Config::get('ecsa::prefix')], function(){
        // Rutas Para Usuarios Logeados
        Route::group(['before'=>'EcsaAuth'], function (){
            Route::get('/', function (){ return \Redirect::route('company.select'); });
            
            // Creacion de Usuarios
            Route::resource('user', 'Ecco\Ecsa\Controllers\UserController');
            
            // Creacion de Empresas
            Route::resource('organization', 'Ecco\Ecsa\Controllers\OrganizationController');
            // Clientes
            Route::resource('clientes', 'Ecco\Ecsa\Controllers\ClienteController');
            
            // Seleccion de Organizacion primera pantalla
            Route::get('company',['as'=>'company.select',
                'uses'=>'Ecco\Ecsa\Controllers\CompanyController@getSelection']);
            Route::get('selected/{a}', ['as'=>'company.selected',
                'uses'=>'Ecco\Ecsa\Controllers\CompanyController@getSelected']);
            // Dashboard Controller
            Route::get('dashboard',['as'=>'dashboard.index',
                'uses'=>'Ecco\Ecsa\Controllers\DashboardController@getIndex']);
            
            // Cerrar Session
            Route::get('logout',['as'=>'account.logout','uses'=>'Ecco\Ecsa\Controllers\AccountController@getLogout']);
            
        });
        
        // Rutas Para Usuarios No Logeados
        Route::group(['before'=>'ECSAnotAuth','prefix'=>'account'], function(){
            Route::get('/', function(){ return Redirect::route('account.login'); });
            Route::get('login', ['as'=>'account.login', 
                'uses'=>'Ecco\Ecsa\Controllers\AccountController@getLogin' ]);
            Route::post('login', ['uses'=>'Ecco\Ecsa\Controllers\AccountController@postLogin']);
            
        });
        
    });
    
    /*Route::get('default', function(){
        \Sentry::createUser(array(
            'first_name'    => 'Administrador',
            'last_name'     => 'Ecco',
            'email'         => 'ecco@yahoo.com',
            'username'      => 'administrador',
            'password'      => 'einsamkeit',
            'activated'     => '1',
        ));
    });*/
    
});