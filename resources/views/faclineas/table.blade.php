<div class="table-responsive">
    <table class="table" id="faclineas-table">
        <thead>
        <tr>
            <th>Factura Id</th>
        <th>Inventario Id</th>
        <th>Cantidad</th>
        <th>Preciounit</th>
        <th>Importe</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($faclineas as $faclinea)
            <tr>
                <td>{{ $faclinea->factura_id }}</td>
            <td>{{ $faclinea->inventario_id }}</td>
            <td>{{ $faclinea->cantidad }}</td>
            <td>{{ $faclinea->preciounit }}</td>
            <td>{{ $faclinea->importe }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['faclineas.destroy', $faclinea->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('faclineas.show', [$faclinea->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('faclineas.edit', [$faclinea->id]) }}"
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
