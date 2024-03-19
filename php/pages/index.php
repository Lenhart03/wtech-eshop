<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <title>pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div style="height: 100vh; padding: 0 20vw; padding-top: 50px; align-items: start;" id="content">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/php/components/catalogue.php"); ?>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>