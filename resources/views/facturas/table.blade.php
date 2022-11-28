<div class="table-responsive">
    <table class="table" id="facturas-table">
        <thead>
        <tr>
            <th>Formulario</th>
        <th>Punto venta</th>
        <th>Tipo</th>
        <th>Fecha</th>
        <th>Cliente Id</th>
        <th>Total</th>
        <th>Documento</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($facturas as $factura)
            <tr>
                <td>{{ $factura->formulario }}</td>
            <td>{{ $factura->ptovta }}</td>
            <td>{{ $factura->tipo }}</td>
            
            <td>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>                 
            <td>{{ $factura->cliente_id }}</td>
            <td>{{ $factura->total }}</td>
            <td>{{ $factura->documento }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('facturas.show', [$factura->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                        @can('FACTURAS-EDITAR')  
                        <a href="{{ route('facturas.edit', [$factura->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                         @endcan

                        @can('FACTURAS-BORRAR') 
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan



                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
