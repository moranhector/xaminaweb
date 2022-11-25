<div class="table-responsive">
    <table class="table" id="existencias-table">
        <thead>
        <tr>
        <th>Id</th>
        <th>Número de Pieza</th>
        <!-- <th>Ean13</th> -->
        <th>Descripción</th>
        <th>Tipo de pieza</th>
        <th>Depósito</th>
 
        <th>Tipo Doc</th>
        <th>Documento</th>
        <th>Tipo Doc</th>
 
        <th>Documento Salida</th>
        <th>Fecha Desde</th>
        <th>Fecha Hasta</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($existencias as $existencia)
            <tr>
                <td>{{ $existencia->inventario_id }}</td>
                <td>{{ $existencia->npieza }}</td>
                <!-- <td>{!! DNS1D::getBarcodeHTML( $existencia->codigo12 , 'EAN13') !!}</td> -->
                <td>{{ $existencia->namepieza }}</td>
                <td>{{ $existencia->descrip }}</td>
                <td>{{ $existencia->nombre }}</td>
 
            <td>{{ $existencia->tipodoc }}</td>
            <td>{{ $existencia->documento }}</td>
 
 
            <td>{{ $existencia->tiposalida }}</td>
            <td>{{ $existencia->documento_sal }}</td>
             
            <td>{{ \Carbon\Carbon::parse($existencia->fecha_desde)->format('d/m/Y') }}</td>             
            
          
            <td>{{ american2french($existencia->fecha_hasta) }}</td>     
                    
                <td width="120">
  
                    <div class='btn-group'>
                        <a href="{{ route('existencias.show', [$existencia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                    </div>
 
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
