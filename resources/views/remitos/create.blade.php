@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Registrar Remito</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::open(['route' => 'remitos.store']) !!}

        <div class="card-body">

 
            @include('remitos.fields')
 
            <div class="form-group row">

 
                <input type="hidden" id="id_inventario" name="id_inventario" class="form-control">

                <!--  

▄▀█ ░░█ ▄▀█ ▀▄▀
█▀█ █▄█ █▀█ █░█

insertar pieza en renglones
-->

                <div class="col-md-2">
                    <label class="form-control-label" for="pieza">Pieza</label>

                    <input type="text" id="pieza" name="pieza" class="form-control" placeholder="pieza">
                    <div id="success_message"></div>
                </div>



                <div class="col-md-2">
                    <label class="form-control-label" for="descrip">Descripción</label>

                    <input type="text" id="descrip" name="descrip" class="form-control">
                </div>


                <!-- <div class="col-md-2">
    <label class="form-control-label" for="precio_venta">Precio</label>

    <input type="text" id="precio_venta" name="precio_venta" class="form-control">
</div> -->




            </div>




            <div class="col-md-4">

                <button type="button" id="add_remito" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar
                    renglon</button>
            </div>






            <div class="form-group row border">



                <div class="table-responsive col-md-8">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-success">
                                <th>Acción</th>
                                <th>Pieza</th>
                                <th>Descripción</th>
                                <th> &nbsp </th>

                            </tr>
                        </thead>

                        <tfoot>




                            <tr>
                                <th> &nbsp </th>
                                <th> &nbsp </th>

                                <th>
                                    <p align="right">CANTIDAD DE PIEZAS:</p>
                                </th>
                                <th>
                                    <!-- <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden" name="total_pagar" id="total_pagar"></p> -->
                                    <p align="right"><span align="right" id="cantidad_piezas"> 0 </span> <input
                                            type="hidden" name="cantidad_piezas" id="cantidad_piezas"></p>
                                </th>
                            </tr>

                        </tfoot>

                        <tbody>
                        </tbody>


                    </table>
                </div>

            </div>





        </div>

        <div class="card-footer">
            {!! Form::submit('Grabar', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('remitos.index') }}" class="btn btn-default">Salir sin grabar</a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection

@push('formularios')

<script>
// ██████╗ ███████╗███╗   ███╗██╗████████╗ ██████╗ 
// ██╔══██╗██╔════╝████╗ ████║██║╚══██╔══╝██╔═══██╗
// ██████╔╝█████╗  ██╔████╔██║██║   ██║   ██║   ██║
// ██╔══██╗██╔══╝  ██║╚██╔╝██║██║   ██║   ██║   ██║
// ██║  ██║███████╗██║ ╚═╝ ██║██║   ██║   ╚██████╔╝
// ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝╚═╝   ╚═╝    ╚═════╝ 





$(document).ready(function() {



    $("#add_remito").click(function() {

        //window.alert("entro REMITOS");
        agregar_renglon_remito();
    });

});



/// AJAX PARA INSERCION DE PIEZAS

$('#pieza').keydown(function(e) {
    console.log('keyup called');
    var code = e.keyCode || e.which;
    if (code == '9') {


        var nPieza = document.getElementById('pieza').value;

        //miurl = "/fetch-pieza/"+nPieza ;
        //alert(miurl); 

        $.ajax({
            type: "GET",
            url: "/fetch-pieza/" + nPieza,
            dataType: "json",
            success: function(response) {
                console.log(response.message);



                if (response.message == 'NO') {

                    $('#success_message').addClass('alert');
                    $('#success_message').html(response.message);
                } else {
                    $('#success_message').addClass('alert');
                    $('#success_message').html(response.message);

                    $("#precio_venta").val(response.piezas[0].precio);
                    $("#descrip").val(response.piezas[0].namepieza);

                    //agregar_renglon_factura();

                }

            }
        });


        return false;
    }
});


/// FIN   AJAX PARA INSERCION DE PIEZAS
/// FIN   AJAX PARA INSERCION DE PIEZAS


var cont = 0;
total = 0;
subtotal = [];
//$("#guardarfactura").hide();
//$("#id_producto").change(mostrarValores);

/*
        function mostrarValores(){
   
            datosProducto = document.getElementById('id_producto').value.split('_');
            $("#precio_venta").val(datosProducto[2]);
            $("#stock").val(datosProducto[1]);
        
        }
        */


function agregar_renglon_remito() {


    producto_id = $("#producto_id").val();
    descrip = $("#descrip").val();
    precio_venta = $("#precio_venta").val();
    pieza = $("#pieza").val();



    subtotal[cont] = (precio_venta);
    //_subtotal = subtotal[cont] ;
    total = total + subtotal[cont];

    var fila = '<tr class="selected" id="fila"><td><button type="button" class="btn btn-danger btn-sm" >'.
    concat('<i class="fa fa-times fa-2x"></i></button></td>',
        '<td><input type="text"   name="_producto_id[]"   value="' + pieza + '" readonly ></td>',
        '<td><input type="text"   name="_descrip[]"       value="' + descrip + '"   readonly ></td>',
        '</tr>');

    limpiar();
    totales();

    // evaluar();



    $('#detalles').append(fila);


}





function limpiar() {

    $("#id_inventario").val("");
    $("#precio_venta").val("");
    $("#descrip").val("");
    $("#pieza").val("");

}

function totales() {




    //$("#total_pagar_html").html("$ " + total.toFixed(2));
    //$("#total_pagar").val(total.toFixed(2));
}


 function evaluar(){

//     if(total>0){

//       $("#guardarfactura").show();

//     } else{

//       $("#guardarfactura").hide();
//     }
 }

function eliminar(index) {

    total = total - subtotal[index];

    //total_impuesto= total*20/100;
    total_pagar_html = total;

    $("#total").html("USD$" + total);
    $("#total_impuesto").html("USD$" + total_impuesto);
    $("#total_pagar_html").html("USD$" + total_pagar_html);
    $("#total_pagar").val(total_pagar_html.toFixed(2));

    $("#fila" + index).remove();
    evaluar();
}

// ACA CAMBIO EL VALOR DEL PRECIOS SEGUN EL SELECT
$('#id_producto').on('change', function() {


    var articulos_data = $("#id_producto").val();

    articulos_data = articulos_data.split('_');
    //console.log('en el select',articulos_data);       
    $("#precio_venta").val(articulos_data[1]);


});
</script>


@endpush