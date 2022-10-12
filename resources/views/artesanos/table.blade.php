<div class="table-responsive">
    <table class="table" id="artesanos-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Documento</th>
        <th>Direccion</th>
        <th>Lugar</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artesanos as $artesano)
            <tr>
                <td>{{ $artesano->nombre }}</td>
            <td>{{ $artesano->documento }}</td>
            <td>{{ $artesano->direccion }}</td>
            <td>{{ $artesano->lugar }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['artesanos.destroy', $artesano->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('artesanos.show', [$artesano->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('artesanos.edit', [$artesano->id]) }}"
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
