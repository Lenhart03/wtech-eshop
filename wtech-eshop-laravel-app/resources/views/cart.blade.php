
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prihlásenie - pcpartshop.sk</title>
    <link rel="icon" href="../../../res/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    

    @vite('resources/css/main.css')
    @vite('resources/css/pages/cart.css')
</head>
<body>
    @include('components.navbar')

        <div id="content">
            <table class="container" id="cart-items" style="display: table;">
                @foreach($products as $product)
                    <tbody>
                        <tr class="cart-item">
                            <td><a href="/product?id=6">{{$product->name}}</a></td>
                            <td id="count-and-price">
                                <input type="number" id="count" min="1" value={{$cart[$product->id]}} onchange="updateCartItemPrice(this, 690, 6)">
                                <span id="price">{{$product->price}} €</span>
                            </td>
                            <td>
                                <a class="material-icons" style="cursor: pointer;" onclick="deleteCartItem(this, 6)" data-toggle="tooltip" data-placement="left" title="Odstrániť">delete</a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
                
            </table>
            <div id="bottom">
                <span class="button" id="empty-cart-button" onclick="emptyCart()">Vyprázdniť košík</span>
                <a href="order.html"><span class="button" id="buy-button">Kúpiť</span></a>
            </div>
        </div>
        <style>
            #cart-items {
                display: table;
            }
        </style>
        <script>
            $(document).ready(function() {
                $("body").tooltip({ selector: '[data-toggle=tooltip]' }).tooltip({ container: 'body' });
            });
        </script>
    
    @include('components.mainfooter')
</body>
</html>