<!DOCTYPE html>
<html>
<head>
    <title>RENDICION</title>
    <style type="text/css">
    body{
        font-size: 16px;
        font-family: "Arial";
    }
    table{
        border-collapse: collapse;
    }
    td{
        padding: 6px 5px;
        font-size: 15px;
    }
    .h1{
        font-size: 21px;
        font-weight: bold;
    }
    .h2{
        font-size: 18px;
        font-weight: bold;
    }



    .contorno{
        margin-top: 00px;
        border: 1px;
    }


    .tabla1{
        margin-bottom: 20px;
    }
    .tabla2 {
        margin-bottom: 20px;
    }


    .tabla3{
        margin-top: 15px;
    }
    .tabla3 td{
        border: 1px solid #000;
    }
    .tabla3 .cancelado{
        border-left: 0;
        border-right: 0;
        border-bottom: 0;
        border-top: 1px dotted #000;
        width: 200px;
    }
    .emisor{
        color: red;
    }
    .linea{
        border-bottom: 1px dotted #000;
    }
    .border{
        border: 1px solid #000;
    }
    .fondo{
        background-color: #dfdfdf;
    }
    .fisico{
        color: #000;
    }
    .fisico td{
        color: #fff;
    }
    .fisico .border{
        border: 1px solid #fff;
    }
    .fisico .tabla3 td{
        border: 1px solid #fff;
    }
    .fisico .linea{
        border-bottom: 1px dotted #fff;
    }
    .fisico .emisor{
        color: #fff;
    }
    .fisico .tabla3 .cancelado{
        border-top: 1px dotted #fff;
    }
    .fisico .text{
        color: #000;
    }
    .fisico .fondo{
        background-color: #fff;
    }

</style>
</head>
<body>
    <div>

        <table style="border:1px solid" width="100%"  >

  

            <tr>
                <td width="100%" align="center">
                <B>  RENDICION  </B>  
                
                </td>
            </tr>
        </table>     

        <table width="100%"  >
            <tr>
                <td style="border:0;" width="40%" align="center">
                          <B> {{$numero}}   </B>
                </td>
  
                <td style="border:0;" width="40%" align="center">
                <B>  CHEQUE  </B>  
                
                
                </td>
            </tr>
        </table> 

        <table  width="100%"  >
        <tr>
        <td>
        <table>
            <tr>
                <td width="50%" align="left" style="border:0;" >
                <B>   Rendición:  </B>  {{ $numero }} 
                </td>
                <td width="50%" align="left" style="border:0;"  >
                <B>         Punto de Venta: </B>  0001 <b> Comp.Nro:</b> {{ $numero }}  
                </td>
            </tr>

            <tr>
                <td width="50%" align="left"  style="border:0;"  >
                <B>      Condición IVA:  </B> Responsable Monotributo
                </td>
                <td width="50%" align="left"  style="border:0;"  >
                <B>      CUIT:  </B> 18083471
                </td>
            </tr>

            <tr>
                <td width="50%" align="left"  style="border:0;"  >
                 
                </td>
                <td width="50%" align="left" style="border:0;"  >
                <B>  Ingresos Brutos: </B>  
                </td>
            </tr>            

            <tr>
                <td width="50%" align="left"  style="border:0;"  >
                 
                </td>
                <td width="50%" align="left"  style="border:0;"  >
                <B>     Fecha de Inicio de Actividades:  </B>  
                </td>
            </tr>   


        </table>
        </td>
        </tr>
        </table>


        <table width="100%" class="tabla3">
            <tr>
                <td width="100%"> 
                <B>Período facturado desde: </B>01/09/2019 <B>Hasta:</B> 30/09/2019 <B>Fecha de Vto. para el pago: </B>03/10/2019</td>
            </tr>
        </table>     

        <table  width="100%" class="tabla3" >
            <tr>
                <td style="border:0;" width="30%" align="left">
                <B>   numero:  </B>   {{ $numero }}
                </td>                            

                <td width="70%" align="left" style="border:0;" >
                <B>            Apellido y Nombre / Razón Social:   </B>  
                </td>

            </tr>

            <tr>
                <td style="border:0;" width="50%" align="left">
                <B>       Condición IVA:   </B>  IVA Responsable Inscripto
                </td>                            

                <td width="50%" align="left" style="border:0;" >
                <B>       Domicilio: </B>  
                </td>

            </tr>

            <tr>
                <td style="border:0;" width="50%" align="left">
                <B>    Condición de venta:  </B> Contado
                </td>                            

                <td width="50%" align="left" style="border:0;" >
                        
                </td>

            </tr>




        </table> 


        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>Código</strong></td>
                <td align="center" class="fondo"><strong>Producto / Servicio</strong></td>
                <td align="center" class="fondo"><strong>Cantidad</strong></td>                
                <td align="center" class="fondo"><strong>Precio Unit.</strong></td>
                <td align="center" class="fondo"><strong>Subtotal</strong></td>
            </tr>


        



            @for ($i = 0; $i < 6; $i++)
            @if (array_key_exists($i, $renglones))
            <tr>
                <td width="9%" align="center"><span class="text">{{ $renglones[$i]['inventario_id'] }}</span></td>            
                <td width="48%"><span class="text">{{ $renglones[$i]['cheque_id'] }}</span></td>                
                <td width="9%" align="center"><span class="text">{{ $renglones[$i]['recibo_id'] }}</span></td>

                <td width="18%" align="right"><span class="text">{{ $renglones[$i]['importe'] }}</span></td>
            </tr>
            @else
            <tr>
                <td width="9%">&nbsp;</td>
                <td width="48%">&nbsp;</td>
                <td width="9%">&nbsp;</td>                
                <td width="16%">&nbsp;</td>
                <td width="18%" align="left">&nbsp;</td>
            </tr>
            @endif
            @endfor



            <tr>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>                
                <td align="right"><strong>TOTAL $</strong></td>
                <td align="right"><span class="text">{{ " $ t o t  a l" }}</span></td>
            </tr>
            <!--
            <tr>
                <td style="border:0;">&nbsp;</td>
                <td align="center" style="border:0;">
                    <table width="200" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" class="cancelado">CANCELADO</td>
                        </tr>
                    </table>
                </td>
                <td style="border:0;">&nbsp;</td>
                <td align="center" style="border:0;" class="emisor"><strong>EMISOR</strong></td>
            </tr>
            -->
        </table>



        
    </div>
</body>
</html>