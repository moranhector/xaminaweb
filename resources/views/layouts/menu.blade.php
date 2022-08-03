


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
        <p>Tipopiezas</p>
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
        <p>Recibos</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('recibosLineas.index') }}"
       class="nav-link {{ Request::is('recibosLineas*') ? 'active' : '' }}">
        <p>Recibos Lineas</p>
    </a>
</li>

 

<li class="nav-item">
    <a href="{{ route('preparar.recibo') }}"
       class="nav-link {{ Request::is('preparar.recibo*') ? 'active' : '' }}">
        <p>Registrar Recibo</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('depositos.index') }}"
       class="nav-link {{ Request::is('depositos*') ? 'active' : '' }}">
        <p>Depositos</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('inventarios.index') }}"
       class="nav-link {{ Request::is('inventarios*') ? 'active' : '' }}">
        <p>Inventarios</p>
    </a>
</li>


