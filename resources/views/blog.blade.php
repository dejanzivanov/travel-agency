<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>

<div id="app">
    <header-component :authenticated="{{ auth()->check() ? 'true' : 'false' }}" :is_admin="<?php if (\App\Http\Controllers\AdminController::isAdmin()) { echo 'true'; } else { echo 'false'; }  ?>"></header-component>

    <div class="container">
        <h1 class="text-center">Welcome to Deki Blog</h1>
        <div class="row">
            @foreach($blog as $item)
                <div class="col-md-4 pt-3 pb-3">
                    <div class="card h-100 mb-3 ">
                        <img src="{{ 'storage/uploads/'.$item->id.'/'.$item->image }}" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Author: {{ $item->author }}</li>
                            <li class="list-group-item">Published At: {{ $item->published_at }}</li>
                            <li class="list-group-item">Status: {{ $item->status }}</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}"></script>


</html>
