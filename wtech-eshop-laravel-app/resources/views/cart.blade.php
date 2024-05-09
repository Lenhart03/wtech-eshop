
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prihlásenie - pcpartshop.sk</title>
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
                            <td><a href="{{ route('detail', ['id' => $product['product']->id]) }}">{{$product['product']->name}}</a></td>
                            <td id="count-and-price">
                                <form method="POST" action="/update_cart">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product['product']->id}}">
                                    <input type="number" name="quantity" min="1" value="{{$product['quantity']}}" onchange="this.form.submit()">
                                </form>
                                <span id="price">{{$product['product']->price * $product['quantity']}} €</span>
                            </td>
                            <td>
                                <form method="POST" action="/update_cart">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product['product']->id}}">
                                    <input type="hidden" name="quantity" value="0">
                                    <a class="material-icons" style="cursor: pointer;" onclick="this.parentNode.submit()" data-toggle="tooltip" data-placement="left" title="Odstrániť">delete</a>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div id="bottom">
                <form method="GET" action="/order">
                    @csrf
                    <input type="hidden" name="products" value="{{ json_encode($products) }}">
                    <button type="submit" class="button" id="buy-button">Kúpiť</button>
                </form>
            </div>
        </div>
        <style>
            #cart-items {
                display: table;
            }
        </style>

    
    @include('components.mainfooter')
</body>
</html>