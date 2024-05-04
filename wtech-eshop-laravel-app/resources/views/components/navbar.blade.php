<link rel="stylesheet" href="{{ asset('resources/css/components/navbar.css') }}">

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid container-navbar">
            <a class="navbar-logo" href="{{ url('/') }}"><img src="{{ asset('storage/app/public/images/logo.png')}}" alt="logo"></a>
            <form class="searchbar" role="search" method="GET" action="{{ url('/search') }}">
                <input name="key" placeholder="Vyhľadávanie" />
            </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-loginregister mb-2 mb-lg-0">
                <li class="nav-item shoping-cart">
                <a href="cart.html" id="cart-button" class="button navbar-cart" data-toggle="tooltip" data-placement="bottom" title="Košík">
                    <i class="material-icons">shopping_cart</i>
                    <span id="items-in-cart" style="position:absolute; font-size: 16px; min-width: 45px; text-align: center; margin-right: 40px;">0</span>
                </a>
                </li>
                <li class="nav-item">
                    <a href="login.html" class="btn login-button" type="submit">Prihlasenie</a>
                </li>
                <li class="nav-item">
                    <a href="register.html" class="btn register-button" type="submit">Registracia</a>
                </li>
            
            </ul>
        
        </div>
    </div>
</nav>