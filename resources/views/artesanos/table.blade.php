<div>
<div class="card">
    <div class="card-body">


    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:10" id="artesanos-table">
        <thead>
            <tr>
                <!-- <th>Id</th> -->
                <th>Nombres</th>
                <th>Documento</th>
                <th>Direccion</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artesanos as $artesano)
            <tr>
                <!-- <td>{{ $artesano->id }}</td> -->
                <td>{{ $artesano->nombre }}</td>
                <td>{{ $artesano->documento }}</td>
                <td>{{ $artesano->direccion }}</td>
                <!-- <td> <a href=""></a> </td> -->

                <!-- <td width="120">
                    {!!  Form::open(['route' => ['artesanos.destroy', $artesano->id], 'method' => 'delete'] ) !!}
                    <div class='btn-group'>
                        <a href="{{ route('artesanos.show', [$artesano->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('artesanos.edit', [$artesano->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!!  Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!!  Form::close() !!}
                </td> -->


            </tr>
            @endforeach
        </tbody>
    </table>

    </div>

</div>        
</div>