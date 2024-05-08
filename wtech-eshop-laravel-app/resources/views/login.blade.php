
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prihlásenie - pcpartshop.sk</title>
    <link rel="icon" href="../../../res/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    @vite('resources/css/main.css')
    @vite('resources/css/pages/login.css')
</head>
<body>
    @include('components/navbar')

    <div style="height: calc(100vh - 80px - 72px - 40px);" id="content">
        <form action="login" method="POST" id="login-form">
            @csrf
            <h1>Prihlásenie</h1>
            <input type="text" name="email" placeholder="Email" required value="" />
            <input type="password" name="password" placeholder="Heslo" required value=""/>
            <input type="submit" value="Prihlásiť" class="button" id="login-submit-button" />
        </form>
    </div>
    @include('components/mainfooter')
</body>
</html>