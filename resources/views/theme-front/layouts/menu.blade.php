<header class="header js-header-scroll">
    <nav hidden="">
        <div class="nav-header">
            <a href="" class="brand">
                <img src="{{ asset('img/logo.png') }}" class="logo" alt="Tech Company">
            </a>
            <button class="toggle-bar">
                <span class="fa fa-bars"></span>
            </button>
        </div>
         <!-- Start Header menu for mobile -->
         <div class="header__mobile js-header-menu">
            <a href="#" class="header__mobile-brand">Menu</a>
            <button class="toggle-bar header__mobile-toggle">
                <span class="fa fa-remove"></span>
            </button>
        </div>
        <!-- End Header menu for mobile -->	
        
        {{-- menu --}}
        <div class="conteiner">
        <ul class="menu">
            <li class="nav-item "{{ request()->routeIs('theme-front.home') ? 'active' : ''}}>
                <a href="{{ route('theme-front.home') }}">Todo</a></li>

        @foreach ($navbar as $category)    
        <li class="nav-item {!! (Request::path()) == 'category/'.$category->slug ? 'active' : '' !!} ">
            <a href="{{ route('categories.detail', $category->slug) }}">{{ $category->name }}</a>
        </li>
        @endforeach

            <li><a href="{{ route('profiles.show', Auth::user()->profile->id) }}">Mis artículos</a></li>
        
      
        <li class="dropdown"><a href="#" role="button" id="dropdownMenuLink" 
            data-bs-toggle="dropdown" aria-expanded="false">

             <img src="{{ Auth::user()->profile->photo ? asset('storage/' . Auth::user()->profile->photo) : asset('img/user-default.png') }}" alt="Profile" class="rounded-circle" whidth="30px" height="30px" >
            
             <span class="name-user">{{ Auth::user()->full_name }}</span>
         </a>
            <ul class="dropdown-menu">
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
                    
                   
          </div>
        
    </nav>
</header>
