{{ Form::open(['url'=>$form['url'],'method'=>$form['method'], 'files'=>true,'role'=>'form',
    'data-toggle' => 'validator','autocomplete'=>'off']) }}
    <input type="hidden" name="id" value="{{ $form['defaults']['id'] }}" />
    <div class='form-group' >
        {{ Form::label('name', 'Raz&oacute;n Social',['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-male' ></i></span>
            {{ Form::input('text', 'name',$form['defaults']['name'],['placeholder'=> 'Raz&oacute;n Social',
            'class'=>'form-control','required'=>'required',
            'pattern'=>'^([A-z. ]){3,}$' ]) }}
        </div>
        {{ ($errors->has('name') ? '<label class="text-danger" >'.$errors->first('name').'</label>' : '') }}
    </div>
    <div class='form-group' >
        {{ Form::label('municipio', trans('ecsa::forms.org.mun'),['class'=>'control-label']) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-info' ></i></span>
            {{ Form::input('text', 'municipio', $form['defaults']['municipio'], 
                ['placeholder'=> trans('ecsa::forms.org.mun'), 'class'=>'form-control'
                    ,'required'=>'required', 'pattern'=>'^([A-z ]){3,}$'] ) }}
        </div>
        {{ ($errors->has('municipio') ? '<label class="text-danger" >'.$errors->first('municipio').'</label>' : '' ) }}
    </div>
    <div class='form-group' >    
        {{ Form::label('estado', trans('ecsa::forms.org.est'),['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-info' ></i></span>
            {{ Form::input('text', 'estado', $form['defaults']['estado'], ['placeholder'=> trans('ecsa::forms.org.est'),
                'class'=>'form-control','required'=>'required', 'pattern'=>'^([A-z ]){3,}$'] ) }}
        </div>
        {{ ($errors->has('estado') ? '<label class="text-danger" >'.$errors->first('estado').'</label>' : '' ) }}
    </div>
    <div class='form-group' >    
        {{ Form::label('dir', trans('ecsa::forms.org.dir'),['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-info' ></i></span>
            {{ Form::input('text', 'dir', $form['defaults']['dir'], ['placeholder'=> trans('ecsa::forms.org.dir'),
                'class'=>'form-control','required'=>'required',
                'pattern'=>'^([A-z0-9.- ]){3,}$'] ) }}
        </div>
        {{ ($errors->has('dir') ? '<label class="text-danger" >'.$errors->first('dir').'</label>' : '' ) }}
    </div>
    <div class='form-group' >    
        {{ Form::label('tel1', trans('ecsa::forms.org.tel'),['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-phone' ></i></span>
            {{ Form::input('text', 'tel1', $form['defaults']['tel1'], ['placeholder'=> trans('ecsa::forms.org.tel'),
                'class'=>'form-control','required'=>'required', 'pattern'=>'^([0-9]){10}$']) }}
        </div>
        {{ ($errors->has('tel1') ? '<label class="text-danger" >'.$errors->first('tel1').'</label>' : '' ) }}
    </div>
    <div class='form-group' >    
        {{ Form::label('nextel', 'Nextel',['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-phone' ></i></span>
            {{ Form::input('text', 'nextel', $form['defaults']['nextel'], ['placeholder'=> 'N&uacute;mero Nextel',
                'class'=>'form-control',
                'pattern'=>'^([0-9*]){11}$']) }}
        </div>
        {{ ($errors->has('tel2') ? '<label class="text-danger" >'.$errors->first('tel2').'</label>' : '' ) }}
    </div>
    <div class='form-group' >
        {{ Form::label('correo', trans('ecsa::all.login.email'),['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-envelope' ></i></span>
            {{ Form::email('correo', $form['defaults']['email'], ['placeholder'=> trans('ecsa::all.login.email'),
            'class'=>'form-control','required'=>'required'] ) }}
        </div>
        {{ ($errors->has('correo') ? '<label class="text-danger" >'.$errors->first('correo').'</label>' : '' ) }}
    </div>
    <div class='form-group' >
        {{ Form::label('url', 'P&aacute;gina Web',['class'=>'control-label'] ) }}
        <div class='input-group' >
            <span class="input-group-addon"><i class='fa fa-link' ></i></span>
            {{ Form::url('url', $form['defaults']['url'], ['placeholder'=> 'Ingresa URL',
            'class'=>'form-control'] ) }}
        </div>
        {{ ($errors->has('url') ? '<label class="text-danger" >'.$errors->first('url').'</label>' : '' ) }}
    </div>    
    <div class='form-group text-center' >   
        {{ Form::submit($form['defaults']['submit'],['class'=>'btn btn-primary']) }}
    </div>
{{ Form::close() }}