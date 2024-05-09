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
    @vite('resources/css/pages/order-payment.css')
</head>

<body>
    @include('components.navbar')

    <div class="container">
        <div class="row breadcrumbs">
            <p>Košík</p>
            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.27273 16.6307L7.51705 14.892L12.7756 9.63352H0V7.09375H12.7756L7.51705 1.84375L9.27273 0.0965905L17.5398 8.36364L9.27273 16.6307Z" fill="black"/>
            </svg>
            <p>Doprava</p>
            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.27273 16.6307L7.51705 14.892L12.7756 9.63352H0V7.09375H12.7756L7.51705 1.84375L9.27273 0.0965905L17.5398 8.36364L9.27273 16.6307Z" fill="black"/>
            </svg>
            <p><b>Platba</b></p>
        </div>
        <div class="row">
            <div class="summary">
                <h5>Zhrnutie objednávky</h5>
                <div class="row">
                    <div class="col">
                        <ul id="orderlist">
                            @foreach($products as $product)
                            <li><span class="name">{{$product['product']->name}} {{$product['quantity']}}ks</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <ul id="pricelist">
                            @foreach($products as $product)
                            <li><span class="price">{{$product['quantity'] * $product['product']->price}} €</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <h5>Celková suma: <span id="total"></span></h5>
            </div>
        </div>
        <div class="row">
            <script>
                function showCardForm(bool) {
                    if (bool) {
                        document.getElementById("card-form").classList.remove('hide');
                        for (let e of document.querySelectorAll("#card-form input")) {
                            e.required = true;
                        }
                    }
                    else {
                        document.getElementById("card-form").classList.add('hide');
                        for (let e of document.querySelectorAll("#card-form input")) {
                            e.required = false;
                        }
                    }
                }
            </script>
            <form method="POST" action="/payment/confirmation">
                @csrf
                <input type="hidden" name="sposob_dopravy" value="{{$request->sposob_dopravy}}">
                <input type="hidden" name="meno" value="{{$request->meno}}">
                <input type="hidden" name="priezvisko" value="{{$request->priezovisko}}">
                <input type="hidden" name="ulica" value="{{$request->ulica}}">
                <input type="hidden" name="psc" value="{{$request->psc}}">
                <input type="hidden" name="telefon" value="{{$request->telefon}}">
                <div class="row">
                    <div class="col-lg-12 box">
                        <input type="radio" name="sposob_platby" value="dobierkou" id="dobierkou" required onchange="showCardForm(false)">
                        <label for="dobierkou">Dobierkov</label>
                    </div>
                    <div class="col-lg-12 box">
                        <input type="radio" name="sposob_platby" value="kartou" id="kartou" required onchange="showCardForm(true)">
                        <label for="kartou">Online kartou</label>
                    </div>
                </div>
                <div class="row hide" id="card-form">
                    <div class="col-lg-6"><input type="text" name="cislo_karty" placeholder="Číslo karty" required></div>
                    <div class="col-lg-4"><input type="text" name="datum_platnosti" placeholder="Dátum platnosti" required></div>
                    <div class="col-lg-2"><input type="text" name="cvc" placeholder="CVC" required></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 submit"><input type="submit" value="Zaplatiť" class="button"></div>
                </div>
            </form>
        </div>
    </div>
      
    @include('components.mainfooter')

    <script>/* suma ceny produktov*/
        window.onload = function() {
            var total = 0;
            var prices = document.getElementsByClassName('price');
    
            for (var i = 0; i < prices.length; i++) {
                var price = parseFloat(prices[i].textContent.replace(' €', ''));
                total += price;
            }
            document.getElementById('total').textContent = total.toFixed(2) + ' €';
        }
    </script>

</body>

</html>