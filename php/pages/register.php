<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/logic/head.php"); ?>
    <link rel="stylesheet" href="/css/pages/register.css">
    <title>Registrácia - pcpartshop.sk</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/navbar.php"); ?>
    <div id="errors">
        <div class="container">
            <?php
            
                if (array_key_exists("email", $_POST) && array_key_exists("pword", $_POST))
                {
                    include_once($_SERVER["DOCUMENT_ROOT"]."/php/logic/db_connect.php");
                    $firstname = $_POST["firstname"];
                    $lastname = $_POST["lastname"];
                    $email = $_POST["email"];
                    $pword = md5($_POST["pword"]);
                    $pword2 = md5($_POST["pword2"]);

                    $error_message = "";
                    
                    if ($pword == $pword2) {
                        $result = db_query("SELECT * FROM users WHERE email='$email' LIMIT 1");
                        if (mysqli_num_rows($result) == 0) {
                            db_query("INSERT INTO users (`firstname`,`lastname`,`email`,`pword`,`user_group`) VALUES ('$firstname','$lastname','$email','$pword','basic')");
                            $user = mysqli_fetch_assoc(db_query("SELECT * FROM users WHERE email='$email' LIMIT 1"));
                            $_SESSION["user"] = $user;
                            header("location: /");
                            die();
                        }
                        else {
                            $error_message = "Už existuje používateľ so zadanou e-mailovou adresou.";
                        }
                    }
                    else {
                        $error_message = "Zadané heslá nie sú rovnaké.";
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
    <div style="height: calc(100vh - 80px - 72px);" id="content">
        <form action="/register" method="POST" id="register-form">
            <h1>Registrácia</h1>
            <div id="split">
                <input type="text" name="firstname" placeholder="Meno" required value="<?php if (array_key_exists("firstname", $_POST)) echo $_POST["firstname"]; ?>" />
                <input type="text" name="lastname" placeholder="Priezovisko" required value="<?php if (array_key_exists("lastname", $_POST)) echo $_POST["lastname"]; ?>" />
            </div>
            <input type="text" name="email" placeholder="Email" required value="<?php if (array_key_exists("email", $_POST)) echo $_POST["email"]; ?>" />
            <input type="password" name="pword" placeholder="Heslo" required value="<?php if (array_key_exists("pword", $_POST)) echo $_POST["pword"]; ?>"/>
            <input type="password" name="pword2" placeholder="Potvrdiť heslo" required value="<?php if (array_key_exists("pword", $_POST)) echo $_POST["pword2"]; ?>"/>
            <div id="policy">
                <p>Kliknutím na Registrovať súhlasíte s našimi</p>
                <a href="#">Zásadami ochrany osobných údajov.</a>
            </div>
            <input type="submit" value="Registrovať" class="button" id="register-submit-button" />
        </form>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/components/main_footer.php"); ?>
</body>
</html>