@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Registrar Recibo</h1>
                </div>
            </div>
        </div>
    </section>

    @include('flash::message')    


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    

    <div class="content px-3">

    <form method="POST" action="{{ route('guardar.recibo') }}" accept-charset="UTF-8" id="create_recibo_form" name="create_recibo_form" class="form-horizontal">
            {{ csrf_field() }} 
            @include ('recibos.form', [ 'recibo' => null, ]) 

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input id="guardarfactura"  class="btn btn-primary" type="submit" value="Grabar Recibo">
                    </div>
                </div>

            </form>
    </div>
@endsection


@push('formularios')

 


<!-- 
██████╗ ███████╗ ██████╗██╗██████╗  ██████╗ ███████╗
██╔══██╗██╔════╝██╔════╝██║██╔══██╗██╔═══██╗██╔════╝
██████╔╝█████╗  ██║     ██║██████╔╝██║   ██║███████╗
██╔══██╗██╔══╝  ██║     ██║██╔══██╗██║   ██║╚════██║
██║  ██║███████╗╚██████╗██║██████╔╝╚██████╔╝███████║
╚═╝  ╚═╝╚══════╝ ╚═════╝╚═╝╚═════╝  ╚═════╝ ╚══════╝ -->
                                                    


<script>
     
     $(document).ready(function(){
        
        $("#agregar").click(function(){
   
           //window.alert("entro RECXIOS");
            agregar();
        });
   
     });

        //TECLA ENTER DESHABILITADA
        //LECTOR DE CODIGOS DE BARRAS

            $("input").keydown(function (e){
        // Capturamos qué tecla ha sido
        var keyCode= e.which;
        // Si la tecla es el Intro/Enter
        if (keyCode == 13){
            // Evitamos que se ejecute eventos
            event.preventDefault();
            // Devolvemos falso
            return false;
        }
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
   
        function agregar(){
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
   
                       var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm"  onclick="eliminar('+cont+');" >'.
                       concat('<i class="fa fa-times fa-2x"></i></button></td>',
                               '<td><input type="text"   name="_producto_id[]"   value="'+producto_id+'" readonly ></td>',
                               '<td><input type="text"   name="_descrip[]"       value="'+descrip+'"   readonly ></td>',
                               '<td><input type="text"   name="_precio_venta[]"  value="'+precio_venta+'"  readonly   STYLE="text-align: right;" ></td>',
                               '<td><input type="text"   name="_cantidad[]"      value="'+cantidad+'"   readonly  STYLE="text-align: right;"  ></td>',
                               '<td><input type="text"   name="_subtotal[]"      value="'+subtotal[cont]+'"     readonly  STYLE="text-align: right;"   ></td></tr>');

                        cont++;                               
   
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
            console.log("total antes de eliminar", total);
            total=total-subtotal[index];
            console.log("total despues de eliminar", total);
            //total_impuesto= total*20/100;
            total_pagar_html = total ;
   
            //$("#total").html("USD$" + total);
            // $("#total_impuesto").html("USD$" + total_impuesto);
            // $("#total_pagar_html").html("USD$" + total_pagar_html);
            $("#total_pagar_html").html("$ " + total.toFixed(2));
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


        
        
    </script>

@endpush
