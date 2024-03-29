<div class="table-responsive">
    <table class="table" id="cheques-table">
        <thead>
        <tr>
        <th>Cheque número</th>
        <th>Fecha</th>
        <th STYLE="text-align: right;" >Importe</th>
        <th STYLE="text-align: right;" >Cuenta</th>
        <!-- <th>Depositado</th> -->
        <th STYLE="text-align: right;" >Saldo</th>
        <th>Rendido</th>
            <th colspan="3">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cheques as $cheque)
            <tr>
                <td>{{ $cheque->numero  }}</td>
            <td>{{ $cheque->fecha ? \Carbon\Carbon::parse($cheque->fecha)->format('d/m/Y') : null}}</td>
            <td STYLE="text-align: right;" >{{ $cheque->importe }}</td>
            <td STYLE="text-align: right;" >{{ $cheque->ncuenta }}</td>
            <!-- <td>{{ $cheque->depositado }}</td> -->
            <td STYLE="text-align: right;" >{{ $cheque->saldo }}</td>
            <!-- <td>{ { $cheque->rendido_at } }</td> -->
            <td>{{ $cheque->rendido_at ? \Carbon\Carbon::parse($cheque->rendido_at)->format('d/m/Y') : null }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cheques.destroy', $cheque->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                    <!-- <a href="{{ route('cheques.rendir', [$cheque->id]) }}"
                        class="btn btn-sm btn-secondary float-right">Rendir</a>                        -->

                        
                        @can('RENDICIONES-CREAR')
                        @if (empty($cheque->rendido_at))
                            <a href="{{ route('cheques.rendir', [$cheque->id]) }}"
                            class="btn btn-sm btn-info float-left">Rendir</a>                           
                        @else
                            <a href="{{ route('imprimir_rendicion', [$cheque->id]) }}"  
                            class="btn btn-sm btn-info float-left">Imprim</a>   
                        @endif
                        @endcan

                        <a href="{{ route('cheques.show', [$cheque->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                        @can('CHEQUES-BORRAR') 
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro de anular cheque $cheque->numero?')"]) !!}
                        @endcan                        
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
