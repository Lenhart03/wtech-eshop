@vite('resources/css/components/navbar.css')

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid container-navbar">
            <a class="navbar-logo" href="{{ url('/') }}"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
            @if (request()->server('PATH_INFO') != '/admin')
                <form class="searchbar" role="search" method="GET" action="{{ url('/search') }}">
                    <input name="key" placeholder="Vyhľadávanie" />
                </form>
            @else
                <p style="font-size: 24px; width: 65%; margin-top: 10px;">Administrátor
                    @if (request()->get('orders'))
                        / Objednávky
                    @elseif (request()->get('products'))
                        / Produkty
                    @endif
                </p>
            @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-loginregister mb-2 mb-lg-0">
                @if (request()->server('PATH_INFO') != '/admin')
                    <li class="nav-item shoping-cart">
                    <a href="{{route('cart')}}" id="cart-button" class="button navbar-cart" data-toggle="tooltip" data-placement="bottom" title="Košík">
                        <i class="material-icons">shopping_cart</i>
                        <span id="items-in-cart" style="position:absolute; font-size: 16px; min-width: 45px; text-align: center; margin-right: 40px;">
                            {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                        </span>
                    </a>
                    </li>
                @endif

                @auth
                    <p class='user_name'>{{auth()->user()->firstname}}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn logout-button" type="submit">Odhlásiť</button>
                    </form>
                @else
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="btn login-button" type="submit">Prihlasenie</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('register')}}" class="btn register-button" type="submit">Registracia</a>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
