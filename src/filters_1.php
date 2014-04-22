<?php
/*
 *  Filtros de Acceso Sistema Ecsa
 */

Route::filter('EcsaAuth', function () {
    if(!Sentry::check()){
        // Guardamos en una Session la Ruta a la que se desea Acceder
        Session::put('attemptedUrl', URL::current());
        return Redirect::route('account.login');
    }
    View::share( 'currentUser', Sentry::getUser() );
});

Route::filter('ECSAnotAuth', function () {
    if(Sentry::check())
    {
        $url = Session::get('attemptedUrl');
        if(!isset($url))
        {
            $url = URL::route('company.select');
        }
        Session::forget('attemptedUrl');
        return Redirect::to($url);
    }
});