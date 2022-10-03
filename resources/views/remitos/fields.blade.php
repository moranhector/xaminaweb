<!-- Descrip Field -->



<div class="container">    
    <div class="row"> 
    
        <div class="col-sm-6">
            <label for="remito_descrip">Descripción:</label>
            <input class="form-control" name="remito_descrip" type="text" id="remito_descrip">
        </div>

        <!-- Fecha Field -->
        <div class="col-sm-2">
            <label for="fecha">Fecha:</label>
            <input class="form-control" id="fecha" name="fecha" type="text">
        </div>
    </div>
</div>





<div class="container">    
    <div class="row align-items-start">     
    <!-- Deposito Id From Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('deposito_id_from', 'Desde depósito:') !!}
        {!! Form::select('deposito_id_from', $depositoItems, null, ['class' => 'form-control custom-select']) !!}
    </div>


    <!-- Deposito Id To Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('deposito_id_to', 'Hacia Depósito:') !!}
        {!! Form::select('deposito_id_to', $depositoItems, null, ['class' => 'form-control custom-select']) !!}
    </div>
    </div>
</div>




<!-- User Name Field
<div class="form-group col-sm-6">
    {!! Form::label('user_name', 'User Name:') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
</div> -->




