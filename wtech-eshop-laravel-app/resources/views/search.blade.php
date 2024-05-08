
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>pcpartshop.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    @vite('resources/css/main.css')
    @vite('resources/css/pages/search.css')
</head>
<body>
    @include('components.navbar')

    <div id="content" class="items-top">
        <div class="container" style="max-width: 900px; width: 100%; margin: 0 20px;">
            <p>{{$products->total()}} položiek</p>
            <div id="search-results">
                @foreach ($products as $product)
                <div class="product-item">
                    <a href="{{ route('detail', ['id' => $product->id]) }}">
                        <div id="thumbnail">
                            <img src="{{ asset('dbimages/'.$product->images->first()->image) }}" />
                        </div>
                        <div id="other">
                            <div class="info">
                                <h3>{{$product->name}}</h3>
                                <p>{{$product->description}}</p>
                            </div>
                    </a>
                    <div class="actions">
                        <div id="left">
                            <span>{{$product->count}} ks</span>
                        </div>
                        <div id="right">
                            <span id="price">{{$product->price}} €</span>
                            <a href="{{ route('detail', ['id' => $product->id]) }}" class="btn card_btn">Kúpiť</a>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <nav class="d-flex justify-content-center">
        {{ $products->appends(['key' => request('key')])->links() }}
    </nav>

    @include('components.mainfooter')
</body>
</html>
