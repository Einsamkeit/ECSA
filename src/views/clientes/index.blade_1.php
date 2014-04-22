@extends('ecsa::_layouts.master')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('dashboard.index') }}" > <i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active" ><a href="{{ URL::route(\Config::get('ecsa::prefix').'.clientes.index') }}" > 
            <i class='fa fa-male' ></i>  Clientes </a></li>
</ol>
@endsection

@section('title')
<h1> <i class='fa fa-male' ></i> Clientes</h1>
@endsection

@section('content')
@include('ecsa::_layouts.confirmation-modal', array('title' => trans('ecsa::all.confirm-delete-title'), 'content' => trans('ecsa::all.confirm-delete-message'), 'type' => 'delete-user'))
<div class="col-lg-12" >
    <div class="row upper-menu " >
        <div style="float: right" >
            <a id="delete-item" class="btn btn-danger" style="display: none" >
                <i class='fa fa-trash-o' ></i> {{ trans('ecsa::btn.delete') }}</a>
            <a class="btn btn-info btn-new" href="{{ URL::route(\Config::get('ecsa::prefix').'.clientes.create') }}">
                <i class='fa fa-plus' ></i> Nuevo</a>
        </div>
    </div>
    <div class="table-responsive" >
        <table id="table" class="table table-striped table-hover table-bordered table-condensed" >
            <thead>
                <tr>
                    <th><input type="checkbox" name="all" class="check-all" /></th>
                    <th class="visible-lg visible-md visible-sm visible-xs" >Empresa <i class="fa fa-sort" ></i></th>
                    <th class="visible-lg visible-md visible-sm visible-xs" >Telef&oacute;no <i class="fa fa-sort" ></i></th>
                    <th class="visible-lg visible-md visible-sm visible-xs" >Correo <i class="fa fa-sort" ></i></th>
                    <th class="visible-lg visible-md visible-sm visible-xs" >Direcci&oacute;n <i class="fa fa-sort" ></i></th>
                    <th class="visible-lg">Municipio <i class="fa fa-sort" ></i></th>
                    <th class="visible-md" >Estado <i class="fa fa-sort" ></i></th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach($org as $orga)
                <?php $color = (($orga->status)== 1) ? 'style="color:green"' : 'style="color:red"'; ?>
                <tr {{ $color }} >
                    <td><input type="checkbox" data-user-id="{{ \Crypt::encrypt($orga->id) }}" /></td>
                    <td class="visible-lg visible-md visible-sm visible-xs" >{{ $orga->name }}</td>
                    <td class="visible-lg visible-md visible-sm visible-xs" >{{ $orga->tel1 }}</td>
                    <td class="visible-lg visible-md visible-sm visible-xs" >{{ $orga->correo }}</td>
                    <td class="visible-lg visible-md visible-sm visible-xs" >{{ Str::limit($orga->dir,25) }}</td>
                    <td class="visible-lg" >{{ $orga->municipio }}</td>
                    <td class="visible-md" >{{ $orga->estado }}</td>
                    <td><a href='{{ URL::route(\Config::get('ecsa::prefix').'.clientes.index') }}/{{ \Crypt::encrypt($orga->id) }}' class="btn btn-primary" ><i class="fa fa-eye" ></i> Ver </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('assets')
<script src='{{ asset('packages/ecco/ecsa/js/dataTable/jquery.dataTables.js') }}' ></script>
<script src='{{ asset('packages/ecco/ecsa/js/app.js') }}' ></script>
<script src='{{ asset('packages/ecco/ecsa/js/cliente.js') }}' ></script>
@endsection