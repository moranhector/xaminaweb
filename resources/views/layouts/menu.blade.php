


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


