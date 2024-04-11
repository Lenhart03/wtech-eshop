<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/login.css">
    <title>Prihlásenie - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div id="errors">
        <div class="container">
            <?php
            
                if (array_key_exists("email", $_POST) && array_key_exists("pword", $_POST))
                {
                    include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");

                    $email = $_POST["email"];
                    $pword = md5($_POST["pword"]);

                    $error_message = "";

                    $result = db_query("SELECT * FROM users WHERE email='$email' AND pword='$pword' LIMIT 1");
                    if (mysqli_num_rows($result) == 0)
                    {
                        $error_message = "Nesprávne prihlasovacie údaje.";
                    }
                    else
                    {
                        $_SESSION["user"] = mysqli_fetch_assoc($result);
                        header("location: /");
                        die();
                    }

                    if ($error_message != "")
                    {
                        echo
                            "<div class=\"alert alert-danger alert-dismissible fade in\">
                                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                <strong>Nastála chyba!</strong> $error_message
                            </div>";
                    }
                }
            
            ?>
        </div>
    </div>
    <div style="height: calc(100vh - 80px - 72px - 40px);" id="content">
        <form action="/login" method="POST" id="login-form">
            <h1>Prihlásenie</h1>
            <input type="text" name="email" placeholder="Email" required value="<?php if (array_key_exists("email", $_POST)) echo $_POST["email"]; ?>" />
            <input type="password" name="pword" placeholder="Heslo" required value="<?php if (array_key_exists("pword", $_POST)) echo $_POST["pword"]; ?>"/>
            <input type="submit" value="Prihlásiť" class="button" id="login-submit-button" />
        </form>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>