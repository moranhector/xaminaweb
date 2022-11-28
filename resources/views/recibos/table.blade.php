<div class="table-responsive">
    <table class="table" id="recibos-table">
        <thead>
        <tr>
            <th>Formulario</th>
        <th>Fecha</th>
        <!-- <th>Artesano Id</th> -->
        <th>Artesano</th>
        <th STYLE="text-align: right;" >Total</th>
        <!-- <th>Cheque Id</th> -->
        <th>Cheque Número</th>
        <!-- <th>Rendido</th> -->
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($recibos as $recibo)
            <tr>
                <td>{{ $recibo->formulario }}</td>
           
            <td>{{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}</td>                 
            <!-- <td>{{ $recibo->artesano_id }}</td> -->
            <td>{{ $recibo->nombre }}</td>
            <td STYLE="text-align: right;" >{{ $recibo->total }}</td>
            <!-- <td>{{ $recibo->cheque_id }}</td> -->
            <td>{{ $recibo->numero }}</td>
            <!-- <td>{{ $recibo->rendido }}</td> -->
                <td width="120">
                    {!! Form::open(['route' => ['recibos.destroy', $recibo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('recibos.show', [$recibo->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                        @can('RECIBOS-EDITAR') 
                        <a href="{{ route('recibos.edit', [$recibo->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan

                        @can('RECIBOS-BORRAR')  
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
