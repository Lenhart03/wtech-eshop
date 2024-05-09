<!DOCTYPE html>
<html lang="en">

<head>
    <title>pcpartshop.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    @vite('resources/css/main.css')
    @vite('resources/css/pages/confirmation.css')
</head>

<body>
    @include('components.navbar')

    <div class="content">
        <svg width="164" height="164" viewBox="0 0 164 164" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="164" height="164" rx="82" fill="#C3FFAE"/>
            <rect x="56.5107" y="100.926" width="85.5733" height="21.3933" rx="10.6967" transform="rotate(-40 56.5107 100.926)" fill="white"/>
            <rect x="44.9111" y="66.4199" width="53.4833" height="21.3933" rx="10.6967" transform="rotate(40 44.9111 66.4199)" fill="white"/>
        </svg>
        <p class="sup">Vaša objednávka bola úspešne odoslána.</p>
        <p class="sub">Na Vašu emailovú adresu vám boli zaslané informácie o objednávke.</p>
    </div>
      
    @include('components.mainfooter')

</body>

</html>