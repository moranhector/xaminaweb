<!-- Tipo Field -->
<div class="col-sm-12">
    {!! Form::label('tipo', 'Tipo:') !!}
    <p>{{ $talonario->tipo }}</p>
</div>

<!-- Ptoventa Field -->
<div class="col-sm-12">
    {!! Form::label('ptoventa', 'Ptoventa:') !!}
    <p>{{ $talonario->ptoventa }}</p>
</div>

<!-- Proximodoc Field -->
<div class="col-sm-12">
    {!! Form::label('proximodoc', 'Proximodoc:') !!}
    <p>{{ $talonario->proximodoc }}</p>
</div>

<!-- Fechavto Field -->
<div class="col-sm-12">
    {!! Form::label('fechavto', 'Fechavto:') !!}
    <p>{{ $talonario->fechavto }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $talonario->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $talonario->updated_at }}</p>
</div>

