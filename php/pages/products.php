<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/products.css">
    <title>
        <?php
            $sql = "";
            if (array_key_exists("type", $_GET)) {
                $type = $_GET["type"];
                switch ($type) {
                    case "procesory": {
                        echo "Procesory";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%procesory%'";
                        break;
                    }
                    case "zakladne_dosky": {
                        echo "Základné dosky";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%zakladne dosky%'";
                        break;
                    }
                    case "disky": {
                        echo "Disky";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%disky%'";
                        break;
                    }
                    case "skrine": {
                        echo "Skrine";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%skrine%'";
                        break;
                    }
                    case "ram": {
                        echo "RAM";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%ram%'";
                        break;
                    }
                    case "graficke_karty": {
                        echo "Grafické karty";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%graficke karty%'";
                        break;
                    }
                    case "chladenie": {
                        echo "Chladenie";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%chladenie%'";
                        break;
                    }
                    case "zdroje": {
                        echo "Zdroje";
                        $sql = "SELECT * FROM products WHERE search_keys LIKE '%zdroje%'";
                        break;
                    }
                    default: {
                    }
                }
            }
            else
            {
                echo "Produkty";
                $sql = "SELECT * FROM products";
            }
        ?> - pcpartshop.sk
    </title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div style="min-height: calc(100vh - 80px - 72px); align-items: start; padding: 0 10vw; gap: 5vw;" id="content">
        <div id="filters">
            filters
        </div>
        <div id="right" style="width: 100%;">
            <?php include($_SERVER["DOCUMENT_ROOT"]."/php/components/catalogue.php"); ?>
            <div id="product-list">
                <?php
                    include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");
                    $result = db_query($sql);
                    if (mysqli_num_rows($result)) {
                        while ($product = mysqli_fetch_assoc($result)) {
                            $product_id = $product["id"];
                            $product_name = $product["name"];
                            $product_price = number_format($product["price"], 2);
                            echo "
                                <div class=\"product\">
                                    <a href=\"/product?id=$product_id\">
                                        <img src=\"\" class=\"thumbnail\" />
                                        <p class=\"product-name\">$product_name</p>
                                    </a>
                                    <div>
                                        <p class=\"product-price\">$product_price €</p>
                                        <p href=\"#\" class=\"button add-to-cart-button\">Do košíka</p>
                                    </div>
                                </div>";
                        }
                    }
                ?>
            </div>    
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>