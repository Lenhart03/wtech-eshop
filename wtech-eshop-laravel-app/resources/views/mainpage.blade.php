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

    @vite('resources/css/main.css')
    @vite('resources/css/pages/index.css')
</head>

<body>
    @include('components.navbar')

    @include('components.categories')

    @php
        $firstProduct = $products->shift();
    @endphp
    <div class="featured">
        <ul class="cards cards-action">
            <li class="cards_item">
                <div class="card">
                    <div class="card_image"><a href="{{ route('detail', ['id' => $firstProduct->id]) }}"><img src="{{ asset('storage/dbimages/'.$firstProduct->images->first()->image) }}"></a></div>
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
                        <div class="card_image"><a href="{{ route('detail', ['id' => $product->id]) }}"><img src="{{ asset('storage/dbimages/'.$product->images->first()->image) }}"></a></div>
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
