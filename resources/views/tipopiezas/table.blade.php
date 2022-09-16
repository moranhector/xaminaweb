<div class="table-responsive">
    <table class="table" id="tipopiezas-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Descripción</th>
        <th>Técnica</th>
        <th>Rubro Id</th>
        <th>Insumo</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tipopiezas as $tipopieza)
            <tr>
                <td>{{ $tipopieza->id }}</td>
            <td>{{ $tipopieza->descrip }}</td>
            <td>{{ $tipopieza->tecnica }}</td>
            <td>{{ $tipopieza->rubro_id }}</td>
            <td>{{ $tipopieza->insumo }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tipopiezas.destroy', $tipopieza->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tipopiezas.show', [$tipopieza->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tipopiezas.edit', [$tipopieza->id]) }}"
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
