<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/search.css">
    <title><?php if (array_key_exists("key", $_GET)) echo $_GET["key"]; ?> - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <script>
        function updatePrice(input, price) {
            input.parentElement.parentElement.querySelector("#price").innerHTML = (Math.round(input.value * price * 100) / 100).toFixed(2) + " €";
        }
    </script>
    <div style="height: calc(100vh - 80px - 72px);" id="content" class="items-top">
        <?php
        echo "<div style=\"max-width: 900px; width: 100%; margin: 0 20px;\">";
        
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");
        $key = $_GET["key"];
        $result = db_query("SELECT * FROM products WHERE name LIKE '%$key%' OR search_keys LIKE '%$key%'");
        
        $result_count = mysqli_num_rows($result);
        echo "<p>$result_count položiek</p>";

        echo "<div id=\"search-results\">";
        if ($result_count > 0)
        {
            while ($product = mysqli_fetch_assoc($result))
            {
                $product_id = $product["id"];
                $product_name = $product["name"];
                $product_desc = $product["description"];
                $product_count = $product["count"];
                $product_price = number_format(round($product["price"], 2), 2);
                echo "
                    <div class=\"product-item\">
                            <a href=\"/product?id=".$product["id"]."\">
                        <div id=\"thumbnail\">
                            <img src=\"\" />
                        </div>
                        <div id=\"other\">
                            <div class=\"info\">
                                <h3>$product_name</h3>
                                <p>$product_desc</p>
                            </div>
                            </a>
                            <div class=\"actions\">
                                <div id=\"left\">
                                    <span>Na sklade: $product_count ks</span>
                                </div>
                                <div id=\"right\">
                                    <input id=\"count\" type=\"number\" min=\"1\" max=\"$product_count\" value=\"1\" onchange=\"updatePrice(this, $product_price)\" />
                                    <span id=\"price\">$product_price €</span>
                                    <span class=\"button add-to-cart-button\" onclick=\"add_to_cart($product_id, Number(this.parentElement.parentElement.querySelector('input#count').value))\">Do košíka</span>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        }
        echo "</div>";

        echo "</div>";
        ?>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>
