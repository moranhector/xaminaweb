<div class="table-responsive">
    <table class="table" id="remitos-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Descripción</th>
        <th>Fecha</th>
        <th>Desde depósito</th>
        <th>Hacia depósito</th>
        
        <th>Piezas</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($remitos as $remito)
            <tr>
            <td>{{ $remito->id }}</td>
            <td>{{ $remito->descrip }}</td>
             
            <td>{{ \Carbon\Carbon::parse($remito->fecha)->format('d/m/Y') }}</td>            
            <td>{{ $remito->deposito_desde }}</td>
            <td>{{ $remito->deposito_hacia }}</td>
            <td>{{ $remito->cantidad }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['remitos.destroy', $remito->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('remitos.show', [$remito->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                        @can('REMITOS-EDITAR')   
                        <a href="{{ route('remitos.edit', [$remito->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                          @endcan

                        @can('REMITOS-BORRAR')   
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
