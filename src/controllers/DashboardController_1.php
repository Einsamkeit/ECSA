<?php namespace Ecco\Ecsa\Controllers;

use Ecco\Ecsa\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function getIndex()
    {
        $org = new \Organization;
        $user = \Sentry::getUser();
        $this->layout = \View::make('ecsa::dashboard.index')->with('user',$user);
        $this->layout->title = 'Dashboard - Sistema ECSA';
        $this->layout->active = 1;
    }
}