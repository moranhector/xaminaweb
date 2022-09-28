<div class="table-responsive">
    <table class="table" id="rubros-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Descripción</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rubros as $rubro)
            <tr>
                <td>{{ $rubro->id }}</td>
            <td>{{ $rubro->descrip }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['rubros.destroy', $rubro->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('rubros.show', [$rubro->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('rubros.edit', [$rubro->id]) }}"
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
