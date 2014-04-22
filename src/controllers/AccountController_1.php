<?php namespace Ecco\Ecsa\Controllers;
/*
 *   Clase de Acceso del Usuario
 */
use Ecco\Ecsa\Controllers\BaseController;

class AccountController extends \BaseController {
    
    public function __construct() {
        $this->afterFilter('csrf', ['on'=>'post']);
    }

    public function getLogin()
    {
        $this->layout = \View::make('ecsa::account.login');        
    }
    
    public function postLogin()
    {
        try {
            $credentials = array(
                'email'     => \Binput::get('email'),
                'password'  => \Binput::get('password')
            );
            $remember = \Binput::get('remember');
            \Sentry::authenticate($credentials,$remember);
            return \Redirect::route('company.select');
        }catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            \Session::flash('error', trans('ecsa::messages.login.error.email'));
            return \Redirect::route('account.login')->withInput();
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            \Session::flash('error', trans('ecsa::messages.login.error.password'));
            return \Redirect::route('account.login')->withInput();
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            \Session::flash('error', trans('ecsa::messages.form.error'));
            return \Redirect::route('account.login')->withInput();
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            \Session::flash('error', trans('ecsa::messages.form.error'));
            return \Redirect::route('account.login')->withInput();
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            \Session::flash('error', trans('ecsa::messages.login.error.inactive'));
            return \Redirect::route('account.login')->withInput();
        }
        catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $suspend = \Cartalyst\Sentry\Throttling\Eloquent\Throttle::getSuspensionTime();
            
            \Session::flash('error', trans('ecsa::messages.login.error.suspend',['option'=>$suspend]));
            return \Redirect::route('account.login')->withInput();
        }
        catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            \Session::flash('error', trans('ecsa::messages.login.error.banned'));
            return \Redirect::route('account.login')->withInput();
        }
    }
    
    public function getLogout()
    {
        \Sentry::logout();
        return \Redirect::route('account.login');
    }
    
}