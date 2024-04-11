<?php if (!array_key_exists("id", $_GET)) { header("location: /"); die(); } ?>
<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/product_detail.css">
    <title>
        <?php
            include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");
            $id = $_GET["id"];
            $result = db_query("SELECT * FROM products WHERE id=$id LIMIT 1");
            if (mysqli_num_rows($result) == 0)
            {
                header("location: /");
                die();
            }
            $product = mysqli_fetch_assoc($result);
            echo $product["name"];
        ?> - pcpartshop.sk
    </title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div style="height: calc(100vh - 80px - 72px);" id="content">
        
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>