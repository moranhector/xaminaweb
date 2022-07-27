<div class="table-responsive">
    <table class="table" id="recibosLineas-table">
        <thead>
        <tr>
            <th>Recibo Id</th>
        <th>Tipopieza Id</th>
        <th>Cantidad</th>
        <th>Preciounit</th>
        <th>Importe</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($recibosLineas as $recibosLineas)
            <tr>
                <td>{{ $recibosLineas->recibo_id }}</td>
            <td>{{ $recibosLineas->tipopieza_id }}</td>
            <td>{{ $recibosLineas->cantidad }}</td>
            <td>{{ $recibosLineas->preciounit }}</td>
            <td>{{ $recibosLineas->importe }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['recibosLineas.destroy', $recibosLineas->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('recibosLineas.show', [$recibosLineas->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('recibosLineas.edit', [$recibosLineas->id]) }}"
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
