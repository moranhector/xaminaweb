<!-- Descrip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descrip', 'Descrip:') !!}
    {!! Form::text('descrip', null, ['class' => 'form-control']) !!}
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

<!-- Deposito Id From Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposito_id_from', 'Deposito Id From:') !!}
    {!! Form::select('deposito_id_from', $depositoItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Deposito Id To Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposito_id_to', 'Deposito Id To:') !!}
    {!! Form::select('deposito_id_to', $depositoItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', 'User Name:') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
</div>