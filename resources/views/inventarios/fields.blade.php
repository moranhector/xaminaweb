 

<div class="form-group col-sm-6">
    <label for="codigo12">Codigo12:</label>
    <input class="form-control" name="codigo12" type="text" value="{{ $inventario->codigo12 }}" id="codigo12" READONLY >
</div>



<!-- Tipopieza Id Field -->
<div class="form-group col-sm-6">
 
    <label for="tipopieza_id">Tipo de Pieza:</label>
    <input class="form-control" name="tipopieza_id" type="text" value="{{ $inventario->tipopieza_id }}" id="tipopieza_id" READONLY >    
</div>

<!-- Npieza Field -->
 

<div class="form-group col-sm-6">
    <label for="npieza">Número:</label>
    <input class="form-control" name="npieza" type="text" value="{{ $inventario->npieza }}" id="npieza"  READONLY >
</div>

<!-- Namepieza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('namepieza', 'Nombre de Pieza:') !!}
    {!! Form::text('namepieza', null, ['class' => 'form-control']) !!}
</div>

<!-- Comprob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comprob', 'Recibo Compra:') !!}

    
    <input class="form-control" name="comprob" type="text" value="{{ $inventario->comprob }}" id="comprob"  READONLY >    
</div>

 

<!-- Factura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('factura', 'Factura de Venta:') !!}


    <input class="form-control" name="factura" type="text" value="{{ $inventario->factura }}" id="factura"  READONLY >     
</div>

 

<!-- Costo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('costo', 'Costo:') !!}

    
    <input class="form-control" name="costo" type="text" value="{{ $inventario->costo }}" id="costo"  READONLY >      
</div>

 

<!-- Artesano Id Field
<div class="form-group col-sm-6">
    { ! ! Form::label('artesano_id', 'Artesano Id:') ! ! }
    { ! ! Form::text('artesano_id', null, ['class' => 'form-control']) ! ! }
</div> -->

<!-- Comprado At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comprado_at', 'Fecha Compra:') !!}
    <input class="form-control" name="comprado_at" type="text" value="{{  ( $inventario->comprado_at ) }}" id="comprado_at"  READONLY >     
 
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#comprado_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Vendido At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vendido_at', 'Fecha Venta:') !!}

 
    <input class="form-control" name="vendido_at" type="text" value="{{  ( $inventario->vendido_at ) }}" id="vendido_at"  READONLY >      
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#vendido_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::text('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_at', 'Ultimo Cambio de Precio:') !!}
 
    <input class="form-control" name="precio_at" type="text" value="{{  ( $inventario->precio_at ) }}" id="precio_at"  READONLY >      

</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#precio_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Foto Field
<div class="form-group col-sm-6">
    { ! ! Form::label('foto', 'Foto:') ! ! }
    { ! ! Form::text('foto', null, ['class' => 'form-control']) ! ! }
</div> -->