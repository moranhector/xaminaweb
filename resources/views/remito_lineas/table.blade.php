<div class="table-responsive">
    <table class="table" id="remitoLineas-table">
        <thead>
        <tr>
            <th>Remito Id</th>
        <th>Inventario Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($remitoLineas as $remitoLinea)
            <tr>
                <td>{{ $remitoLinea->remito_id }}</td>
            <td>{{ $remitoLinea->inventario_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['remitoLineas.destroy', $remitoLinea->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('remitoLineas.show', [$remitoLinea->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('remitoLineas.edit', [$remitoLinea->id]) }}"
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
