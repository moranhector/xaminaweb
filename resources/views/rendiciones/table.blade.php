<div class="table-responsive">
    <table class="table" id="rendiciones-table">
        <thead>
        <tr>
            <th>Cheque Id</th>
        <th>Inventario Id</th>
        <th>Recibo Id</th>
        <th>Importe</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rendiciones as $rendicion)
            <tr>
                <td>{{ $rendicion->cheque_id }}</td>
            <td>{{ $rendicion->inventario_id }}</td>
            <td>{{ $rendicion->recibo_id }}</td>
            <td>{{ $rendicion->importe }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['rendiciones.destroy', $rendicion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('rendiciones.show', [$rendicion->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('rendiciones.edit', [$rendicion->id]) }}"
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
