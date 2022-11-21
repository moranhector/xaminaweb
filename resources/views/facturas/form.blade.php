<!-- INCLUIR ESTA LINEA PARA LOS FORMULARIOS MODALES DE INICIO -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>



<style type="text/css">


.clock .display {
    font-size: 14px;
    color: white;
    letter-spacing: 1px;
    font-family: 'Orbitron', sans-serif;
}

.tabla_head {

    background:#FE6602;
    border-right:1px solid #ddd; 
    border-bottom:1px solid #ddd;"
}



/*EL MEDIA ES PARA PC*/
@media (min-width: 768px) {

    #titulo {
        font-family: "Open Sans";
        font-weight: bold;
        text-align: center;
        font-size: 45px;
        color: #8A1538;
        padding-top: 20px;
    }



    .leyendas {
        font-size: 40px;
    }



}
</style>



<script language="JavaScript">
function abre_buscador() {
    var nwin = window.open("{{ route('seleccionar_clientes') }}", "abookpopup",
        "width=400,height=500,resizable=yes,scrollbars=yes;location=no");
    if ((!nwin.opener) && (document.windows != null))
        nwin.opener = document.windows;
}
</script>

<!-- SELECCION DE DEPOSITO -->
<!-- SELECCION DE DEPOSITO -->
<!-- SELECCION DE DEPOSITO -->


<script type="text/javascript">
    $(window).on('load', function() {
        cliente = $('#documento').val()    ;
        console.log( "longitud del documento" , cliente.length);
        //EVITAR QUE SE RECARGUE EL DEPOSITO ANTE UN ERROR
        if ( cliente.length == 0) // Solo si es la primera vez que entra al formulario
        {
             $('#myModal').modal('show');
        }
    });
</script>

<script type="text/javascript">
    function cerrarmodal(){
    // alert("si");
    //nombre_deposito = $("#deposito_id").val();
    nombre_deposito = $('#deposito_id option:selected').text()  //ACA ME TRAIGO EL NOMBRE DEL DEPOSITO NO EL ID
    $("#deposito").val( nombre_deposito ) ;
    $('#myModal').modal('toggle');
    $('#documento').focus();    //ACA PONGO EL CURSOR PARA SELECCIONAR UN CLIENTE
}
</script>

<!-- FIN SELECCION DE DEPOSITO -->
<!-- FIN SELECCION DE DEPOSITO -->
<!-- FIN SELECCION DE DEPOSITO -->



@include('flash::message')

<div class="row">
    <div class="col-md-2">
        <label class="form-control-label" for="articulo">Depósito</label>

        <input type="text" id="deposito" name="deposito" READONLY >


 




    </div>
</div>









<div class="row">
    <!-- CELDA documento  -->
    <div class="col-md-2">
        <div class="{{ $errors->has('documento') ? 'has-error' : '' }}">
            <label class="form-control-label" for="documento">Documento / CUIL</label>
            <div>
                <input class="form-control" name="documento" type="text" id="documento"
                    value="{{ old('documento', optional($factura)->documento) }}" minlength="1" maxlength="11">
                {!! $errors->first('dni', '<p class="help-block">:message</p>') !!}

                <input type=button class="btn btn-primary" value="Selección de Clientes" onclick="abre_buscador()">



            </div>
        </div>
    </div>
    <!-- FIN CELDA dni  -->


    <div class="col-md-4">
        <div class="{{ $errors->has('cliente_nombre') ? 'has-error' : '' }}">
            <label class="form-control-label" for="tipo">Nombre del Cliente</label>
            <div>
                <input class="form-control" name="cliente_nombre" type="text" id="cliente_nombre"
                    value="{{ old('cliente_nombre', optional($factura)->cliente_nombre) }}" minlength="1">
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
                <input class="form-control" name="formulario" type="number" id="formulario"
                    value="{{ $nueva_factura }}">
                {!! $errors->first('nrocomp', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

    </div>

    <div class="col-md-2">

        <div class="{{ $errors->has('fecha') ? 'has-error' : '' }}">
            <label class="form-control-label" for="fecha">Fecha</label>
            <div>

                <input class="form-control" name="fecha" type="text" id="fecha" value={{ $fecha }}>
                {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

    </div>











</div>






<div class="form-group row">






    <input type="hidden" id="id_inventario" name="id_inventario" class="form-control">

    <!--  

▄▀█ ░░█ ▄▀█ ▀▄▀
█▀█ █▄█ █▀█ █░█

insertar pieza en renglones
 -->

    <input type="text" id="inventario_id" HIDDEN >   
    <!-- Este campo invisible alojará el ID de la  pieza -->

    <div class="col-md-2">
        <label class="form-control-label" for="pieza">Pieza [Tab]</label>

        <input type="text" id="pieza" name="pieza" class="form-control" placeholder="pieza">
        <div id="success_message"></div>
    </div>



    <div class="col-md-2">
        <label class="form-control-label" for="descrip">Descripción</label>

        <input type="text" id="descrip" name="descrip" class="form-control">
    </div>


    <div class="col-md-2">
        <label class="form-control-label" for="precio_venta">Precio</label>

        <input type="text" id="precio_venta" name="precio_venta" class="form-control">
    </div>








</div>



<div class="col-md-4">

    <button type="button" id="add_detail" class="btn btn-primary">Agregar
        renglón</button>
</div>






<div class="form-group row border">



    <div class="table-responsive col-md-8">
        <table id="detalles" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="bg-success">
                    <th class="tabla_head">Acción</th>
                    <th class="tabla_head">Pieza</th>
                    <th class="tabla_head">Descripción</th>
                    <th class="tabla_head">Precio $</th>
                    <th class="tabla_head">Subtotal $</th>
                </tr>
            </thead>

            <tfoot>




                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden"
                                name="total_pagar" id="total_pagar"></p>
                    </th>
                </tr>

            </tfoot>

            <tbody>
            </tbody>


        </table>
    </div>

</div>







<!-- <div class="text-center">      SELECCIONAR DEPOSITO 
    <a href="#myModal" class="trigger-btn" data-toggle="modal">Seleccionar Depósito</a>
</div> -->

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Facturar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <label class="form-control-label" for="articulo">Por favor seleccione Depósito</label>




                <select class="form-control selectpicker" name="id_deposito" id="deposito_id" data-live-search="true">

              

                    @foreach($depositos as $deposito)

                    <option value="{{ $deposito->id }}">{{$deposito->nombre}}</option>

                    @endforeach

                </select>

                <button type="button" class="btn btn-primary" onclick="cerrarmodal()" >Aceptar</button><!-- Boton que va a la función para cerrar la ventana modal-->

            </div>


             
        </div>
    </div>
</div>