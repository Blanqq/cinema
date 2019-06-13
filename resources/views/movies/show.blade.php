@extends('layouts.app')

@section('title')
    {{ $movie->name }} ({{ $movie->year }})
@endsection

@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                {{$movie->name}} ({{ $movie->year }})
            </div>
            <div class="card-body">
                <p>
                    <img class="img-fluid" src="{{ $movie->poster_path }}" alt="{{ $movie->name }}">
                </p>
                @if ($movie_genres->count())
                    Genre:
                    @foreach($movie_genres as $genre)
                        {{ $genre->name.', ' }}
                    @endforeach
                @else
                    <p>None genre is assigned to this movie</p>
                @endif
            </div>

        </div>

    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Storyline
            </div>
            <div class="card-body">
                {{$movie->description}}
            </div>
            <div class="card-header">
                Details
            </div>
            <div class="card-body">
                length
                production
                language
            </div>
            <div class="card-header">
                Cast
            </div>
            <div class="card-body">
                TODO
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                Discussions
            </div>
            <div class="card-body">
                Start discussion
            </div>
        </div>
    </div>
@endsection