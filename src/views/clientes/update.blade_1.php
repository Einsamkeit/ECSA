@extends('ecsa::_layouts.master')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('dashboard.index') }}" > <i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active" ><a href="{{ URL::route(\Config::get('ecsa::prefix').'.clientes.index') }}" > 
            <i class='fa fa-male' ></i>  Clientes </a></li>
    <li class="active" ><i class='fa fa-edit' ></i> Modificar Cliente</li>
</ol>
@endsection

@section('title')
<h1> <i class='fa fa-male' ></i> Modificar Cliente</h1>
@endsection

@section('content')
<div class="col-lg-7">
    <?php
        // Default Settings Form
        $form = array(
            'url'       => URL::route(\Config::get('ecsa::prefix').'.clientes.update', array('id' => \Crypt::encrypt($org->id))),
            'method'    => 'PATCH',
            'defaults'  => array(
                'id'        => \Crypt::encrypt($org->id),
                'name'      => $org->name,
                'municipio' => $org->municipio,
                'estado'    => $org->estado,
                'dir'       => $org->dir,
                'tel1'      => $org->tel1,
                'nextel'    => $org->nextel,
                'email'     => $org->correo,
                'url'       => $org->url,
                'submit'    => 'Modificar Cliente'
            )
        );
    ?>
    @include('ecsa::partials.notifications')
    @include('ecsa::clientes.form')
</div>
@endsection

@section('right')
<div class="col-lg-5">
    <div class='panel panel-primary' >
        <div class='panel-heading' >
            <i class='fa fa-bolt' ></i> {{ trans('ecsa::all.addrecent') }}</div>
        <div class='panel-body' >
            <div class='table-responsive' >
                <table class='table table-striped table-hover table-condensed' >
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orgs as $orga)
                        <tr>
                            <td>{{ \Str::limit($orga->name,25) }}</td>
                            <td>{{ $orga->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('assets')
<script src="{{ asset('packages/ecco/ecsa/js/validator.js') }}" ></script>
@endsection