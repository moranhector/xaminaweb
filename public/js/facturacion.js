// <!-- 
// ███████╗ █████╗  ██████╗████████╗██╗   ██╗██████╗  █████╗ ███████╗
// ██╔════╝██╔══██╗██╔════╝╚══██╔══╝██║   ██║██╔══██╗██╔══██╗██╔════╝
// █████╗  ███████║██║        ██║   ██║   ██║██████╔╝███████║███████╗
// ██╔══╝  ██╔══██║██║        ██║   ██║   ██║██╔══██╗██╔══██║╚════██║
// ██║     ██║  ██║╚██████╗   ██║   ╚██████╔╝██║  ██║██║  ██║███████║
// ╚═╝     ╚═╝  ╚═╝ ╚═════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝


//  -->



$(document).ready(function() {

   $("#add_detail").click(function() {

       //window.alert("entro adddetail");
       agregar_renglon_factura();
   });


});
$('#pieza').keydown(function(e) {
   console.log('keyup called');
   var code = e.keyCode || e.which;
   if (code == '9') {

       var nPieza = document.getElementById('pieza').value;
       var deposito = document.getElementById('deposito_id').value;       
       //console.log( deposito );

       //miurl = "/fetch-pieza/"+nPieza ;
       //alert(miurl); 
       $.ajax({
           type: "GET",
           //url: "/fetch-pieza/" + nPieza,
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


var cont = 0;
total = 0;
subtotal = [];
$("#guardarfactura").hide();
//$("#id_producto").change(mostrarValores);

/*
       function mostrarValores(){
  
           datosProducto = document.getElementById('id_producto').value.split('_');
           $("#precio_venta").val(datosProducto[2]);
           $("#stock").val(datosProducto[1]);
       
       }
       */

function agregar_renglon_factura() {

   //producto_id = $("#producto_id").val();  //codigo de la pieza
   inventario_id = $("#inventario_id").val(); //id de  la pieza
   descrip = $("#descrip").val();               //descripcion de la pieza
   precio_venta = $("#precio_venta").val();
   pieza = $("#pieza").val(); //codigo de la pieza


   if ( descrip.length > 0)
   {
        subtotal[cont] = (precio_venta * 1); //Esta multiplicación es importante porque convierte en número la precio_venta !!
        //_subtotal = subtotal[cont] ;
        total = parseFloat( total + subtotal[cont] );
        console.log(total);
        //console.log(parseFloat(total));
    
        var fila = '<tr class="selected" id="fila"><td><button type="button" class="btn btn-danger btn-sm" >'.
        concat('<i class="fa fa-times fa-2x"></i></button></td>',
            '<td><input type="text"   name="_inventario_id[]" value="' + inventario_id + '" HIDDEN >',
            '    <input type="text"   name="_pieza[]"         value="' + pieza + '" readonly  size="5" ></td>',
            '<td><input type="text"   name="_descrip[]"       value="' + descrip + '"   readonly  size="30" ></td>',
            '<td><input type="text"   name="_precio_venta[]"  value="' + precio_venta + '"  readonly  size="8" ></td>',
            '<td><input type="text"   name="_subtotal[]"      value="' + subtotal[cont] + '"     readonly  size="8"   ></td></tr>'
            );
    
        limpiar();
        totales();
    
        evaluar();
    
    
    
        $('#detalles').append(fila);    
    
   }


}

function limpiar() {

   $("#pieza").val("");
   //$("#cantidad").val("");
   $("#precio_venta").val("");
   $("#descrip").val("");
   $("#inventario_id").val("");

}

function totales() {

   $("#total").html("$ " + total.toFixed(2));
   $("#total_pagar_html").html("$ " + total.toFixed(2));
   $("#total_pagar").val(total.toFixed(2));
}


function evaluar() {

   if (total > 0) {

       $("#guardarfactura").show();

   } else {

       $("#guardarfactura").hide();
   }
}

function eliminar(index) {

   total = total - subtotal[index];
   total_impuesto = total * 20 / 100;
   total_pagar_html = total + total_impuesto;

   $("#total").html("USD$" + total);
   $("#total_impuesto").html("USD$" + total_impuesto);
   $("#total_pagar_html").html("USD$" + total_pagar_html);
   $("#total_pagar").val(total_pagar_html.toFixed(2));

   $("#fila" + index).remove();
   evaluar();
}
// ACA CAMBIO EL VALOR DEL PRECIOS SEGUN EL SELECT
$('#pieza').on('change', function() {


   var articulos_data = $("#id_producto").val();
   articulos_data = articulos_data.split('_');
   //console.log('en el select',articulos_data);       
   $("#precio_venta").val(articulos_data[1]);


});