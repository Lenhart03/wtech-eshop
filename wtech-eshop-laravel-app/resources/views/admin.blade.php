<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - pcpartshop.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />

    @vite(['resources/css/main.css', 'resources/css/pages/admin.css'], 'build')
</head>

<body>
    @include('components.navbar')

    <div style="display: flex; flex-direction: row; gap: 4vw; padding-right: 5vw;">
        <div id="menu">
            <div id="orders" class="group">
                <a href="/admin?orders=all" id="label">Objednávky</a>
                <div id="items">
                    <a href="/admin?orders=new">Nové</a>
                    <a href="/admin?orders=prepared">Pripravené</a>
                    <a href="/admin?orders=sent">Odoslané</a>
                    <a href="/admin?orders=delivered">Doručené</a>
                </div>
            </div>
            <div id="products" class="group">
                <a href="/admin?products=all" id="label">Produkty</a>
                <div id="items">
                    <a href="/admin?products=procesory">Procesory</a>
                    <a href="/admin?products=zakladne_dosky">Zakladné dosky</a>
                    <a href="/admin?products=disky">Disky</a>
                    <a href="/admin?products=skrine">Skrine</a>
                    <a href="/admin?products=RAM">RAM</a>
                    <a href="/admin?products=graficke_karty">Grafické karty</a>
                    <a href="/admin?products=chladenie">Chladenie</a>
                    <a href="/admin?products=zdroje">Zdroje</a>
                </div>
            </div>
        </div>
        <div style="max-height: calc(100vh - 86px - 35px - 40px); height: calc(100vh - 86px - 35px - 40px); width: 100%; margin-top: 35px; display: flex; flex-direction: column; gap: 20px; padding-bottom: 50px;">


            @if (request()->filled('orders'))


                @php

                $orders = null;

                if (request()->get('orders') == 'all')
                    $orders = App\Models\Order::all();
                else
                    $orders = App\Models\Order::where('state', '=', request()->get('orders'))->get();

                @endphp

                <div style="overflow-y: scroll; margin-top: 30px; border-bottom: 1px solid var(--foreground-color1);">
                    <table style="width: 100%;" id="order-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Meno objednávateľa</th>
                                <th>Dátum</th>
                                <th>Stav</th>
                                <th>Akcie</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->firstname.' '.$order->lastname }} </td>
                                    <td>{{ $order->time_ordered }}</td>
                                    <td>
                                        @switch($order->state)
                                            @case('new')
                                                <div class="order-state-new">Nová</div>
                                                @break
                                            @case('prepared')
                                                <div class="order-state-prepared">Pripravená</div>
                                                @break
                                            @case('sent')
                                                <div class="order-state-sent">Odoslaná</div>
                                                @break
                                            @case('delivered')
                                                <div class="order-state-delivered">Doručená</div>
                                                @break
                                            @default
                                        @endswitch
                                    </td>
                                    <td><!-- actions --></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            @elseif (request()->filled('products'))


                @php

                $products = null;

                if (request()->get('products') == 'all')
                    $products = App\Models\Product::all();
                else {
                    $category = null;
                    switch (request()->get('products')) {
                        case 'procesory':      $category = 'CPU';          break;
                        case 'zakladne_dosky': $category = 'Motherboard';  break;
                        case 'disky':          $category = 'disk';         break;
                        case 'skrine':         $category = 'case';         break;
                        case 'RAM':            $category = 'ram';          break;
                        case 'graficke_karty': $category = 'GPU';          break;
                        case 'chladenie':      $category = 'cooler';       break;
                        case 'zdroje':         $category = 'power supply'; break;
                        default:
                            break;
                    }
                    $products = App\Models\Product::where('category', '=', $category)->get();
                }

                @endphp

                <!--
                <form class="filters" method="GET">
                    <input name="products" type="text" value="{{request()->get('products')}}" style="display: none;">
                    <div class="filter-box">
                        <span>Názov</span>
                        <input name="name" type="text">
                    </div>
                    <div class="filter-box">
                        <span>ID</span>
                        <input name="id" type="text">
                    </div>
                    <div class="filter-box">
                        <span>Značka</span>
                        <input name="brand" type="text">
                    </div>
                    <div class="filter-box">
                        <span>Cena</span>
                        <input name="price" type="text">
                    </div>
                    <div class="filter-box">
                        <span>Počet</span>
                        <input name="count" type="text">
                    </div>
                    <input type="submit" value="Filter">
                </form>
                -->

                <div class="modal fade" id="remove-product-modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                    <h4 class="modal-title">Odstrániť produkt</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <div class="modal-body" style="margin-left: 10px">
                                <div class="row">
                                    <p>Ste si istý, že chcete odstrániť tento produkt?</p>
                                </div>
                                <div class="row" style="width: 100%; display: flex; justify-content: right;">
                                    <a class="button button-danger" style="width: 100px;">Odstrániť</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="overflow-y: scroll; margin-top: 30px; border-bottom: 1px solid var(--foreground-color1);">
                    <table style="width: 100%;" id="product-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Názov</th>
                                <th>Značka</th>
                                <th>Cena</th>
                                <th>Počet</th>
                                <th>Akcie</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td style="color: var(--important-color);">{{ $product->price }} €</td>
                                    <td>{{ $product->count }}</td>
                                    <td>
                                        <div style="display: flex; flex-direction: row; justify-content: center; gap: 7px;">
                                            <!-- actions -->
                                            <div id="edit-product-button" type="button" data-toggle="modal" data-target="#edit-product-modal">
                                                <span class="material-symbols-outlined" onclick="edit(this)">
                                                    edit_document
                                                </span>
                                            </div>
                                            <div id="remove-product-button" type="button" data-toggle="modal" data-target="#remove-product-modal">
                                                <span class="material-symbols-outlined" onclick="document.querySelector('#remove-product-modal a').href = '/product/remove/{{ $product->id }}';">
                                                    delete
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="edit-product-modal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                    <h4 class="modal-title">Upraviť produkt</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="loading">
                                    <div class="wheel"></div>
                                    <style>
                                        @keyframes rotateanim {
                                            form {
                                                transform: rotate(0deg);
                                            }
                                            to {
                                                transform: rotate(360deg);
                                            }
                                        }
                                        .loading {
                                            display: none;
                                            justify-content: center;
                                            align-items: center;
                                            width: 100%;
                                            height: 100px;
                                        }
                                        .loading .wheel {
                                            border-top: 5px solid gray;
                                            border-right: 5px solid gray;
                                            border-left: 5px solid white;
                                            border-bottom: 5px solid white;
                                            background: white;
                                            width: 30px;
                                            height: 30px;
                                            border-radius: 15px;
                                            animation-name: rotateanim;
                                            animation-iteration-count: infinite;
                                            animation-duration: 1s;
                                        }
                                    </style>
                                </div>
                                <form id="EditProductForm" method="POST" action="/product/update" style="display: none" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group" style="display: none">
                                        <label for="id">ID:</label>
                                        <input required type="text" name="id" class="form-control" id="id">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Názov:</label>
                                        <input required type="text" name="name" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Popis:</label>
                                        <textarea required class="form-control" name="description" rows="5" id="description"></textarea>
                                    </div>
                                    <div style="display: flex; gap: 20px;">
                                        <div class="form-group">
                                            <label for="price">Cena (€):</label>
                                            <input required type="number" name="price" min="0.99" step="0.01" class="form-control" id="price" value="0" style="width: 100px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="count">Počet:</label>
                                            <input required type="number" name="count" min="0" step="1" class="form-control" id="count" value="0" style="width: 100px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Kategória:</label><br>
                                            <select name="category" id="category">
                                                <option value="CPU">CPU</option>
                                                <option value="Motherboard">Motherboard</option>
                                                <option value="disk">disk</option>
                                                <option value="case">case</option>
                                                <option value="ram">ram</option>
                                                <option value="GPU">GPU</option>
                                                <option value="cooler">cooler</option>
                                                <option value="power supply">power supply</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Značka:</label>
                                        <input required type="text" name="brand" maxlength="64" class="form-control" id="brand">
                                    </div>


                                    <div class="form-group">
                                        <label for="images">Obrázky:</label>
                                        <input type="file" name="images[]" class="form-control" id="images" multiple="multiple">
                                        <div class="gallery" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;"></div>
                                    </div>


                                    <input type="text" id="parameters" name="parameters" style="display: none;">
                                    <input type="text" id="dbimages" name="dbimages" style="display: none;">

                                    <div class="form-group">
                                        <table class="table table-condensed" id="parameter-table">
                                            <thead>
                                                <tr>
                                                    <th><b>Parameter</b></th>
                                                    <th><b>Hodnota</b></th>
                                                    <th><b>Akcie</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                        <div style="display: flex; justify-content: center;">
                                                            <div onclick="add_parameter_EditProductForm()" class="button" style="cursor: pointer; padding: 0; width: 30px; height: 30px;">+</div>
                                                            <script>
                                                                function add_parameter_EditProductForm() {
                                                                    const table = document.querySelector("#EditProductForm #parameter-table");
                                                                    let rows = Array(table.querySelectorAll("tr"));
                                                                    let new_row = document.createElement("tr");
                                                                    new_row.innerHTML = (`
                                                                        <td><input type="text"></td>
                                                                        <td><input type="text"></td>
                                                                        <td><span class="material-icons" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Odstrániť" onclick="remove_parameter(this)">delete</span></td>
                                                                        `).trim();
                                                                    table.querySelector("tbody").innerHTML = "";
                                                                    for (let i = 1; i < rows[0].length - 1; i++) {
                                                                        table.querySelector("tbody").appendChild(rows[0][i]);
                                                                    };
                                                                    table.querySelector("tbody").appendChild(new_row);
                                                                    table.querySelector("tbody").appendChild(rows[0][rows[0].length - 1]);
                                                                }
                                                                function remove_parameter(span) {
                                                                    span.parentElement.parentElement.remove();
                                                                }
                                                                $(function() {
                                                                    $('#EditProductForm').submit(function(event) {
                                                                        //event.preventDefault();
                                                                        const table = document.querySelector("#parameter-table tbody");
                                                                        let rows = Array.from(table.querySelectorAll("tbody tr"));
                                                                        rows.pop();
                                                                        let parameters = {};
                                                                        for (let row of rows) {
                                                                            const key = row.cells[0].querySelector("input").value;
                                                                            const value = row.cells[1].querySelector("input").value;
                                                                            parameters[key] = value;
                                                                        }
                                                                        document.querySelector("#EditProductForm #parameters").value = JSON.stringify(parameters);
                                                                        document.querySelector("#EditProductForm #dbimages").value = JSON.stringify(images);
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group" style="display: flex; justify-content: right; gap: 30px;">
                                        <input required type="submit" class="button" value="Aktualizovať">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="panel" style="display: flex; flex-direction: row; justify-content: right; gap: 20px;">
                    <button id="add-product-button" type="button" class="button btn btn-info btn-lg" data-toggle="modal" data-target="#add-product-modal">Pridať produkt</button>
                    <!-- Modal -->
                    <div class="modal fade" id="add-product-modal" role="dialog">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                    <h4 class="modal-title">Pridať produkt</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                            <div class="modal-body" id="create-post-modal">
                                <form id="AddProductForm" method="POST" action="/product/create" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Názov:</label>
                                        <input required type="text" name="name" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Popis:</label>
                                        <textarea required class="form-control" name="description" rows="5" id="description"></textarea>
                                    </div>
                                    <div style="display: flex; gap: 20px;">
                                        <div class="form-group">
                                            <label for="price">Cena (€):</label>
                                            <input required type="number" name="price" min="0.99" step="0.01" class="form-control" id="price" value="0" style="width: 100px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="count">Počet:</label>
                                            <input required type="number" name="count" min="0" step="1" class="form-control" id="count" value="0" style="width: 100px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Kategória:</label><br>
                                            <select name="category" id="category">
                                                <option value="CPU">CPU</option>
                                                <option value="Motherboard">Motherboard</option>
                                                <option value="disk">disk</option>
                                                <option value="case">case</option>
                                                <option value="ram">ram</option>
                                                <option value="GPU">GPU</option>
                                                <option value="cooler">cooler</option>
                                                <option value="power supply">power supply</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Značka:</label>
                                        <input required type="text" name="brand" maxlength="64" class="form-control" id="brand">
                                    </div>

                                    <div class="form-group">
                                        <label for="images">Obrázky:</label>
                                        <input required type="file" name="images[]" class="form-control" id="images" multiple="multiple">
                                        <div class="gallery" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;"></div>
                                    </div>

                                    <input type="text" id="parameters" name="parameters" style="display: none;">

                                    <div class="form-group">
                                        <table class="table table-condensed" id="parameter-table">
                                            <thead>
                                                <tr>
                                                    <th><b>Parameter</b></th>
                                                    <th><b>Hodnota</b></th>
                                                    <th><b>Akcie</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                        <div style="display: flex; justify-content: center;">
                                                            <div onclick="add_parameter_AddProductForm()" class="button" style="cursor: pointer; padding: 0; width: 30px; height: 30px;">+</div>
                                                            <script>
                                                                function add_parameter_AddProductForm() {
                                                                    const table = document.querySelector("#AddProductForm #parameter-table");
                                                                    let rows = Array(table.querySelectorAll("tr"));
                                                                    let new_row = document.createElement("tr");
                                                                    new_row.innerHTML = (`
                                                                        <td><input type="text"></td>
                                                                        <td><input type="text"></td>
                                                                        <td><span class="material-icons" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Odstrániť" onclick="remove_parameter(this)">delete</span></td>
                                                                        `).trim();
                                                                    table.querySelector("tbody").innerHTML = "";
                                                                    for (let i = 1; i < rows[0].length - 1; i++) {
                                                                        table.querySelector("tbody").appendChild(rows[0][i]);
                                                                    };
                                                                    table.querySelector("tbody").appendChild(new_row);
                                                                    table.querySelector("tbody").appendChild(rows[0][rows[0].length - 1]);
                                                                }
                                                                function remove_parameter(span) {
                                                                    span.parentElement.parentElement.remove();
                                                                }
                                                                $(function() {
                                                                    $('#AddProductForm').submit(function(event) {
                                                                        const table = document.querySelector("#AddProductForm #parameter-table");
                                                                        let rows = Array.from(table.querySelectorAll("tbody tr"));
                                                                        rows.pop();
                                                                        let parameters = {};
                                                                        for (let row of rows) {
                                                                            const key = row.cells[0].querySelector("input").value;
                                                                            const value = row.cells[1].querySelector("input").value;
                                                                            parameters[key] = value;
                                                                        }
                                                                        document.querySelector("#AddProductForm #parameters").value = JSON.stringify(parameters);
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group" style="display: flex; justify-content: right;">
                                        <input type="submit" class="button" value="Pridať">
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>


<script>
let images = [];
function edit(span) {
    const id = span.parentElement.parentElement.parentElement.parentElement.querySelectorAll('td')[0].innerHTML;
    const form = document.querySelector("#edit-product-modal form");
    const loading = document.querySelector("#edit-product-modal .loading");
    form.style.display = "none";
    loading.style.display = "flex";
    fetch(window.location.origin + "/product/" + id)
    .then((response) => {
        return response.json();
    }).then((data) => {
        form.querySelector("#id").value = data.id;
        form.querySelector("#name").value = data.name;
        form.querySelector("#description").value = data.description;
        form.querySelector("#price").value = data.price;
        form.querySelector("#count").value = data.count;
        form.querySelector("#category").value = data.category;
        form.querySelector("#brand").value = data.brand;

        let gallery = document.querySelector("#EditProductForm .gallery");
        gallery.innerHTML = "";
        images = data.images;
        for (const image of images) {
            const path = image['image'];
            const img_div_elem = document.createElement("div");
            img_div_elem.innerHTML = (
                `<div class="">
                    <div class="thumbnail">
                        <div class="remove" onclick="remove_image(this)"><div class="x"></div></div>
                        <a href="/storage/dbimages/` + path + `" target="_blank">
                            <img src="/storage/dbimages/` + path + `" alt="" style="width:100%">
                        </a>
                    </div>
                </div>`).trim();
            gallery.appendChild(img_div_elem);
        }

        const parameter_table = document.querySelector("#parameter-table tbody");
        const add_new_parameter_row = parameter_table.querySelectorAll('tr')[parameter_table.querySelectorAll('tr').length - 1];
        parameter_table.innerHTML = "";
        const parameters = data.parameters;
        for (const parameter of parameters) {
            const new_row = document.createElement("tr");
            new_row.innerHTML = (`
            <td><input type="text" value="` + parameter.name + `"></td>
            <td><input type="text" value="` + parameter.value + `"></td>
            <td><span class="material-icons" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Odstrániť" onclick="remove_parameter(this)">delete</span></td>
            `).trim();
            parameter_table.appendChild(new_row);
        }
        parameter_table.appendChild(add_new_parameter_row);

        loading.style.display = "none";
        form.style.display = "block";
    });
}
const input_images = document.querySelector("#EditProductForm #images");
input_images.addEventListener("change", (e) => { update_images(); });
function update_images(e) {
    let gallery = document.querySelector("#EditProductForm .gallery");
    gallery.innerHTML = "";

    for (const image of images) {
        const path = image['image'];
        let img_div_elem = document.createElement("div");
        img_div_elem.innerHTML = (
            `<div class="">
                <div class="thumbnail">
                    <div class="remove" onclick="remove_image(this)"><div class="x"></div></div>
                    <a href="/storage/dbimages/` + path + `" target="_blank">
                        <img src="/storage/dbimages/` + path + `" alt="" style="width:100%">
                    </a>
                </div>
            </div>`).trim();
        gallery.appendChild(img_div_elem);
    }

    for (let i = 0; i < input_images.files.length; i++) {
        let img_div_elem = document.createElement("div");
        img_div_elem.innerHTML = (
            `<div class="">
                <div class="thumbnail">
                    <div class="remove" onclick="remove_image(this)"><div class="x"></div></div>
                    <a target="_blank">
                        <img id="new-image-` + i + `" alt="" style="width:100%">
                    </a>
                </div>
            </div>`).trim();
        gallery.appendChild(img_div_elem);
    }

    for (let i = 0; i < input_images.files.length; i++) {
        const file = input_images.files[i];
        let fr = new FileReader();
        fr.onload = function () {
            gallery.querySelector("#new-image-" + i).src = fr.result;
            gallery.querySelector("#new-image-" + i).alt = file.name;
        };
        fr.readAsDataURL(file);
    }
}

const input_images_AddProductForm = document.querySelector("#AddProductForm #images");
input_images_AddProductForm.addEventListener("change", (e) => { update_images_input_images_AddProductForm(); });
function update_images_input_images_AddProductForm() {
    let gallery = document.querySelector("#AddProductForm .gallery");
    gallery.innerHTML = "";
    for (let i = 0; i < input_images_AddProductForm.files.length; i++) {
        let img_div_elem = document.createElement("div");
        img_div_elem.innerHTML = (
            `<div class="">
                <div class="thumbnail">
                    <div class="remove" onclick="remove_image(this)"><div class="x"></div></div>
                    <a target="_blank">
                        <img id="new-image-` + i + `" alt="" style="width:100%">
                    </a>
                </div>
            </div>`).trim();
        gallery.appendChild(img_div_elem);
    }

    for (let i = 0; i < input_images_AddProductForm.files.length; i++) {
        const file = input_images_AddProductForm.files[i];
        let fr = new FileReader();
        fr.onload = function () {
            gallery.querySelector("#new-image-" + i).src = fr.result;
            gallery.querySelector("#new-image-" + i).alt = file.name;
        };
        fr.readAsDataURL(file);
    }
}

function remove_image(remove_button) {
    const image_element = remove_button.parentElement.parentElement.parentElement;
    const form_element = image_element.parentElement.parentElement.parentElement;
    const input_images = form_element.querySelector('#images');

    if (image_element.parentElement.children.length == 1) {
        return
    }

    const dt = new DataTransfer();
    const { files } = input_images;

    for (let i = 0; i < input_images.files.length; i++) {
        if (image_element.querySelector('img').alt != input_images.files[i].name) {
            dt.items.add(input_images.files[i]); // here you exclude the file. thus removing it.
        }
    }
    input_images.files = dt.files; // Assign the updates list

    for (let i = 0; i < images.length; i++) {
        const dbimage_filename = images[i].image;
        const image_filename = image_element.querySelector('img').src.split('/').reverse()[0];
        if (dbimage_filename == image_filename) {
            images.splice(i, 1);
            break;
        }
    }
    image_element.remove();
}

</script>


</body>

</html>
