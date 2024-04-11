<?php

include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");

$product_id = $_POST["product_id"];

$result = db_query("SELECT * FROM products WHERE id='$product_id' LIMIT 1");

if (mysqli_num_rows($result) == 1) {
    $product = mysqli_fetch_assoc($result);
    echo json_encode($product);
}

?>