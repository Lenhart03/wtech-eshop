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
            <p><b>Doprava</b></p>
            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.27273 16.6307L7.51705 14.892L12.7756 9.63352H0V7.09375H12.7756L7.51705 1.84375L9.27273 0.0965905L17.5398 8.36364L9.27273 16.6307Z" fill="black"/>
            </svg>
            <p>Platba</p>
        </div>

        <script>
            window.onload = function() {
                document.getElementsByName('sposob_dopravy').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        var isPobocka = this.value === 'pobocka';
                        ['ulica', 'psc'].forEach(function(name) {
                            var input = document.getElementsByName(name)[0];
                            input.style.display = isPobocka ? 'none' : 'block';
                            if (isPobocka) {
                                input.required = false;
                            } else {
                                input.required = true;
                            }
                        });
                    });
                });
            };
        </script>

        <div class="row">
            <form method="POST" action="/order/payment">
                @csrf
                <div class="row">
                    <div class="row">
                        <div class="col-lg-12 box">
                            <input type="radio" name="sposob_dopravy" value="kurier" id="kurierom" required>
                            <label for="kurierom">Kuriérom</label>
                        </div>
                        <div class="col-lg-12 box">
                            <input type="radio" name="sposob_dopravy" value="balikomat" id="balikomat" required>
                            <label for="balikomat">Do balíkomatu</label>
                        </div>
                        <div class="col-lg-12 box">
                            <input type="radio" name="sposob_dopravy" value="pobocka" id="pobocka" required>
                            <label for="pobocka">Na pobočke</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @auth
                        <div class="col-lg-6">
                            <input type="text" name="meno" placeholder="Meno" value="{{ Auth::user()->firstname }}" required>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="priezovisko" placeholder="Priezvisko" value="{{ Auth::user()->lastname }}" required>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <input type="text" name="meno" placeholder="Meno" required>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="priezovisko" placeholder="Priezvisko" required>
                        </div>
                    @endauth
                </div>
                <div class="row" id="ulica-psc">
                    <div class="col-lg-8"><input type="text" name="ulica" placeholder="Ulica" required></div>
                    <div class="col-lg-4"><input type="text" name="psc" placeholder="PSČ" required></div>
                </div>
                <div class="row">
                    @auth
                        <div class="col-lg-6"><input type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}" required></div>
                    @else
                        <div class="col-lg-6"><input type="text" name="email" placeholder="Email" required></div>
                    @endauth
                    <span class="col-lg-6"></span>
                </div>
                <div class="row">
                    <div class="col-lg-6"><input type="text" name="telefon" placeholder="Telefónne číslo" required></div>
                    <div class="col-lg-6 submit"><input type="submit" value="Pokračovať k platbe" class="button"></div>
                </div>
            </form>
        </div>
    </div>

    @include('components.mainfooter')

</body>

</html>
