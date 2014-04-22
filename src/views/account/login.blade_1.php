@extends('ecsa::_layouts.login')

@section('content')
<div id="header" >
    <div class="page-full-width cf" >
        <div id="login-intro" class="fl">
            <h1>{{ trans('ecsa::all.login.title') }}</h1>
            <h5>{{ trans('ecsa::all.login.desc') }}</h5>
        </div>
        <a href="#" id="company-branding" class="fr"><img src="{{ asset('packages/ecco/ecsa/images/company-logo.png') }}" alt="Blue Hosting" /></a>
    </div>
</div>
<!-- MAIN CONTENT -->
<div id="content">
    {{ Form::open(['id'=>'login-form','autocomplete'=>'off']) }}
        @include('ecsa::partials.notifications')
        <fieldset>
            <p>
                {{ Form::label('email',trans('ecsa::all.login.email')) }}
                {{ Form::email('email', '', ['class'=>'round full-width-input','autofocus'=>true,
                    'placeholder'=>trans('ecsa::all.login.get').' '.trans('ecsa::all.login.email')]) }}
            </p>
            <p>
                {{ Form::label('password',trans('ecsa::all.login.password')) }}
                {{ Form::password('password',['class'=>'round full-width-input',
                    'placeholder'=>trans('ecsa::all.login.get').' '.  trans('ecsa::all.login.password')]) }}
            </p>
            <p>{{ Form::checkbox('remember') }} {{ trans('ecsa::all.login.remember') }} &nbsp;&nbsp;&nbsp;
                <a href="#">{{ trans('ecsa::all.login.forgot') }}!</a>.</p>
            {{ Form::submit(trans('ecsa::btn.login'), ['class'=>'button round blue image-right ic-right-arrow']) }}
        </fieldset>
    {{ Form::close() }}
</div> <!-- end content -->

<!-- FOOTER -->
<div id="footer">
    <p>&copy; Copyright {{ date('Y') }} {{ \Config::get('ecsa::company') }}.</p>
    <p>Creado Por : <strong> {{ \Config::get('ecsa::authors.first.name') }} {{ \Config::get('ecsa::authors.first.last_name') }}
        y {{ \Config::get('ecsa::authors.second.name') }} {{ \Config::get('ecsa::authors.second.last_name') }}</strong></p>
</div> <!-- end footer -->
@endsection