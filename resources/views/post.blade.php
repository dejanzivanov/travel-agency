<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div id="app">
    <header-component :authenticated="{{ auth()->check() ? 'true' : 'false' }}" :is_admin="<?php if (\App\Http\Controllers\AdminController::isAdmin()) { echo 'true'; } else { echo 'false'; }  ?>"></header-component>
    <div class="container">

{{--        @dd($post)--}}
        <div class="row">
            <div class="d-flex  justify-content-center align-content-center">
                <h1 class="post-title pt-3 pb-4">{{ $post[0]->title }}</h1>
            </div>

            <div class="col-md-8 offset-md-2 pt-4">
                <img src="{{ '/storage/uploads/'.$post[0]->id.'/'.$post[0]->image }}" class="post-image img-fluid" alt="Post Image">
                <p class="post-description pt-4">{{ $post[0]->description }}</p>
                <div class="post-meta pt-3">
                    <p>Author: {{ $post[0]->author }}</p>
                    <p>Published At: {{ \Carbon\Carbon::parse( $post[0]->published_at)->format('d.m.Y') }}</p>
                    <p>Status: {{ $post[0]->status }}</p>
                </div><?php $i = 'deki'; ?>
                <div class="d-flex justify-content-center align-content-center pt-3 pb-3">
                    <p>{{ $post[0]->description }}</p>
                </div>

                <div class="d-flex align-content-center justify-content-center">{!! $post[0]->bodyText !!}</div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}"></script>
</html>
