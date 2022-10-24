<div class="table-responsive">
    <table class="table" id="existencias-table">
        <thead>
        <tr>
        <th>Id</th>
        <th>Número de Pieza</th>
        <th>Descripción</th>
        <th>Tipo de pieza</th>
        <th>Depósito</th>
 
        <th>Documento</th>
 
        <th>Documento Salida</th>
        <th>Fecha Desde</th>
        <th>Fecha Hasta</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($existencias as $existencia)
            <tr>
                <td>{{ $existencia->inventario_id }}</td>
                <td>{{ $existencia->npieza }}</td>
                <td>{{ $existencia->namepieza }}</td>
                <td>{{ $existencia->descrip }}</td>
                <td>{{ $existencia->nombre }}</td>
 
            <td>{{ $existencia->documento }}</td>
 
            <td>{{ $existencia->documento_sal }}</td>
             
            <td>{{ \Carbon\Carbon::parse($existencia->fecha_desde)->format('d/m/Y') }}</td>             
            
          
            <td>{{ \Carbon\Carbon::parse($existencia->fecha_hasta)->format('d/m/Y') }}</td>             
                <td width="120">
                    {!! Form::open(['route' => ['existencias.destroy', $existencia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('existencias.show', [$existencia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('existencias.edit', [$existencia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de eliminar este registro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
