<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/admin.css">
    <title>Admin - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div style="display: flex; flex-direction: row; gap: 4vw; padding-right: 5vw;">
        <div id="menu">
            <div id="orders" class="group">
                <a href="/admin?objednavky=vsetky" id="label">Objednávky</a>
                <div id="items">
                    <a href="/admin?objednavky=nove">Nové</a>
                    <a href="/admin?objednavky=pripravene">Pripravené</a>
                    <a href="/admin?objednavky=odoslane">Odoslané</a>
                    <a href="/admin?objednavky=dorucene">Doručené</a>
                </div>
            </div>
            <div id="products" class="group">
                <a href="/admin?produkty=vsetky" id="label">Produkty</a>
                <div id="items">
                    <a href="/admin?produkty=procesory">Procesory</a>
                    <a href="/admin?produkty=zakladne_dosky">Zakladné dosky</a>
                    <a href="/admin?produkty=disky">Disky</a>
                    <a href="/admin?produkty=skrine">Skrine</a>
                    <a href="/admin?produkty=ram">RAM</a>
                    <a href="/admin?produkty=graficke_karty">Grafické karty</a>
                    <a href="/admin?produkty=chladenie">Chladenie</a>
                    <a href="/admin?produkty=zdroje">Zdroje</a>
                </div>
            </div>
        </div>
        <div style="max-height: calc(100vh - 86px - 35px); height: calc(100vh - 86px - 35px); width: 100%; margin-top: 35px; display: flex; flex-direction: column; gap: 20px; padding-bottom: 50px;">
            <?php
                if (array_key_exists("produkty", $_GET)) {
                    echo
                        "<div id=\"filters\" style=\"width: 100%; height: 95px; background-color: var(--background-color2); border-radius: 20px;\">
                            filters
                        </div>";
                } else if (array_key_exists("objednavky", $_GET)) {
                    echo
                        "<div id=\"filters\" style=\"width: 100%; height: 95px; background-color: var(--background-color2); border-radius: 20px;\">
                            filters
                        </div>";
                }
            ?>
            <div style="overflow-y: scroll; margin-top: 30px; border-bottom: 1px solid var(--foreground-color1);">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <?php
                                if (array_key_exists("produkty", $_GET)) {
                                    echo "
                                        <th>ID</th>
                                        <th>Názov</th>
                                        <th>Značka</th>
                                        <th>Cena</th>
                                        <th>Počet</th>
                                        <th>Akcie</th>
                                        ";
                                } else if (array_key_exists("objednavky", $_GET)) {
                                    echo "
                                        <th>ID</th>
                                        <th>Meno objednávateľa</th>
                                        <th>Názov produktu</th>
                                        <th>Dátum</th>
                                        <th>Stav</th>
                                        <th>Akcie</th>
                                        ";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");
                            $query = "";
                            if (array_key_exists("produkty", $_GET)) {
                                $main_filter = $_GET["produkty"];
                                switch ($main_filter) {
                                    case "vsetky": {
                                        $query = "SELECT * FROM products";
                                        break;
                                    }
                                    case "procesory": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%procesory%'";
                                        break;
                                    }
                                    case "zakladne_dosky": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%zakladne dosky%'";
                                        break;
                                    }
                                    case "disky": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%disky%'";
                                        break;
                                    }
                                    case "skrine": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%skrine%'";
                                        break;
                                    }
                                    case "ram": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%ram%'";
                                        break;
                                    }
                                    case "graficke_karty": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%graficke karty%'";
                                        break;
                                    }
                                    case "chladenie": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%chladenie%'";
                                        break;
                                    }
                                    case "zdroje": {
                                        $query = "SELECT * FROM products WHERE search_keys LIKE '%zdroje%'";
                                        break;
                                    }
                                }
                            } else if (array_key_exists("objednavky", $_GET)) {
                                $main_filter = $_GET["objednavky"];
                                switch ($main_filter) {
                                    case "vsetky": {
                                        $query = "SELECT * FROM orders";
                                        break;
                                    }
                                    case "nove": {
                                        $query = "SELECT * FROM orders WHERE state='new'";
                                        break;
                                    }
                                    case "pripravene": {
                                        $query = "SELECT * FROM orders WHERE state='prepared'";
                                        break;
                                    }
                                    case "odoslane": {
                                        $query = "SELECT * FROM orders WHERE state='sent'";
                                        break;
                                    }
                                    case "dorucene": {
                                        $query = "SELECT * FROM orders WHERE state='delivered'";
                                        break;
                                    }
                                }
                            }
                            if ($query != "") {
                                $result = db_query($query);
                                if (mysqli_num_rows($result) > 0) {
                                    if (array_key_exists("produkty", $_GET)) {
                                        while ($product = mysqli_fetch_assoc($result)) {
                                            $id = $product["id"];
                                            $name = $product["name"];
                                            $brand = $product["brand"];
                                            $price = $product["price"];
                                            $count = $product["count"];
                                            echo "
                                                <tr>
                                                    <td>$id</td>
                                                    <td>$name</td>
                                                    <td>$brand</td>
                                                    <td style=\"color: var(--important-color);\">$price €</td>
                                                    <td>$count</td>
                                                    <td></td>
                                                </tr>
                                                ";
                                        }
                                    } else if (array_key_exists("objednavky", $_GET)) {
                                        while ($order = mysqli_fetch_assoc($result)) {
                                            $id = $order["id"];
                                            $time_ordered = $order["time_ordered"];
                                            $state = $order["state"];
                                            $state_text = "";
                                            switch ($state) {
                                                case "new": $state_text = "Nová"; break;
                                                case "prepared": $state_text = "Pripravená"; break;
                                                case "sent": $state_text = "Odoslaná"; break;
                                                case "delivered": $state_text = "Doručená"; break;
                                            }
                                            echo "
                                                <tr>
                                                    <td>$id</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>$time_ordered</td>
                                                    <td><div class=\"order-state-$state\">$state_text</div></td>
                                                    <td></td>
                                                </tr>
                                                ";
                                        }
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="panel" style="display: flex; flex-direction: row; justify-content: right; gap: 20px;">
                <div id="add-product-button" class="button">Pridať produkt</div>
            </div>
        </div>
    </div>
</body>
</html>