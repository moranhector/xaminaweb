<div class="table-responsive">
    <table class="table" id="inventarios-table">
        <thead>
        <tr>
 
        <th>Pieza Nº</th>            
        <th>Código Ean13</th>
        <th>Nombre de la pieza</th>            
        <th>Ean13</th>
        <th>Precio</th>
        <th>Costo</th>        
        <th>Fecha Compra</th>                
        <th>Fecha Venta</th>                
        <th>Depósito</th>                
        <!-- <th>Comprob</th> -->
        <!-- <th>Recibo Id</th>
        <th>Factura</th>
        <th>Factura Id</th>
        <th>Costo</th>
   
        <th>Artesano Id</th>
        <th>Comprado At</th>
        <th>Vendido At</th>
        <th>Precio</th>
        <th>Precio At</th>
        <th>Foto</th> -->
            <!-- <th colspan="3">Action</th> -->
        </tr>
        </thead>
        <tbody>
        @foreach($inventarios as $inventario)
            <tr>
            <td>{{ $inventario->npieza }}</td>                
                <td>{{ $inventario->codigo12 }}</td>
                <td>{{ $inventario->namepieza }}</td>                
                <!-- CODIGO DE BARRAS -->
                <!-- <td>{!! DNS1D::getBarcodeHTML((string) time(), 'EAN13') !!}</td> -->
                <td>{!! DNS1D::getBarcodeHTML( $inventario->codigo12 , 'EAN13') !!}</td>
                <td>{{ $inventario->precio }}</td>                                          
                <td>{{ $inventario->costo }}</td>   
                <td>{{ american2french( $inventario->comprado_at  ) }}</td>    
                <td>{{ american2french( $inventario->vendido_at  ) }}</td>    
                <td>{{ $inventario->deposito }}</td>    
            <!-- <td>{ { $inventario->comprob } }</td> -->
            <!-- <td>{ { $inventario->recibo_id } }</td>
            <td>{ { $inventario->factura }}</td>
            <td>{ { $inventario->factura_id }}</td>
            <td>{ { $inventario->costo }}</td>
         
            <td>{ { $inventario->artesano_id }}</td>
            <td>{ { $inventario->comprado_at }}</td>
            <td>{ { $inventario->vendido_at }}</td>
            <td>{ { $inventario->precio }}</td>
            <td>{ { $inventario->precio_at }}</td>
            <td>{ { $inventario->foto }}</td> -->
                <!-- <td width="120">
                   
                    <div class='btn-group'>
                        <a href=" {  route('inventarios.show', [$inventario->id]) } }"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href=" { { route('inventarios.edit', [$inventario->id]) } }"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
   
                    </div>
                   
                </td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
