<!DOCTYPE html>
<html lang="en">

<head>
    <title>pcpartshop.sk</title>
    <link rel="icon" href="../../../res/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/pages/products.css') }}">
</head>

<body>
    @include('components.navbar')

    <div class="container">
        <div class="row">
            <div class="col-lg-3 filters">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="background">
                        <p class="label">Zoradenie</p>
                        <div>
                            <div class="row filter sort">
                                <p>Cena</p>
                                <select name="cena" id="cena" onchange="this.form.submit()">
                                    <option value="asc" {{ request('cena') == 'asc' ? 'selected' : '' }}>Od najlacnejšieho</option>
                                    <option value="desc" {{ request('cena') == 'desc' ? 'selected' : '' }}>Od najdrahšieho</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="background" style="margin-top: 5px">
                        <p class="label">Filtre</p>
                        <div>
                            <div class="row filter">
                                <p>Značka</p>
                                <select name="znacka" id="znacka" onchange="this.form.submit()">
                                    <option value="">Všetky</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->brand }}" {{ request('znacka') == $brand->brand ? 'selected' : '' }}>
                                            {{ $brand->brand }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row filter">
                                <p>Najnižšia cena:</p>
                                <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" onchange="this.form.submit()">
                            </div>
                            <div class="row filter">
                                <p>Najvyšia cena:</p>
                                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" onchange="this.form.submit()">
                            </div>
                            <div class="row filter">
                                <p>Param2</p>
                                <select name="param2" id="param2" onchange="this.form.submit()">
                                    <!-- Add your options here -->
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-lg-9">

                @include('components.categories')

                <div class="product-list">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="product">
                                    <a href="{{ route('detail', ['id' => $product->id]) }}">
                                        <img src="{{ asset('storage/app/public/dbimages/'.$product->images->first()->image) }}" class="thumbnail">
                                    </a>
                                    <p class="product-name">{{$product->name}}</p>
                                    <div class="row">
                                        <p class="col-sm-6 product-price">{{$product->price}}</p>
                                        <p href="#" class="col-sm-6 button add-to-cart-button">Do košíka</p>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <nav class="d-flex justify-content-center">
                    {{ $products->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>
    
    @include('components.mainfooter')

</body>

</html>