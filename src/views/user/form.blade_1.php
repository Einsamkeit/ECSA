{{ Form::open(['action'=>$form['url'],'method'=>'POST']) }}
    <fieldset>
        {{ Form::label('first_name', 'Nombre : ') }}
        {{ Form::input('text', 'first_name',$form['defaults']['first_name'],['placeholder'=>'Ingresa Nombre']) }}
        {{ ($errors->has('first_name') ? $errors->first('first_name') : '') }}<br />
        {{ Form::label('last_name', 'Apellido : ') }}
        {{ Form::input('text', 'last_name',$form['defaults']['last_name'],['placeholder'=>'Ingresa Apellido']) }}
        {{ ($errors->has('last_name') ? $errors->first('last_name') : '') }}<br/>
        {{ Form::label('email', 'Correo Electr&oacute;nico : ') }}
        {{ Form::email('email',$form['defaults']['email'],['placeholder'=>'Ingresa Correo Electr&oacute;nico']) }}
        {{ ($errors->has('email') ? $errors->first('email') : '') }}<br />
        {{ Form::label('username', 'Nombre de Usuario : ') }}
        {{ Form::input('text', 'username',$form['defaults']['username'],['placeholder'=>'Ingresa Nombre de Usuario']) }}
        {{ ($errors->has('username') ? $errors->first('username') : '') }}<br />
        {{ Form::submit('Send') }}
    </fieldset>
{{ Form::close() }}