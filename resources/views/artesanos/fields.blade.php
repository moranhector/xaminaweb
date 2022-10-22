<!-- Nombre Field -->
 

 
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Documento Field -->
 
    <div class="form-group col-sm-6">
        {!! Form::label('documento', 'Documento:') !!}
        {!! Form::number('documento', null, ['class' => 'form-control']) !!}
    </div>
 



<!-- Documento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuit', 'CUIT:') !!}
    {!! Form::number('cuit', null, ['class' => 'form-control']) !!}
</div>



<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>


<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lugar', 'Lugar:') !!}
    {!! Form::text('lugar', null, ['class' => 'form-control']) !!}
</div>




<div class="form-group col-sm-6">

    <div class="form-group">
        <label>Departamento:</label>

 
        @if( Route::currentRouteName()=="artesanos.create" )

            <select class="form-control" name="departamento" id="departamento" value="" }}>
            <option style="display:none;"></option> 
 
        @endif        

        @if( Route::currentRouteName()=="artesanos.edit" )
            
            <select class="form-control" name="departamento" id="departamento" value="{{$artesano->departamento}}" }}>        
 
        @endif


            <option value="LAVALLE     ">LAVALLE </option>
            <option value="MALARGUE    ">MALARGUE </option>
            <option value="SANTA ROSA  ">SANTA ROSA </option>
            <option value="LA PAZ      ">LA PAZ </option>
            <option value="TUNUYAN     ">TUNUYAN </option>
            <option value="SAN CARLOS  ">SAN CARLOS </option>
            <option value="LAS HERAS   ">LAS HERAS </option>
            <option value="GUAYMALLEN  ">GUAYMALLEN </option>
            <option value="RIVADAVIA   ">RIVADAVIA </option>
            <option value="TUPUNGATO   ">TUPUNGATO </option>
            <option value="SAN MARTIN  ">SAN MARTIN </option>
            <option value="GODOY CRUZ  ">GODOY CRUZ </option>
            <option value="SAN RAFAEL  ">SAN RAFAEL </option>
            <option value="CAPITAL     ">CAPITAL </option>
            <option value="LUJAN       ">LUJAN </option>
            <option value="MAIPU       ">MAIPU </option>
        </select>
    </div>
</div>


<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nacimiento_at', 'Fecha Nacimiento:') !!}
    {!! Form::date('nacimiento_at', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">

    <div class="form-group">
        <label>Sexo:</label>

        @if( Route::currentRouteName()=="artesanos.create" )

            <select class="form-control" name="sexo" id="sexo" value="" }}>
            <option style="display:none;"></option> 
 
        @endif        

        @if( Route::currentRouteName()=="artesanos.edit" )
            
            <select class="form-control" name="sexo" id="departamento" value="{{$artesano->sexo}}" }}>        
 
        @endif        
            <option>F</option>
            <option>M</option>
            <option>X</option>

        </select>

    </div>
</div>