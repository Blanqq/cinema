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
                @if(auth()->check())
                    @if (auth()->user()->isEmployee())
                        @if (!$movie->poster)
                            <div class="form-group">
                                <form action="/api/movies/{{$movie->id}}/poster" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="poster">Add poster image</label>
                                    <input type="file" class="form-control-file" id="poster" name="poster">
                                    <button type="submit" class="btn btn-primary">Save Image</button>

                                </form>
                            </div>
                        @endif
                        @if ($movie->poster)
                                <div class="form-group">
                                    <form action="/api/movies/{{$movie->id}}/poster" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Delete Image</button>
                                    </form>
                                </div>
                        @endif
                    @endif
                @endif
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