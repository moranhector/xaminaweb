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

   producto_id = $("#producto_id").val();
   descrip = $("#descrip").val();
   precio_venta = $("#precio_venta").val();
   pieza = $("#pieza").val();


   if ( descrip.length > 0)
   {
        subtotal[cont] = (precio_venta);
        //_subtotal = subtotal[cont] ;
        total = parseFloat( total + subtotal[cont] );
        console.log(total);
        //console.log(parseFloat(total));
    
        var fila = '<tr class="selected" id="fila"><td><button type="button" class="btn btn-danger btn-sm" >'.
        concat('<i class="fa fa-times fa-2x"></i></button></td>',
            '<td><input type="text"   name="_producto_id[]"   value="' + pieza + '" readonly ></td>',
            '<td><input type="text"   name="_descrip[]"       value="' + descrip + '"   readonly ></td>',
            '<td><input type="text"   name="_precio_venta[]"  value="' + precio_venta + '"  readonly ></td>',
            '<td><input type="text"   name="_subtotal[]"      value="' + subtotal[cont] + '"     readonly   ></td></tr>'
            );
    
        limpiar();
        totales();
    
        evaluar();
    
    
    
        $('#detalles').append(fila);    
    
   }








}

function limpiar() {

   $("#id_producto").val("");
   //$("#cantidad").val("");
   $("#precio_venta").val("");

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
$('#id_producto').on('change', function() {


   var articulos_data = $("#id_producto").val();
   articulos_data = articulos_data.split('_');
   //console.log('en el select',articulos_data);       
   $("#precio_venta").val(articulos_data[1]);


});