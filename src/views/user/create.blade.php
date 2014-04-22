@extends('ecsa::_layouts.master')

@section('content')
    <?php 
        $form = array(
            'url'       => \Config::get('ecsa::prefix').'.user.store',
            'method'    => 'POST',
            'defaults'  => array(
                'first_name' => '',
                'last_name'  => '',
                'email'      => '',
                'username'   => ''
            )
        ); 
    ?>
    @include('ecsa::partials.notifications')
    @include('ecsa::user.form')
@endsection