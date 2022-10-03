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
                                <!-- <th>Precio $</th>
                <th>Subtotal $</th> -->
                            </tr>
                        </thead>

                        <tfoot>




                            <tr>
                                <th colspan="5">
                                    <p align="right">CANTIDAD DE PIEZAS:</p>
                                </th>
                                <th>
                                    <!-- <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden" name="total_pagar" id="total_pagar"></p> -->
                                    <p align="right"><span align="right" id="cantidad_piezas">$ 0.00</span> <input
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
            <a href="{{ route('remitos.index') }}" class="btn btn-default">Cancelar</a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection