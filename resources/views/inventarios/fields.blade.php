<!-- Codigo12 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo12', 'Codigo12:') !!}
    {!! Form::text('codigo12', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipopieza Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipopieza_id', 'Tipopieza Id:') !!}
    {!! Form::text('tipopieza_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Npieza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('npieza', 'Npieza:') !!}
    {!! Form::text('npieza', null, ['class' => 'form-control']) !!}
</div>

<!-- Namepieza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('namepieza', 'Namepieza:') !!}
    {!! Form::text('namepieza', null, ['class' => 'form-control']) !!}
</div>

<!-- Comprob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comprob', 'Comprob:') !!}
    {!! Form::text('comprob', null, ['class' => 'form-control']) !!}
</div>

<!-- Recibo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recibo_id', 'Recibo Id:') !!}
    {!! Form::text('recibo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Factura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('factura', 'Factura:') !!}
    {!! Form::text('factura', null, ['class' => 'form-control']) !!}
</div>

<!-- Factura Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    {!! Form::text('factura_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Costo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('costo', 'Costo:') !!}
    {!! Form::text('costo', null, ['class' => 'form-control']) !!}
</div>

<!-- Recargo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recargo', 'Recargo:') !!}
    {!! Form::text('recargo', null, ['class' => 'form-control']) !!}
</div>

<!-- Artesano Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('artesano_id', 'Artesano Id:') !!}
    {!! Form::text('artesano_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Comprado At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comprado_at', 'Comprado At:') !!}
    {!! Form::text('comprado_at', null, ['class' => 'form-control','id'=>'comprado_at']) !!}
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
    {!! Form::label('vendido_at', 'Vendido At:') !!}
    {!! Form::text('vendido_at', null, ['class' => 'form-control','id'=>'vendido_at']) !!}
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
    {!! Form::label('precio_at', 'Precio At:') !!}
    {!! Form::text('precio_at', null, ['class' => 'form-control','id'=>'precio_at']) !!}
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

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div>