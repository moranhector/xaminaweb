<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Importe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('importe', 'Importe:') !!}
    {!! Form::text('importe', null, ['class' => 'form-control']) !!}
</div>

<!-- Ncuenta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ncuenta', 'Ncuenta:') !!}
    {!! Form::text('ncuenta', null, ['class' => 'form-control']) !!}
</div>

<!-- Depositado Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('depositado', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('depositado', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('depositado', 'Depositado', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Saldo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('saldo', 'Saldo:') !!}
    {!! Form::text('saldo', null, ['class' => 'form-control']) !!}
</div>