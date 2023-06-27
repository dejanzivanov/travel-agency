<?php
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//dd(User::find(Auth::id())->isAdmin());


if (Auth::check())
{
    if(User::find(Auth::id())->isAdmin())
    {
            $title = session('title');
            $image_path = session('image_path');
            $description = session('description');
            $author = session('author');
            $published_at = session('published_at');
            $status = session('status');
            $bodyText = session('bodyText');


            if (isset($title) && !empty($title) ||
                isset($image_path) && !empty($image_path) ||
                isset($description) && !empty($description) ||
                isset($author) && !empty($author) ||
                isset($published_at) && !empty($published_at) ||
                isset($status) && !empty($status) ||
                isset($bodyText) && !empty($bodyText))
            {

            }
            else
            {
                echo '<script>window.location.href = "/";</script>';
            }

    }
    else
    {
        echo '<script>window.location.href = "/";</script>';
    }
}
else
{
    echo '<script>window.location.href = "/";</script>';
}



?>


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





        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center align-content-center">
                    <h1 class="post-title pt-3 pb-4">{{ session('title') }}</h1>
                </div>
                <div class="col-md-8 offset-md-2 pt-4">
                    <img src="{{ session('image_path') }}" class="post-image img-fluid" alt="Post Image">
                    <p class="post-description pt-4">{{ session('description') }}</p>
                    <div class="post-meta pt-3">
                        <p>Author: {{ session('author') }}</p>
                        <p>Published At: {{ \Carbon\Carbon::parse(session('published_at'))->format('d.m.Y') }}</p>
                        <p>Status: {{ session('status') }}</p>
                    </div>
                    <div class="d-flex justify-content-center align-content-center pt-3 pb-3">
                        <p>{{ session('description') }}</p>
                    </div>
                    <div class="">
                        <p>{!! html_entity_decode($bodyText) !!}</p>
                    </div>
                </div>
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
