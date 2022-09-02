<div class="table-responsive">
    <table class="table" id="cheques-table">
        <thead>
        <tr>
            <th>Numero</th>
        <th>Fecha</th>
        <th>Importe</th>
        <th>Ncuenta</th>
        <th>Depositado</th>
        <th>Saldo</th>
        <th>Rendido</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cheques as $cheque)
            <tr>
                <td>{{ $cheque->numero }}</td>
            <td>{{ $cheque->fecha }}</td>
            <td>{{ $cheque->importe }}</td>
            <td>{{ $cheque->ncuenta }}</td>
            <td>{{ $cheque->depositado }}</td>
            <td>{{ $cheque->saldo }}</td>
            <td>{{ $cheque->rendido_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cheques.destroy', $cheque->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                    <a href="{{ route('cheques.rendir', [$cheque->id]) }}"
                        class="btn btn-sm btn-secondary float-right">Rendir</a>                       

                        <a href="{{ route('cheques.rendir', [$cheque->id]) }}"
                        class="btn btn-sm btn-info float-left">Rendición</a>        

                        <a href="{{ route('cheques.show', [$cheque->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>

                        <a href="{{ route('cheques.edit', [$cheque->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>

                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
