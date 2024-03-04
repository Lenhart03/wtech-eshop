<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/chyba.css">
    <title>Chyba - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div style="height: calc(100vh - 80px - 72px); display: flex; flex-direction: column; gap: 20px; align-items: center;" id="content">
        <h1 style="font-size: 64px; color: var(--important-color);">404</h1>
        <p>Je nám ľúto, ale požadovaná stránka nebola nájdená.</p>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <p>Uistite sa, že ste neurobili chybu v URL adrese.</p>
            <p>Je možné, že stránka bola premiestnená alebo odstránená.</p>
        </div>
        <br>
        <br>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>