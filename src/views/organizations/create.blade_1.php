@extends('ecsa::_layouts.master')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('dashboard.index') }}" > <i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ URL::route(\Config::get('ecsa::prefix').'.organization.index') }}" > 
            <i class='fa fa-bookmark' ></i>  {{ trans('ecsa::titles.organization.index') }} </a></li>
    <li class="active" ><i class='fa fa-plus' ></i> {{ trans('ecsa::titles.organization.new') }}</li>
</ol>
@endsection

@section('title')
<h1> <i class='fa fa-bookmark' ></i> {{ trans('ecsa::titles.organization.new') }}</h1>
@endsection

@section('content')
<div class="col-lg-7">
    <?php
        // Default Settings Form
        $form = array(
            'url'       => URL::route(\Config::get('ecsa::prefix').'.organization.store'),
            'method'    => 'POST',
            'defaults'  => array(
                'id'      => '',
                'name'      => '',
                'municipio' => '',
                'estado'    => '',
                'dir'       => '',
                'tel1'      => '',
                'tel2'      => '',
                'email'    => '',
                'submit'    => trans('ecsa::forms.submit.new')
            )
        );
    ?>
    @include('ecsa::partials.notifications')
    @include('ecsa::organizations.form')
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
                    <tbody>
                        @foreach($org as $orga)
                        <tr>
                            <td rowspan='3' > <img width='100' height='100' src='{{ asset( \Config::get('ecsa::image.path'). $orga->logo) }}' title='{{ $orga->logo }}' /> </td>
                            <td colspan='2' class='text-center' >Datos</td>
                        </tr>
                        <tr>
                            <td>Empresa:</td>
                            <td>{{ $orga->name }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de Alta</td>
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