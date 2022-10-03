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
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($remitos as $remito)
            <tr>
                <td>{{ $remito->descrip }}</td>
                <td>{{ $remito->id }}</td>
            <td>{{ $remito->fecha }}</td>
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
