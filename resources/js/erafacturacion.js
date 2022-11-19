   
     $(document).ready(function(){
        
        $("#add_detail").click(function(){
   
           window.alert("entro");
           add_detail();
        });
   
     });
   
      var cont=0;
      total=0;
      subtotal=[];
      $("#guardarfactura").hide();
      //$("#id_producto").change(mostrarValores);
   
        /*
        function mostrarValores(){
   
            datosProducto = document.getElementById('id_producto').value.split('_');
            $("#precio_venta").val(datosProducto[2]);
            $("#stock").val(datosProducto[1]);
        
        }
        */
   
        function add_detail(){
            //window.alert("agregar");
            //datosProducto = document.getElementById('id_producto').value.split('_');
   
            //id_producto= datosProducto[0];
            //producto= $("#id_producto option:selected").text();

            cantidad= $("#cantidad").val();
            //precio_venta= $("#precio_venta").val();            

            articulos_data = $("#id_producto").val();
            articulos_data = articulos_data.split('_') ;
            producto_id = articulos_data[0] ;

            // _id_tipo_pieza = articulos_data[0];

            descrip = articulos_data[2] ;
            //precio_venta= articulos_data[1];            
            precio_venta= $("#precio_venta").val();
            
            //console.log('_descrip',_descrip);         
 
   
             if(cantidad!="" && cantidad>0 ){            
   
   
                       subtotal[cont]=( cantidad * precio_venta);
                       //_subtotal = subtotal[cont] ;
                       total= total+subtotal[cont];
   
                       var fila= '<tr class="selected" id="fila"><td><button type="button" class="btn btn-danger btn-sm" >'.
                       concat('<i class="fa fa-times fa-2x"></i></button></td>',
                               '<td><input type="text"   name="_producto_id[]"   value="'+producto_id+'" readonly ></td>',
                               '<td><input type="text"   name="_descrip[]"       value="'+descrip+'"   readonly ></td>',
                               '<td><input type="text"   name="_precio_venta[]"  value="'+precio_venta+'"  readonly ></td>',
                               '<td><input type="text"   name="_cantidad[]"      value="'+cantidad+'"   readonly ></td>',
                               '<td><input type="text"   name="_subtotal[]"      value="'+subtotal[cont]+'"     readonly   ></td></tr>');
   
                       limpiar();
                       totales();
                        
                       evaluar();
   
   
   
                       $('#detalles').append(fila);
              
               }
            
        }
   
         
        function limpiar(){
           
           $("#id_producto").val("");
           $("#cantidad").val("");
           $("#precio_venta").val("");
   
        }
   
        function totales(){
   
           //$("#total").html("$ " + total.toFixed(2));
           
   
           $("#total_pagar_html").html("$ " + total.toFixed(2));
           $("#total_pagar").val(total.toFixed(2));
         }
   
   
        function evaluar(){
   
            if(total>0){
   
              $("#guardarfactura").show();
   
            } else{
                 
              $("#guardarfactura").hide();
            }
        }
   
        function eliminar(index){
   
           total=total-subtotal[index];
           total_impuesto= total*20/100;
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
            $("#precio_venta").val( articulos_data[1]  );        
        
       
        });

        
        

