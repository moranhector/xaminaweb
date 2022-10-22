<div class="table-responsive">
    <table class="table" id="estudiantes-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Documento</th>
        <th>Direccion</th>
        <th>Departamento</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->nombre }}</td>
            <td>{{ $estudiante->documento }}</td>
            <td>{{ $estudiante->direccion }}</td>
            <td>{{ $estudiante->departamento }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['estudiantes.destroy', $estudiante->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('estudiantes.show', [$estudiante->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('estudiantes.edit', [$estudiante->id]) }}"
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
