<!DOCTYPE html>
<html lang="en">

<head>
    <title>pcpartshop.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    @vite('resources/css/main.css')
    @vite('resources/css/pages/detail.css')
</head>

<body>
    @include('components.navbar')
    
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 gallery">
                @if($product->images->isNotEmpty())
                    <div class="main-image">
                        <img class="d-block mx-auto" src="{{ asset('dbimages/' . $product->images->first()->image) }}" alt="main">
                    </div>
                    @for($i = 0; $i < count($product->images); $i++)
                        @if($i % 4 == 0)
                            <div class="row gallery-images">
                        @endif
                        <div class="col">
                            <img class="square-images d-block mx-auto" src="{{ asset('dbimages/' . $product->images[$i]->image) }}" alt="gallery">
                        </div>
                        @if($i % 4 == 3 || $i == count($product->images) - 1)
                            </div>
                        @endif
                    @endfor
                @endif
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="row">
                    <h1 class="product-name">{{$product->name}}</h1>
                </div>
                <div class="row">
                    <p class="product-description">{{$product->description}}</p>
                </div>
                @if($product->count > 0)
                    <div class="row" style="margin-top: 40px;">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <p class="product-stock">{{$product->count}} ks</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <a class="product-number">
                                <button id="decrement">-</button>
                                <input type="number" id="number" value="1" min="1" max="{{$product->count}}" onchange="updatePrice(this,{{$product->price}})" readonly onkeydown="return false;">
                                <button id="increment">+</button>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <span class="product-price" id="price">{{$product->price}} €</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <a class="btn product-buy">Do košíka</a>
                        </div>
                    </div>
                @else
                <div class="row" style="margin-top: 40px;">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <p class="product-stock">{{$product->count}} ks</p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <span class="product-price" id="price">{{$product->price}} €</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <a class="btn product-buy">Vypredané</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row" style="margin-top: 40px;">
            <div class="col-lg-12">
                <h2 class="product-specs">Parametre</h2>
                <table class="table table-striped">
                    <tbody>
                        @foreach ($product->parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->name }}</td>
                                <td>{{ $parameter->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>


    
    @include('components.mainfooter')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>/*Script pre upravu ceny a mnozstva produktov*/
        $(document).ready(function() {
            var decrementButton = $('#decrement');
            var incrementButton = $('#increment');
            var numberField = $('#number');

            var price = {!! json_encode($product->price) !!};
            var count = {!! json_encode($product->count) !!};

            decrementButton.click(function() {
                var currentNumber = parseInt(numberField.val(), 10);
                if (currentNumber > 1) {
                    numberField.val(currentNumber - 1);
                }
                updatePrice(numberField.val(), price);
            });

            incrementButton.click(function() {
                var currentNumber = parseInt(numberField.val(), 10);
                numberField.val(currentNumber + 1);
                if (currentNumber + 1 > count) {
                    numberField.val(currentNumber);
                }
                updatePrice(numberField.val(), price);
            });

            numberField.on('input', function() {
                updatePrice($(this).val(), price);
            });

            function updatePrice(quantity, price) {
                var totalPrice = (Math.round(quantity * price * 100) / 100).toFixed(2);
                $("#price").html(totalPrice + " €");
            }
        });
    </script>
    <script>/*Script na highlightovanie a vymenu obrazku*/
        var squareImages = document.querySelectorAll('.square-images');
        
        var firstSquareImage = squareImages[0];
        var mainImage = document.querySelector('.main-image img');
        mainImage.src = firstSquareImage.src;
        firstSquareImage.classList.add('highlight');

        for (var i = 0; i < squareImages.length; i++) {
            squareImages[i].addEventListener('click', function(event) {
                var clickedImageSrc = event.target.src;
                var mainImage = document.querySelector('.main-image img');
                mainImage.src = clickedImageSrc;
    
                for (var j = 0; j < squareImages.length; j++) {
                    squareImages[j].classList.remove('highlight');
                }
    
                event.target.classList.add('highlight');
            });
        }
    </script>

</body>

</html>