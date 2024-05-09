
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrácia - pcpartshop.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    

    @vite('resources/css/main.css')
    @vite('resources/css/pages/register.css')
</head>
<body>
    @include('components.navbar')
    
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
        let cart = JSON.parse(localStorage.getItem("cart_products"));
        if (cart) {
            let items_in_cart = 0;
            for (const item of cart)
                items_in_cart += item.count
            document.querySelector("#items-in-cart").innerHTML = items_in_cart;
        }
    </script>
    
    <div id="errors">
        <div class="container">
        </div>
    </div>

    <div class="container" id="content">
        <form action="register" method="POST" id="register-form">
            @csrf
            <h1>Registrácia</h1>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="firstname" placeholder="Meno" required value="" />
                    @error('firstname')
                        <p class="text-red-500 text-xs"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="lastname" placeholder="Priezvisko" required value="" />
                    @error('lastname')
                        <p class="text-red-500 text-xs"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            <input type="text" class="form-control" name="email" placeholder="Email" required value="" />
            @error('email')
                <p class="text-red-500 text-xs"> {{ $message }}</p>
            @enderror
            <input type="password" class="form-control" name="password" placeholder="Heslo" required value=""/>
            @error('password')
                <p class="text-red-500 text-xs"> {{ $message }}</p>
            @enderror
            <input type="password" class="form-control" name="password_confirmation" placeholder="Potvrdiť heslo" required value=""/>

            @error('password_confirmation')
                <p class="text-red-500 text-xs"> {{ $message }}</p>
            @enderror

            <div id="policy">
                <p>Kliknutím na Registrovať súhlasíte s našimi</p>
                <a href="#">Zásadami ochrany osobných údajov.</a>
            </div>

            <input type="submit" value="Registrovať" class="btn btn-primary" id="register-submit-button" />
        </form>
    </div>

    @include('components.mainfooter')

</body>
</html>