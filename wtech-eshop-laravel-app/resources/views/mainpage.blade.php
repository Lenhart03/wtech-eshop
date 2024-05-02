<!DOCTYPE html>
<html lang="en">

<head>
    <title>pcpartshop.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/pages/index.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/components/main_footer.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid container-navbar">
            <a class="navbar-logo" href="../../html/pages/index.html"><img src="{{ asset('resources/images/logo.png')}}" alt="logo"></a>
            <form class="searchbar" role="search" action="search.html">
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



    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="procesory" class="btn categories-button">Procesory</a>
            </div>
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="zakladne_dosky" class="btn categories-button">Základné dosky</a>
            </div>
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="disky" class="btn categories-button">Disky</a>
            </div>
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="skrine" class="btn categories-button">Skrine</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="ram" class="btn categories-button">RAM</a>
            </div>
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="graficke_karty" class="btn categories-button">Grafické karty</a>
            </div>
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="zdroje" class="btn categories-button">Zdroje</a>
            </div>
            <div class="col-md-3 col-sm-6 categories">
                <a href="products.html" id="chladice" class="btn categories-button">Chladiče</a>
            </div>
        </div>
    </div>

    @php
        $firstProduct = $products->shift();
    @endphp
    
    <div class="featured">
        <ul class="cards cards-action">
            <li class="cards_item">
                <div class="card">
                    <div class="card_image"><a href="detail.html"><img src="../../placeholders/file.svg"></a></div>
                    <div class="card_content">
                        <h2 class="card_title">{{ $firstProduct->name }}</h2>
                        <p class="card_text">{{ $firstProduct->description }}</p>
                        <div class="price_and_button">
                            <h3 class="card_price">{{ $firstProduct->price }} €</h3>
                            <button class="btn card_btn">Kúpiť</button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    
    <div id="featured" class="container">
        <div class="row g-3">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card_image"><a href="detail.html"><img src="../../placeholders/file.svg"></a></div>
                        <div class="card_content">
                            <h2 class="card_title">{{ $product->name }}</h2>
                            <p class="card_text">{{ $product->description }}</p>
                            <div class="price_and_button">
                                <h3 class="card_price">{{ $product->price }} €</h3>
                                <button class="btn card_btn">Kúpiť</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <nav>
        <ul class="pagination justify-content-center">
          <li class="page-number"><a class="page-link">Predošlá</a></li>
          <li class="page-number"><a class="page-link">1</a></li>
          <li class="page-number"><a class="page-link">2</a></li>
          <li class="page-number"><a class="page-link">3</a></li>
          <li class="page-number"><a class="page-link">Ďalšia</a></li>
        </ul>
    </nav>
    

      
    <div class="main-footer">
        <a href="contact.html" class="side" id="contact">KONTAKTY</a>
        <a href="index.html" class="mid">pcpartshop</a>
        <a href="about.html" class="side" id="about">O NÁS</a>
    </div>

</body>

</html>