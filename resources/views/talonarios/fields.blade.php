<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
</div>

<!-- Ptoventa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ptoventa', 'Ptoventa:') !!}
    {!! Form::text('ptoventa', null, ['class' => 'form-control']) !!}
</div>

<!-- Proximodoc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proximodoc', 'Proximodoc:') !!}
    {!! Form::text('proximodoc', null, ['class' => 'form-control']) !!}
</div>

<!-- Fechavto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fechavto', 'Fechavto:') !!}
    {!! Form::text('fechavto', null, ['class' => 'form-control','id'=>'fechavto']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fechavto').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush