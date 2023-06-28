@extends('layouts.app')
@section('content')
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
@endsection
