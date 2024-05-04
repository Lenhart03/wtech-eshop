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
</head>

<body>
    @include('components.navbar')



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
                    <div class="card_image"><a href="{{ route('detail', ['id' => $firstProduct->id]) }}"><img src="{{ asset('storage/app/public/dbimages/'.$firstProduct->images->first()->image) }}"></a></div>
                    <div class="card_content">
                        <h2 class="card_title">
                            <a class="card_title" href="{{ route('detail', ['id' => $firstProduct->id]) }}">
                                {{ $firstProduct->name }}
                            </a>
                        </h2>
                        <p class="card_text">{{ $firstProduct->description }}</p>
                        <div class="price_and_button">
                            <h3 class="card_price">{{ $firstProduct->price }} €</h3>
                            <a href="{{ route('detail', ['id' => $firstProduct->id]) }}" class="btn card_btn">Kúpiť</a>
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
                        <div class="card_image"><a href="{{ route('detail', ['id' => $product->id]) }}"><img src="{{ asset('storage/app/public/dbimages/'.$product->images->first()->image) }}"></a></div>
                        <div class="card_content">
                            <h2 class="card_title">
                                <a class="card_title" href="{{ route('detail', ['id' => $product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </h2>
                            <p class="card_text">{{ $product->description }}</p>
                            <div class="price_and_button">
                                <h3 class="card_price">{{ $product->price }} €</h3>
                                <a href="{{ route('detail', ['id' => $product->id]) }}" class="btn card_btn">Kúpiť</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <nav class="d-flex justify-content-center">
        {{ $products->links() }}
    </nav>

      
    @include('components.mainfooter')

</body>

</html>