<div class="container">
    <div class="card">
        <!-- Formulario Field -->
        <div class="row">
            <div class="col-12 col-md-3">
                {!! Form::label('formulario', 'Formulario:') !!}
                <p>{{ $recibo[0]->formulario }}</p>
            </div>
            <div class="col-6 col-md-6">
                {!! Form::label('nombre', 'Nombre:') !!}
                <p>{{ $recibo[0]->nombre }}</p>
            </div>

            <!-- Fecha Field -->
            <div class="col-6 col-md-3">
                {!! Form::label('fecha', 'Fecha:') !!}
                <p>{{   \Carbon\Carbon::parse($recibo[0]->fecha)->format('d/m/Y') }}</p>


            </div>
        </div>

    </div>






    <div class="card">

        <div class="row">


            <!-- Cheque Id Field -->

            <!-- Cheque Id Field -->
            <div class="col-12 col-md-6">
                {!! Form::label('cheque_id', 'Cheque nº:') !!}
                <p>{{ $recibo[0]->numero }}</p>
            </div>

 


            @if( $recibo[0]->rendido )
            <b>RENDIDO</b>
            @else
            <p class="bg-warning text-white p-1">NO RENDIDO</p>
            @endempty




        </div>


    </div>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo Pieza</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Unit.</th>
                <th scope="col">Subtotal</th>


            </tr>
        </thead>
        <tbody>

            @foreach($recibo as $renglon)
            <tr>
                <th scope="row">1</th>
                <td>{{ $renglon->tipopieza_id  }}</td>
                <td>{{ $renglon->descrip  }}</td>
                <td>{{ $renglon->cantidad  }}</td>
                <td>{{ $renglon->preciounit  }}</td>
                <td>{{ $renglon->preciounit *  $renglon->cantidad  }}</td>


            </tr>


            @endforeach
        <tfoot>
            <th scope="col">#</th>
            <th scope="col"> </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">{{ $recibo[0]->total }}</th>


        </tfoot>


        </tbody>
    </table>









</div>