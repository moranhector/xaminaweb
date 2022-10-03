<div class="table-responsive">
    <table class="table" id="remitos-table">
        <thead>
        <tr>
            <th>Descrip</th>
        <th>Fecha</th>
        <th>Deposito Id From</th>
        <th>Deposito Id To</th>
        <th>User Name</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($remitos as $remito)
            <tr>
                <td>{{ $remito->descrip }}</td>
            <td>{{ $remito->fecha }}</td>
            <td>{{ $remito->deposito_id_from }}</td>
            <td>{{ $remito->deposito_id_to }}</td>
            <td>{{ $remito->user_name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['remitos.destroy', $remito->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('remitos.show', [$remito->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('remitos.edit', [$remito->id]) }}"
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
