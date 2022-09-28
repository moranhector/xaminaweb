<script language="JavaScript">

function abre_buscador() { 
   var nwin = window.open("{{ route('seleccionar_clientes') }}","abookpopup","width=400,height=500,resizable=yes,scrollbars=yes;location=no");
  if((!nwin.opener) && (document.windows != null))
   nwin.opener = document.windows;
}






</script>





@include('flash::message') 

<div class="row">
        <!-- CELDA documento  -->
        <div class="col-md-2">
            <div class="{{ $errors->has('documento') ? 'has-error' : '' }}">
                <label class="form-control-label" for="documento">Documento / CUIL</label>                 
                <div>
                    <input class="form-control" name="documento" type="text" id="documento" value="{{ old('documento', optional($factura)->documento) }}" minlength="1" maxlength="11"  >
                    {!! $errors->first('dni', '<p class="help-block">:message</p>') !!}

                    <input  type=button class="btn btn-primary" value="Selección de Clientes" onclick="abre_buscador()" >



                </div>
            </div>
        </div>
        <!-- FIN CELDA dni  -->


        <div class="col-md-4">
            <div class="{{ $errors->has('cliente_nombre') ? 'has-error' : '' }}">
                <label class="form-control-label" for="tipo">Nombre del Cliente</label>         
                <div>
                    <input class="form-control" name="cliente_nombre" type="text" id="cliente_nombre" value="{{ old('cliente_nombre', optional($factura)->cliente_nombre) }}" minlength="1" >
                    {!! $errors->first('cliente_nombre', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        </div>



</div>


<div class="form-group row">


    <div class="col-md-2">        
            
            <div class="{{ $errors->has('nrocomp') ? 'has-error' : '' }}">
                <label class="form-control-label" for="nrocomp">Número Factura</label>  
                <div>
                    <input class="form-control" name="formulario" type="number" id="formulario" value="{{ $nueva_factura }}">
                    {!! $errors->first('nrocomp', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

    </div>

    <div class="col-md-2">        
        
        <div class="{{ $errors->has('fecha') ? 'has-error' : '' }}">
            <label class="form-control-label" for="fecha">Fecha</label>  
            <div>
                <input class="form-control" name="fecha" type="date" id="fecha" value="{{ $fecha }}" >
                {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

    </div>








    


</div>






<div class="form-group row">



 


            <input type="hidden"  id="id_inventario" name="id_inventario" class="form-control"   >

<!--  

▄▀█ ░░█ ▄▀█ ▀▄▀
█▀█ █▄█ █▀█ █░█

insertar pieza en renglones
 -->

    <div class="col-md-2">
            <label class="form-control-label" for="pieza">Pieza</label>
            
            <input type="text"  id="pieza" name="pieza" class="form-control" placeholder="pieza" >
            <div id="success_message"></div>
    </div>  

    

    <div class="col-md-2">
            <label class="form-control-label" for="descrip">Descripción</label>
            
            <input type="text"  id="descrip" name="descrip" class="form-control"   >
    </div>      


    <div class="col-md-2">
            <label class="form-control-label" for="precio_venta">Precio</label>
            
            <input type="text"  id="precio_venta" name="precio_venta" class="form-control"   >
    </div>

  






</div>



<div class="col-md-4">
        
    <button type="button" id="add_detail" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar renglon</button>
</div>






<div class="form-group row border">



<div class="table-responsive col-md-8">
  <table id="detalles" class="table table-bordered table-striped table-sm">
  <thead>
      <tr class="bg-success">
          <th>Acción</th>
          <th>Pieza</th>
          <th>Descripción</th>
          <th>Precio $</th>
          <th>Subtotal $</th>
      </tr>
  </thead>
   
  <tfoot>




      <tr>
          <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
          <th><p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden" name="total_pagar" id="total_pagar"></p></th>
      </tr>  

  </tfoot>

  <tbody>
  </tbody>
  
  
  </table>
</div>

</div>

