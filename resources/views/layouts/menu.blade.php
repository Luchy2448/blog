<header class="header">
    <div class="menu">

        <div class="logo">
            <!--Logo-->
            <a href=""><img src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>
        @guest <!--Si no está logueado/autenticado-->
        <ul class="d-flex">
            <li class="me-2"><a href="{{ route('login') }}" class="login">Acceder</a></li>
            <li><a href="{{ route('register') }}" class="create">Crear cuenta</a></li>
        </ul>
        @else <!--Si está logueado/autenticado-->
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
               data-bs-toggle="dropdown" aria-expanded="false">

                <img src="{{ Auth::user()->profile->photo ? asset('storage/' . Auth::user()->profile->photo) : asset('img/user-default.png') }}" alt="Profile" class="rounded-circle" whidth="30px" height="30px" >
                {{-- <img src="{{ Auth::user()->profile->photo ? asset('storage/' . Auth::user()->profile->photo) : '' }}" > --}}
                <span class="name-user">{{ Auth::user()->full_name }}</span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item"
                        href="{{ route('profiles.edit', ['profile' => Auth::user()->profile->id]) }}">Perfil</a></li>
                @can('admin.index')
                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Ir al admin</a></li>
                @endcan
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf    
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                           document.getElementById('logout-form').submit();">Salir</a>
                </li>
            </ul>
        </div>
        @endguest
        </nav>
    </div>

</header>