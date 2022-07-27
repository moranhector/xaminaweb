<div class="table-responsive">
    <table class="table" id="recibos-table">
        <thead>
        <tr>
            <th>Formulario</th>
        <th>Fecha</th>
        <th>Artesano Id</th>
        <th>Total</th>
        <th>Cheque Id</th>
        <th>Rendido</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($recibos as $recibo)
            <tr>
                <td>{{ $recibo->formulario }}</td>
            <td>{{ $recibo->fecha }}</td>
            <td>{{ $recibo->artesano_id }}</td>
            <td>{{ $recibo->total }}</td>
            <td>{{ $recibo->cheque_id }}</td>
            <td>{{ $recibo->rendido }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['recibos.destroy', $recibo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('recibos.show', [$recibo->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('recibos.edit', [$recibo->id]) }}"
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
