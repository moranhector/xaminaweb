@extends('layouts.app')

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

    background: #FE6602;
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    "

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

<!-- SELECCION DE DEPOSITO -->
<!-- SELECCION DE DEPOSITO -->
<!-- SELECCION DE DEPOSITO  ESTOY COPIANDO DE FACTURAS FORM-->

<script type="text/javascript">
$(window).on('load', function() {
    // cliente = $('#documento').val()    ;
    // console.log( "longitud del documento" , cliente.length);
    // //EVITAR QUE SE RECARGUE EL DEPOSITO ANTE UN ERROR
    // if ( cliente.length == 0) // Solo si es la primera vez que entra al formulario
    // {
    $('#myModal').modal('show');
    // }
});
</script>

<script type="text/javascript">
function cerrarmodal() {

    nombre_deposito1 = $('#deposito_id1 option:selected').text() //ACA ME TRAIGO EL NOMBRE DEL DEPOSITO NO EL ID
    depo1 = $('#deposito_id1 option:selected').val() //ACA ME TRAIGO EL NOMBRE DEL DEPOSITO NO EL ID
    //console.log('HE COPIADO',depo1);
 

    nombre_deposito2   = $('#deposito_id2 option:selected').text() //ACA ME TRAIGO EL NOMBRE DEL DEPOSITO NO EL ID
    depo2 = $('#deposito_id2 option:selected').val() //ACA ME TRAIGO EL NOMBRE DEL DEPOSITO NO EL ID    
 
    if ( depo1==depo2 ) {
        alert("Seleccione Depósito destino distinto al orígen");
        return false;
    }
 

    $("#deposito_id_from").val( nombre_deposito1 ) ;  //COPIO DESCRIPCION DEPOSITO ORIGEN
    $("#id_deposito_1").val( depo1 ) ;        //COPIO ID DEPOSITO ORIGEN
    
    $("#deposito_id_to").val( nombre_deposito2 ) ;    //COPIO DESCRIPCION DEPOSITO DESTINO
    $("#id_deposito_2").val( depo2 ) ;        //COPIO ID DEPOSITO ORIGEN


    $('#myModal').modal('toggle');
    $('#remito_descrip').focus(); //ACA PONGO EL CURSOR PARA SELECCIONAR UN CLIENTE
}
</script>

<!-- FIN SELECCION DE DEPOSITO -->
<!-- FIN SELECCION DE DEPOSITO -->
<!-- FIN SELECCION DE DEPOSITO -->



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

@include('flash::message')


    


<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::open(['route' => 'remitos.store']) !!}

        <div class="card-body">






            <div class="col-sm-6">
                <label for="remito_descrip">Descripción:</label>
                <input class="form-control" name="remito_descrip" type="text" id="remito_descrip"
                    placeholder="Descripción">
            </div>

            <!-- Fecha Field -->
            <div class="col-sm-2">
                <label for="fecha">Fecha:</label>
                <input class="form-control" id="fecha" name="fecha" type="text" value={{ $fecha_hoy }}>


            </div>

            <div class="row">
                <div class="col-md-2">
                    <label class="form-control-label" for="articulo">Depósito</label>

                    <input type="text" id="deposito_id_from" name="deposito_id_from" READONLY>
                    <input type="text" id="id_deposito_1" name="id_deposito_1" value=" " HIDDEN>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label class="form-control-label" for="articulo">Depósito</label>

                    <input type="text" id="deposito_id_to" name="deposito_id_to" READONLY>
                    <input type="text" id="id_deposito_2"  name="id_deposito_2" value=" " HIDDEN >                    
                </div>
            </div>            

 









            <div class="form-group row">


                <!-- <input type="hidden" id="id_inventario" name="id_inventario" class="form-control"> -->
                <input type="text" id="inventario_id" HIDDEN >   

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
                                <th class="tabla_head">Acción</th>
                                <th class="tabla_head">Pieza</th>
                                <th class="tabla_head">Descripción</th>
                             

                            </tr>
                        </thead>

                        <tfoot>




                            <tr>
                                <th> &nbsp </th>
                                

                                <th>
                                    <p align="right">CANTIDAD DE PIEZAS:</p>
                                </th>
                                <th>
                                    <!-- <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden" name="total_pagar" id="total_pagar"></p> -->
                                    <p align="right"><span align="right" id="cantidad_piezas_p"> 0 </span> <input
                                            type="hidden" name="cantidad_piezas" id="cantidad_piezas_input"></p>
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


<!-- <div class="text-center">      SELECCIONAR DEPOSITO 
    <a href="#myModal" class="trigger-btn" data-toggle="modal">Seleccionar Depósito</a>
</div> -->

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remito</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <label class="form-control-label" for="articulo">Por favor seleccione Depósitos</label>




                <select class="form-control selectpicker" name="deposito_id1" id="deposito_id1" data-live-search="true">



                    @foreach($depositos as $deposito)

                    <option value="{{ $deposito->id }}">{{$deposito->nombre}}</option>

                    @endforeach

                </select>


                <select class="form-control selectpicker" name="deposito_id2" id="deposito_id2" data-live-search="true">



                    @foreach($depositos as $deposito)

                    <option value="{{ $deposito->id }}">{{$deposito->nombre}}</option>

                    @endforeach

                </select>




                <button type="button" class="btn btn-primary" onclick="cerrarmodal()">Aceptar</button>
                <!-- Boton que va a la función para cerrar la ventana modal-->

            </div>



        </div>
    </div>
</div>



@push('formularios')


<script src="{{asset('js/remitos.js')}}"></script>




@endpush