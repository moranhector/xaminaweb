<!-- Descrip Field -->



 
    
    
        <div class="col-sm-6">
            <label for="remito_descrip">Descripción:</label>
            <input class="form-control" name="remito_descrip" type="text" id="remito_descrip" placeholder="Descripción">
        </div>

        <!-- Fecha Field -->
        <div class="col-sm-2">
            <label for="fecha">Fecha:</label>
            <input class="form-control" id="fecha" name="fecha" type="text" value= {{ $fecha_hoy }} >
        </div>

        <div class="row">
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

     
 


 





