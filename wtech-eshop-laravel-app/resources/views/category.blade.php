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
                                @if($category == 'CPU')
                                    <p>Počet jadier</p>
                                    <select name="cpu-cores" id="cpu-cores" onchange="this.form.submit()">
                                        <option value=""></option>
                                        <option value="2" {{ request('cpu-cores') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="4" {{ request('cpu-cores') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="6" {{ request('cpu-cores') == '6' ? 'selected' : '' }}>6</option>
                                        <option value="8" {{ request('cpu-cores') == '8' ? 'selected' : '' }}>8</option>
                                        <option value="12" {{ request('cpu-cores') == '12' ? 'selected' : '' }}>12</option>
                                        <option value="16" {{ request('cpu-cores') == '16' ? 'selected' : '' }}>16</option>
                                        <option value="32" {{ request('cpu-cores') == '32' ? 'selected' : '' }}>32</option>
                                        <option value="64" {{ request('cpu-cores') == '64' ? 'selected' : '' }}>64</option>
                                    </select>
                                @endif
                                @if($category == 'GPU')
                                    <p>Veľkosť pamäte (GB)</p>
                                    <p></p>
                                    <input type="number" name="min_mem" id="min_mem" placeholder="Od" value="{{ request('min_mem') }}" onchange="this.form.submit()">
                                    <input type="number" name="max_mem" id="max_mem" placeholder="Do" value="{{ request('max_mem') }}" onchange="this.form.submit()">
                                @endif
                                @if($category == 'ram')
                                    <p>Typ pamäte</p>
                                    <select name="ram-type" id="ram-type" onchange="this.form.submit()">
                                        <option value=""></option>
                                        <option value="DDR3" {{ request('ram-type') == 'DDR3' ? 'selected' : '' }}>DDR3</option>
                                        <option value="DDR4" {{ request('ram-type') == 'DDR4' ? 'selected' : '' }}>DDR4</option>
                                        <option value="DDR5" {{ request('ram-type') == 'DDR5' ? 'selected' : '' }}>DDR5</option>
                                    </select>
                                @endif
                                @if($category == 'Motherboard' or $category == 'power supply' or $category == 'case')
                                    <p>Formát</p>
                                    <select name="format" id="format" onchange="this.form.submit()">
                                        <option value=""></option>
                                        <option value="ATX" {{ request('format') == 'ATX' ? 'selected' : '' }}>ATX</option>
                                        <option value="Micro ATX" {{ request('format') == 'Micro ATX' ? 'selected' : '' }}>Micro ATX</option>
                                        <option value="Mini ITX" {{ request('format') == 'Mini ITX' ? 'selected' : '' }}>Mini ITX</option>
                                    </select>
                                @endif
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
                                        <p class="col-sm-6 product-price">{{$product->price}} €</p>
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