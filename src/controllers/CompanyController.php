<?php namespace Ecco\Ecsa\Controllers;

use Ecco\Ecsa\Controllers\BaseController;

class CompanyController extends BaseController {
    
    // Constructor de CompanyController
    public function __construct() {
        
    }
    
    public function getSelection()
    {
        $company = new \Organization();
        $this->layout = \View::make('ecsa::organizations.select')->with('org',$company::findAll());
        $this->layout->title = trans('ecsa::titles.organization.select');
    }
    
    public function getSelected($companyId)
    {
        \Session::put('company', $companyId);
        return \Redirect::route('dashboard.index');
    }
    
}