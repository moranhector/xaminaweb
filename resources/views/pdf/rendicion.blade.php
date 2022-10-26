<!DOCTYPE html>
<html>

<head>
    <title>RENDICION</title>
    <style type="text/css">
    body {
        font-size: 16px;
        font-family: "Arial";
    }

    table {
        border-collapse: collapse;
    }

    td {
        padding: 6px 5px;
        font-size: 15px;
    }

    .h1 {
        font-size: 21px;
        font-weight: bold;
    }

    .h2 {
        font-size: 18px;
        font-weight: bold;
    }



    .contorno {
        margin-top: 00px;
        border: 1px;
    }


    .tabla1 {
        margin-bottom: 20px;
    }

    .tabla2 {
        margin-bottom: 20px;
    }


    .tabla3 {
        margin-top: 15px;
    }

    .tabla3 td {
        border: 1px solid #000;
    }

    .tabla3 .cancelado {
        border-left: 0;
        border-right: 0;
        border-bottom: 0;
        border-top: 1px dotted #000;
        width: 200px;
    }

    .emisor {
        color: red;
    }

    .linea {
        border-bottom: 1px dotted #000;
    }

    .border {
        border: 1px solid #000;
    }

    .fondo {
        background-color: #dfdfdf;
    }

    .fisico {
        color: #000;
    }

    .fisico td {
        color: #fff;
    }

    .fisico .border {
        border: 1px solid #fff;
    }

    .fisico .tabla3 td {
        border: 1px solid #fff;
    }

    .fisico .linea {
        border-bottom: 1px dotted #fff;
    }

    .fisico .emisor {
        color: #fff;
    }

    .fisico .tabla3 .cancelado {
        border-top: 1px dotted #fff;
    }

    .fisico .text {
        color: #000;
    }

    .fisico .fondo {
        background-color: #fff;
    }
    </style>
</head>

<body>
    <div>


        <table style="border:1px solid" width="100%">



            <tr>
                <td width="100%" align="center">
                    <B> Ministerio de Salud, Desarrollo Social y Deportes </B>

                </td>
            </tr>
            <tr>
                <td width="100%" align="center">
                    <B> División Promoción Artesanal </B>

                </td>
            </tr>
        </table>



        <table style="border:1px solid" width="100%">



            <tr>
                <td width="100%" align="center">
                    <B> RENDICION CHEQUE {{$numero}}</B>

                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>

 

                <td style="border:0;" width="40%" align="right">
                    <B>Fecha rendición: {{ american2frech( $cheque->rendido_at ) }} </B>
                </td>


            </tr>
        </table>
 
       

 
 


        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>N. Pieza</strong></td>
                <td align="left"   class="fondo"><strong>Descripción</strong></td>
                <td align="right" class="fondo"><strong>Recibo Compra</strong></td>
                <td align="center" class="fondo"><strong>Costo</strong></td>
 
            </tr>






            @foreach($renglones as $renglon)
            <tr>
                <td width="10%" align="center"><span class="text">{{ $renglon->npieza }}</span></td>
                <td width="40%"><span class="text">{{ $renglon->namepieza }}</span></td>
                <td width="10%" align="right"><span class="text">{{ $renglon->formulario }}</span></td>

                <td width="20%" align="right"><span class="text">{{ $renglon->importe }}</span></td>
            </tr>
            @endforeach



            <tr>
                <td style="border:0;">&nbsp;</td>
        
                <td style="border:0;">&nbsp;</td>
                <td align="right"><strong>TOTAL $</strong></td>
                <td align="right"><span class="text"> {{$cheque->importe}}</span></td>
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