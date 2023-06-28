@extends('layouts.app')
@section('content')

    <?php $post = \App\Http\Controllers\BlogController::findPostById($id); $post = $post[0]; ?>
    <update-blog-component :post="{{ json_encode($post) }}"></update-blog-component>

@endsection
