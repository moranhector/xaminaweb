<div class="table-responsive">
    <table class="table" id="depositos-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>User Name</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($depositos as $deposito)
            <tr>
                <td>{{ $deposito->nombre }}</td>
            <td>{{ $deposito->user_name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['depositos.destroy', $deposito->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('depositos.show', [$deposito->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('depositos.edit', [$deposito->id]) }}"
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
