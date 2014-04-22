@if (count($errors->all()) > 0)
<div class="alert alert-danger text-center">
    {{ trans('ecsa::messages.form.error') }}
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success text-center">
    {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger text-center">
    {{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning text-center">
    {{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info text-center ">
    {{ $message }}
</div>
@endif
