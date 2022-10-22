


<li class="nav-item">
    <a href="{{ route('artesanos.index') }}"
       class="nav-link {{ Request::is('artesanos*') ? 'active' : '' }}">
        <p>Artesanos</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('rubros.index') }}"
       class="nav-link {{ Request::is('rubros*') ? 'active' : '' }}">
        <p>Rubros</p>
    </a>
</li>





<li class="nav-item">
    <a href="{{ route('tipopiezas.index') }}"
       class="nav-link {{ Request::is('tipopiezas*') ? 'active' : '' }}">
        <p>Tipos de piezas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cheques.index') }}"
       class="nav-link {{ Request::is('cheques*') ? 'active' : '' }}">
        <p>Cheques</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('recibos.index') }}"
       class="nav-link {{ Request::is('recibos*') ? 'active' : '' }}">
        <p>Recibos de Compra</p>
    </a>
</li>




 

<!-- <li class="nav-item">
    <a href="{{ route('preparar.recibo') }}"
       class="nav-link {{ Request::is('preparar.recibo*') ? 'active' : '' }}">
        <p>Registrar Recibo</p>
    </a>
</li> -->
<li class="nav-item">
    <a href="{{ route('depositos.index') }}"
       class="nav-link {{ Request::is('depositos*') ? 'active' : '' }}">
        <p>Depósitos</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('inventarios.index') }}"
       class="nav-link {{ Request::is('inventarios*') ? 'active' : '' }}">
        <p>Inventarios</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('talonarios.index') }}"
       class="nav-link {{ Request::is('talonarios*') ? 'active' : '' }}">
        <p>Talonarios</p>
    </a>
</li>


<!-- <li class="nav-item">
    <a href="{{ route('rendiciones.index') }}"
       class="nav-link {{ Request::is('rendiciones*') ? 'active' : '' }}">
        <p>Rendiciones</p>
    </a>
</li> -->



<li class="nav-item">
    <a href="{{ route('clientes.index') }}"
       class="nav-link {{ Request::is('clientes*') ? 'active' : '' }}">
        <p>Clientes</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('facturas.index') }}"
       class="nav-link {{ Request::is('facturas*') ? 'active' : '' }}">
        <p>Facturas</p>
    </a>
</li>


<!-- <li class="nav-item">
    <a href="{{ route('faclineas.index') }}"
       class="nav-link {{ Request::is('faclineas*') ? 'active' : '' }}">
        <p>Faclineas</p>
    </a>
</li> -->



<li class="nav-item">
    <a href="{{ route('existencias.index') }}"
       class="nav-link {{ Request::is('existencias*') ? 'active' : '' }}">
        <p>Existencias</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('inventario_fecha') }}"
       class="nav-link {{ Request::is('Inventario_fecha') ? 'active' : '' }}">
        <p>Inventario a fecha</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('remitos.index') }}"
       class="nav-link {{ Request::is('remitos*') ? 'active' : '' }}">
        <p>Remitos</p>
    </a>
</li>


 


<li class="nav-item">
    <a href="{{ route('estudiantes.index') }}"
       class="nav-link {{ Request::is('estudiantes*') ? 'active' : '' }}">
        <p>Estudiantes</p>
    </a>
</li>


