<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/admin.css">
    <title>Admin - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
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
</body>
</html>