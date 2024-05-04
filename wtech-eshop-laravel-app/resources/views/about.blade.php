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
    <link rel="stylesheet" href="{{asset('resources/css/pages/about.css') }}">
</head>

<body>
    @include('components.navbar')

    <div class="about">
        <h1 class="about-title">O NÁS</h1>
        <p class="about-text">&emsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque urna erat, pretium porttitor porta non, convallis ut orci. Maecenas iaculis, mi eu vestibulum eleifend, risus massa placerat risus, ac mattis lacus erat eu leo. Nulla eleifend libero mattis sem vehicula semper. Sed sit amet tortor eget sem egestas vestibulum quis at lorem. Pellentesque in pharetra est, non fermentum neque. Cras imperdiet hendrerit nibh. Nullam pharetra orci in magna semper, sed mattis ante accumsan.</p>
        <p class="about-text">&emsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at enim lectus. Vestibulum auctor malesuada magna, quis luctus mi maximus a. Suspendisse ullamcorper feugiat elementum.</p>

    </div>
      
    @include('components.mainfooter')

</body>

</html>