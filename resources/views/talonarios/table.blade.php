<div class="table-responsive">
    <table class="table" id="talonarios-table">
        <thead>
        <tr>
            <th>Tipo Documento</th>
        <!-- <th>Ptoventa</th> -->
        <th>Próximo</th>
        <!-- <th>Fecha vencimiento</th> -->
        <th>Ultima Actualización</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($talonarios as $talonario)
            <tr>
                <td>{{ $talonario->tipo }}</td>
            <!-- <td>{{ $talonario->ptoventa }}</td> -->
            <td>{{ $talonario->proximodoc }}</td>
            <!-- <td>{{ $talonario->fechavto }}</td> -->
             
            <td>{{ american2french( $talonario->updated_at ) }}<b> {{\Carbon\Carbon::parse( $talonario->updated_at   )->diffForHumans() }}</b></td> 
                <td width="120">
                    {!! Form::open(['route' => ['talonarios.destroy', $talonario->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('talonarios.show', [$talonario->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                        @can('TALONARIOS-EDITAR')
                        <a href="{{ route('talonarios.edit', [$talonario->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan

                        @can('TALONARIOS-BORRAR')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de eliminar este registro?')"]) !!}
                        @endcan

                        

                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
