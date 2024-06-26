<link rel="stylesheet" href="/css/components/navbar.css">
<div id="navbar">
    <div id="logo">
        <a href="/"><img src="/res/images/logo.png" alt=""></a>
    </div>
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");
        
        $loggedin = array_key_exists("user", $_SESSION);
        
        $adminpage = str_contains($_SERVER['REQUEST_URI'], '/admin');
        
        $isuseradmin = false;
        if ($loggedin) $isuseradmin = $_SESSION["user"]["user_group"] == "admin";
        
        $userfullname = "";
        if ($loggedin) $userfullname = $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"];

        // middle - searchbar
        echo "<div id=\"center\">";
        if (!$adminpage)
        {
            $key = "";
            if (array_key_exists("key", $_GET)) $key = $_GET["key"];
            echo "
                <form action=\"/search\" id=\"searchbar\" method=\"GET\">
                    <input name=\"key\" placeholder=\"Vyhľadávanie\" required value=\"$key\" />
                </form>";
        }
        else if ($isuseradmin)
        {
            echo "<div id=\"breadcrumbs\">Administrátor";
            if (array_key_exists("objednavky", $_GET)) echo "/Objednávky";
            if (array_key_exists("produkty", $_GET)) echo "/Produkty";
            echo "</div>";
        }
        echo "</div>";
        
        // right side
        echo "<div class=\"content-right\">";
        if (!$loggedin)
        {
            // cart
            echo "
                <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0\" />
                <a href=\"/cart\" id=\"cart-button\" class=\"button\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Košík\">
                    <span class=\"material-symbols-outlined\">shopping_cart</span>
                    <span id=\"items-in-cart\" style=\"position:absolute; font-size: 16px; min-width: 45px; text-align: center; margin-top: -40px;\">0</span>
                </a>";
            // login
            echo "<a href=\"/login\" id=\"login-button\" class=\"button\">Prihlásiť</a>";
            // register
            echo "<a href=\"/register\" id=\"register-button\" class=\"button\">Registrovať</a>";
        }
        else if (!$adminpage)
        {
            // admin
            if ($isuseradmin) echo "<a href=\"/admin\" id=\"admin-button\" class=\"button\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Admin\"><span class=\"material-symbols-outlined\">engineering</span></a>";
            // cart
            echo "
                <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0\" />
                <a href=\"/cart\" id=\"cart-button\" class=\"button\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Košík\">
                    <span class=\"material-symbols-outlined\">shopping_cart</span>
                    <span id=\"items-in-cart\" style=\"position:absolute; font-size: 16px; min-width: 45px; text-align: center; margin-top: -40px;\">0</span>
                </a>";
            // user name
            echo "<div id=\"user-full-name\">$userfullname</div>";
            // log out
            echo "<a href=\"/php/logic/logout.php\" id=\"logout-button\" class=\"button\">Odhlásiť</a>";
        }
        else if ($isuseradmin)
        {
            // user name
            echo "<div id=\"user-full-name\">$userfullname</div>";
            // log out
            echo "<a href=\"/php/logic/logout.php\" id=\"logout-button\" class=\"button\">Odhlásiť</a>";
        }
        else
        {
            header('Location: /');
            die();
        }
        echo "</div>";
    ?>
</div>
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