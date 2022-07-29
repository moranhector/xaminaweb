<script language="JavaScript">

function abre_buscador() { 
   var nwin = window.open("{{ route('seleccionar_artesanos') }}","abookpopup","width=400,height=500,resizable=yes,scrollbars=yes;location=no");
  if((!nwin.opener) && (document.windows != null))
   nwin.opener = document.windows;
}

</script>







<div class="row">
        <!-- CELDA documento  -->
        <div class="col-md-3">
            <div class="{{ $errors->has('documento') ? 'has-error' : '' }}">
                <label class="form-control-label" for="documento">Documento</label>                 
                <div>
                    <input class="form-control" name="documento" type="text" id="documento" value="{{ old('documento', optional($recibo)->documento) }}" minlength="1" maxlength="11" readonly >
                    {!! $errors->first('dni', '<p class="help-block">:message</p>') !!}

                    <input  type=button class="btn btn-primary" value="Selección de Artesanos" onclick="abre_buscador()" >



                </div>
            </div>
        </div>
        <!-- FIN CELDA dni  -->


        <div class="col-md-6">
            <div class="{{ $errors->has('nombre') ? 'has-error' : '' }}">
                <label class="form-control-label" for="tipo">Nombre del Artesano</label>         
                <div>
                    <input class="form-control" name="nombre" type="text" id="nombre" value="{{ old('nombre', optional($recibo)->nombre) }}" minlength="1" readonly>
                    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        </div>



</div>







<div class="form-group row">

<!-- <div class="col-md-4" >

        <div class="{ { $errors->has('tipo') ? 'has-error' : '' } }">
            <label class="form-control-label" for="tipo">Tipo</label>            
            <div>

            <input class="form-control" name="tipo" type="text" id="tipo" value="{ { $tipofactura } }" readonly >

                
                { ! ! $errors->first('tipo', '<p class="help-block">:message</p>') ! ! }
            </div>
        </div>

</div> -->

<!-- <div class="col-md-4">

        <div class="{ { $errors->has('ptovta') ? 'has-error' : '' } }">
            <label class="form-control-label" for="ptovta">Punto de Venta</label>                        

            <div>
                <select class="form-control" id="ptovta" name="ptovta">
                        <option value="" style="display: none;" { { old('ptovta', optional($factura)->ptovta ?: '') == '' ? 'selected' : '' } } disabled selected>Seleccione</option>
                    @foreach (['0001' => '0001',         '0002' => '0002',         '0003' => '0003',         '0004' => '0004'] as $key => $text)
                        <option value="{ { $key } }" { { old('ptovta', optional($factura)->ptovta) == $key ? 'selected' : '' } }>
                            { { $text } }
                        </option>
                    @endforeach
                </select>
                
                 { ! $errors->first('ptovta', '<p class="help-block">:message</p>') ! !}
            </div>
        </div>

</div> -->
<div class="col-md-4">        
        
        <div class="{{ $errors->has('nrocomp') ? 'has-error' : '' }}">
            <label class="form-control-label" for="nrocomp">Número Recibo</label>  
            <div>
                <input class="form-control" name="formulario" type="text" id="formulario" value="{{ $nuevo_formulario }}" minlength="1" maxlength="8">
                {!! $errors->first('nrocomp', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

</div>
</div>





<div class="form-group row">



<div class="col-md-4">
        <label class="form-control-label" for="articulo">Tipo de Pieza</label>

      
        <!--<input type="number" id="articulo" name="articulo" class="form-control" > -->

        <select class="form-control selectpicker" name="id_producto" id="id_producto" data-live-search="true" >
                                                            
            <option value="0" selected>Seleccione tipo de pieza</option>
                                                            
            @foreach($articulos as $artic)
                                                            
                <option value="{{$artic->id}}_{{$artic->precio}}_{{$artic->articulo}}">{{$artic->articulo}}</option>
                                                                    
            @endforeach
                                
        </select>




</div>


<div class="col-md-2">
        <label class="form-control-label" for="precio_venta">Precio</label>
        
        <input type="text"  id="precio" name="precio_venta" class="form-control" placeholder="Precio de compra" >
</div>



<div class="col-md-2">
        <label class="form-control-label" for="cantidad">Cantidad</label>
        
        <input type="text"   id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" pattern="[0-9]{0,15}">
</div>


</div>



<div class="col-md-4">
        
    <button type="button" id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>
</div>






<div class="form-group row border">

<h3>Detalle de Recibo</h3>

<div class="table-responsive col-md-12">
  <table id="detalles" class="table table-bordered table-striped table-sm">
  <thead>
      <tr class="bg-success">
          <th>Acción</th>
          <th>Tipo Pieza</th>
          <th>Precio $</th>
          <th>Cantidad</th>
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



