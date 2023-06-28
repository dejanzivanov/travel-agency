@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center text-white">Welcome to Deki Blog</h1>
        <div class="row">
            @foreach($blog as $item)
                @if($item->published == 1)
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
                            <div class="card-body d-flex justify-content-center align-content-center">
                                <a href="/post/{{ $item->id }}" class="card-link">Card link</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
