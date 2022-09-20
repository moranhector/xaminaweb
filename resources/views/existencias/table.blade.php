<div class="table-responsive">
    <table class="table" id="existencias-table">
        <thead>
        <tr>
            <th>Inventario Id</th>
        <th>Tipodoc</th>
        <th>Documento</th>
        <th>Deposito Id</th>
        <th>Tiposalida</th>
        <th>Documento Sal</th>
        <th>Fecha Desde</th>
        <th>Fecha Hasta</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($existencias as $existencia)
            <tr>
                <td>{{ $existencia->inventario_id }}</td>
            <td>{{ $existencia->tipodoc }}</td>
            <td>{{ $existencia->documento }}</td>
            <td>{{ $existencia->deposito_id }}</td>
            <td>{{ $existencia->tiposalida }}</td>
            <td>{{ $existencia->documento_sal }}</td>
            <td>{{ $existencia->fecha_desde }}</td>
            <td>{{ $existencia->fecha_hasta }}</td>
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
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
