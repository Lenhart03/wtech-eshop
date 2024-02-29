<link rel="stylesheet" href="/css/components/navbar.css">
<div id="navbar">
    <div id="logo">
        <img src="/res/images/logo.png" alt="">
    </div>
    <?php
        $loggedin = false;
        $adminpage = false;
        $isuseradmin = false;

        // middle - searchbar
        if (!$adminpage)
        {
            echo "searchbar<br>";
        }
        else if ($isuseradmin)
        {
            echo "admin_breadcrumbs<br>";
        }
        
        // right side
        if (!$loggedin)
        {
            echo "default(cart, login, register)<br>";
        }
        else if (!$adminpage)
        {
            echo "loggedin(cart, userfullname, logout)<br>";
        }
        else if ($isuseradmin)
        {
            echo "admin(userfullname, logout)<br>";
        }
    ?>
</div>