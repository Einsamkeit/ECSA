<?php namespace Ecco\Ecsa\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller {

    protected function setupLayout() {
        if ( ! is_null($this->layout))
        {
            $this->layout = \View::make($this->layout);
        }
    }
    
}