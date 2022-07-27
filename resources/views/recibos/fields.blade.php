<!-- Formulario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('formulario', 'Formulario:') !!}
    {!! Form::text('formulario', null, ['class' => 'form-control']) !!}
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

<!-- Artesano Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('artesano_id', 'Artesano Id:') !!}
    {!! Form::select('artesano_id', $artesanoItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::text('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Cheque Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cheque_id', 'Cheque Id:') !!}
    {!! Form::select('cheque_id', $chequeItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Rendido Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('rendido', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('rendido', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('rendido', 'Rendido', ['class' => 'form-check-label']) !!}
    </div>
</div>
