<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/cart.css">
    <title>Košík - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div style="max-height: calc(100vh - 80px - 72px); height: calc(100vh - 80px - 72px);" id="content" class="container">
        <table class="container" id="cart-items" style="display: none;">
        </table>
        <script>
            function updateCartItemPrice(input, price, product_id) {
                input.parentElement.querySelector("#price").innerHTML = (Number(input.value) * price).toFixed(2) + " €";
                if (localStorage.getItem("cart_products") == null)
                    localStorage.setItem("cart_products", JSON.stringify([]));
                cart = JSON.parse(localStorage.getItem("cart_products"));
                const index = cart.findIndex(product => {
                    return product.product_id == product_id;
                });
                cart[index].count = Number(input.value);
                localStorage.setItem("cart_products", JSON.stringify(cart));
                let items_in_cart = 0;
                for (const item of cart)
                    items_in_cart += item.count;
                document.querySelector("#items-in-cart").innerHTML = items_in_cart;
            }
            function deleteCartItem(close_button, product_id) {
                if (localStorage.getItem("cart_products") == null)
                    localStorage.setItem("cart_products", JSON.stringify([]));
                cart = JSON.parse(localStorage.getItem("cart_products"));
                const index = cart.findIndex(product => {
                    return product.product_id == product_id;
                });
                cart.splice(index, 1);
                localStorage.setItem("cart_products", JSON.stringify(cart));
                close_button.parentElement.parentElement.parentElement.removeChild(close_button.parentElement.parentElement);
                let items_in_cart = 0;
                for (const item of cart)
                    items_in_cart += item.count;
                document.querySelector("#items-in-cart").innerHTML = items_in_cart;
            }
            function emptyCart() {
                localStorage.setItem('cart_products', null);
                document.querySelector('#cart-items').innerHTML='';
                document.querySelector("#items-in-cart").innerHTML = 0;
            }
            function get_product_one_by_one_recusively(list) {
                if (list.length == 0)
                {
                    document.querySelector("#cart-items").style.display = "table";
                    return;
                }
                const cart_product = list[list.length-1];
                var http = new XMLHttpRequest();
                http.open("POST", "/php/logic/get_product.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                var params = "product_id=" + cart_product.product_id;
                http.send(params);
                list.pop();
                http.onload = function() {
                    const product = JSON.parse(http.responseText);
                    cart_element.innerHTML += `
                        <tr class=\"cart-item\">
                            <td><a href="/product?id=`+product.id+`">`+product.name+`</a></td>
                            <td id=\"count-and-price\">
                                <input type="number" id="count" min="1" value="`+cart_product.count+`" onchange="updateCartItemPrice(this, `+product.price+`, `+product.id+`)" />
                                <span id="price">`+(cart_product.count * product.price).toFixed(2)+` €</span>
                            </td>
                            <td><a class="material-symbols-outlined" style="cursor: pointer;" onclick="deleteCartItem(this, `+product.id+`)" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Odstrániť\">delete</a></td>
                        </tr>`;
                    get_product_one_by_one_recusively(list);
                }
            }

            let cart_element = document.querySelector("#cart-items");
            let cart_products = JSON.parse(localStorage.getItem("cart_products"));
            if (cart_products)
            {
                let list = [];
                for (let cart_product of cart_products) {
                    list.push(cart_product);
                }
                get_product_one_by_one_recusively(list);
            }
        </script>
        <div id="bottom">
            <span class="button" id="empty-cart-button" onclick="emptyCart()">Vyprázdniť košík</span>
            <a href="/order"><span class="button" id="buy-button">Kúpiť</span></a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' }).tooltip({ container: 'body' });
        });
        
    </script>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>