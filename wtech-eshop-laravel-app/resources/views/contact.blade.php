<!DOCTYPE html>
<html lang="en">

<head>
    <title>pcpartshop.sk</title>
    <link rel="icon" href="../../../res/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{asset('resources/css/main.css') }}">
    <link rel="stylesheet" href="{{asset('resources/css/pages/contact.css') }}">
</head>

<body>
    @include('components.navbar')

    <div class="contact">
        <h1 class="contact-title">KONTAKTY</h1>
        <p class="number">+421 944 785 486</p>
        <p class="email">xguran@stuba.sk</p>
        <p class="number">+421 944 377 171</p>
        <p class="email">xlenhart@stuba.sk</p>
        <p class="city">Bratislava</p>
        <p class="address">Ilkovičova 2, 842 16 Karlova Ves</p>
    </div>
      
    @include('components.mainfooter')

</body>

</html>