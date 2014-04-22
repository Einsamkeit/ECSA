@extends('ecsa::_layouts.select')

@section('content')
<div id="header" >
    <div class=" alert-info alert page-full-width cf" >
        <div id="info" class="fl text-danger text-upper ">
            <h1>{{ trans('ecsa::all.select.title') }}</h1>
            <h5>{{ trans('ecsa::all.select.desc') }}</h5>
        </div>
    </div>
</div>
<!-- MAIN CONTENT -->
<div class="navbar navbar-default " role="navigation" >
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">navegacion</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
        <div class='navbar-collapse collapse ' >
            <ul class='nav navbar-nav navbar-right' >
                <li><a href="{{ URL::route(\Config::get('ecsa::prefix').'.organization.create') }}" ><i class='glyphicon glyphicon-plus' ></i> {{ trans('ecsa::titles.organization.new') }}</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="content" class="container-fluid" >
    @if(count($org) != 0)
    <div class="container text-center " >
        <div class="row" >
            @foreach($org as $orga)
            <a href="{{ URL::route('company.selected', array('a' => \Crypt::encrypt($orga->id)))}}" >
                <div class="col-md-3 col-md-offset-1 text-center alert alert-info " >
                    <img title="{{ ucwords($orga->name) }}" width='50' height="50" src="{{ asset( \Config::get('ecsa::image.path') ) }}/{{ $orga->logo }}" />
                    <hr>
                    {{ ucwords($orga->name) }}
                </div>
                </a>
            @endforeach
        </div>
    </div>
    @else
    <div align='center' class="alert alert-danger" >
        <a class="button round blue image-right ic-add" href="{{ URL::route(\Config::get('ecsa::prefix').'.organization.create') }}" >{{ trans('ecsa::btn.newm') }}</a>
    </div>
    @endif
</div> <!-- end content -->

<!-- FOOTER -->
<div id="footer" >
    <p>&copy; Copyright {{ date('Y') }} {{ \Config::get('ecsa::company') }}.</p>
    <p>Creado Por : <strong> {{ \Config::get('ecsa::authors.first.name') }} {{ \Config::get('ecsa::authors.first.last_name') }}
        y {{ \Config::get('ecsa::authors.second.name') }} {{ \Config::get('ecsa::authors.second.last_name') }}</strong></p>
</div> <!-- end footer -->
@endsection