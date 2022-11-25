    
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


        var nPieza   = document.getElementById('pieza').value;
        var deposito = document.getElementById('deposito_id1').value;
        console.log("deposito id?",deposito);

        //miurl = "/fetch-pieza/"+nPieza ;
        //alert(miurl); 

        $.ajax({
            type: "GET",
            url: "/ajax_pieza_deposito/" + nPieza + "/"+deposito,
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
                    $("#inventario_id").val(response.piezas[0].id); //Aquí viene el ID DE LA PIEZA                    

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
    inventario_id = $("#inventario_id").val(); //id de  la pieza    

    if ( descrip.length > 0)
    {

        subtotal[cont] = 1 ;
        //_subtotal = subtotal[cont] ;
        total = total + subtotal[cont];

        var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm"  onclick="eliminar('+cont+');"  >'.
        concat('<i class="fa fa-times fa-2x"></i></button></td>',
            '<td><input type="text"   name="_inventario_id[]" value="' + inventario_id + '" HIDDEN >',
            '<input type="text"   name="_producto_id[]"   value="' + pieza + '" readonly ></td>',
            '<td><input type="text"   name="_descrip[]"       value="' + descrip + '"   readonly ></td>',
            '</tr>');

        limpiar();
        totales();

        // evaluar();



        $('#detalles').append(fila);
    }


}





function limpiar() {

    $("#id_inventario").val("");
    $("#precio_venta").val("");
    $("#descrip").val("");
    $("#pieza").val("");
    $("#inventario_id").val("");    

}

function totales() {


 
    $("#cantidad_piezas_p").html(total.toFixed(0));
    $("#cantidad_piezas_input").val(total.toFixed(0));
}


 function evaluar(){

//     if(total>0){

//       $("#guardarfactura").show();

//     } else{

//       $("#guardarfactura").hide();
//     }
 }

function eliminar(index) {

    // total = total - subtotal[index];
    console.log('entra');
 
    // total_pagar_html = total;

    // $("#total").html("USD$" + total);
    // $("#total_impuesto").html("USD$" + total_impuesto);
    // $("#total_pagar_html").html("USD$" + total_pagar_html);
    // $("#total_pagar").val(total_pagar_html.toFixed(2));

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