@extends('ecsa::_layouts.master')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('dashboard.index') }}" > <i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active" ><a href="{{ URL::route(\Config::get('ecsa::prefix').'.clientes.index') }}" > 
            <i class='fa fa-male' ></i>  Clientes </a></li>
    <li>
        <a> Informaci&oacute;n Cliente </a>
    </li>
</ol>
@endsection

@section('title')
<h1> <i class='fa fa-bookmark' ></i> {{ \Str::upper($org->name) }}</h1>
@endsection

@section('content')
<div class="col-lg-12" >
    <script>
        $(function (){
            $("#delete").click(function (){
                $.ajax({
                    url : window.location.href.toString(),
                    method : 'PATCH',
                    data : 'option=2',
                    success : function (data){
                        $("#message").html(data);
                    }
                });
                return false;
            });
            $("#active").click(function (){
                $.ajax({
                    url : window.location.href.toString(),
                    method : 'PATCH',
                    data : 'option=1',
                    success : function (data){
                        $("#message").html(data);
                    }
                });
                return false;
            });
        });
    </script>
    <div id="message" ></div>
    <div class="row upper-menu ">
        <div style="float: right" >
        @if($org->status == 1)
        <a href='./{{ \Crypt::encrypt($org->id) }}/edit' id="delete" class="btn btn-danger">
                <i class='fa fa-trash-o' ></i> Dar de Baja Cliente</a>
        @else
        <a href='./{{ \Crypt::encrypt($org->id) }}/edit' id="active" class="btn btn-success">
                <i class='fa fa-edit' ></i> Activar Cliente</a>
        @endif
            <a href='./{{ \Crypt::encrypt($org->id) }}/edit' class="btn btn-primary">
                <i class='fa fa-edit' ></i> Modificar Cliente</a>
        </div>
    </div>
    <div class="table-responsive" >
        <table class="table table-bordered table-condensed table-hover table-striped" >
            <thead>
                <tr>
                    <th colspan="2" class="text-center" >DATOS DEL CLIENTE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th> Nombre </th>
                    <td>{{ $org->name }}</td>
                </tr>
                <tr>
                    <th> Municipio </th>
                    <td>{{ $org->municipio }}</td>
                </tr>
                <tr>
                    <th> Estado </th>
                    <td>{{ $org->estado }}</td>
                </tr>
                <tr>
                    <th> Direcci&oacute;n </th>
                    <td>{{ $org->dir }}</td>
                </tr>
                <tr>
                    <th> Tel&eacute;fonos </th>
                    <td>{{ $org->tel1 }}</td>
                </tr>
                <tr>
                    <th> Nextel </th>
                    <td>{{ $org->nextel }}</td>
                </tr>
                <tr>
                    <th> Correo </th>
                    <td>{{ $org->correo }}</td>
                </tr>
                <tr>
                    <th> P&aacute;gina WEB </th>
                    <td>{{ (empty($org->url)) ? 'No tiene P&aacute;gina Web' : $org->url }}</td>
                </tr>
                <tr>
                    <th> Estado Actual </th>
                    <td>{{ (($org->status)== 1 )? 'Activo' : 'Inactivo' }}</td>
                </tr>
                <tr>
                    <th> Fecha de Registro </th>
                    <td>{{ $org->created_at }}</td>
                </tr>
                <tr>
                    <th> Ultima Fecha de Modificaci&oacute;n </th>
                    <td>{{ $org->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection