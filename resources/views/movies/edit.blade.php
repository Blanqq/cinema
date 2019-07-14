@extends('layouts.app')

@section('title')
    Edit Movie
@endsection

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                Edit Movie
            </div>
            <div class="card-body">
                <form action="/movies/{{ $movie->id }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $movie->name }}">
                    </div>
                    <div class="form-group">
                        <label for="year">Year of premiere</label>
                        <input type="text" class="form-control" name="year" value="{{ $movie->year }}">
                    </div>
                    <div class="form-group">
                        <label for="genres">Genres (can select many)</label>
                        <select multiple class="form-control" name="genres[]" id="genres">
                            @foreach ($all_genres as $genre)
                                <option value="{{$genre->id}}" @if (in_array($genre->id, $genres->toArray()))
                                    {{'selected'}}
                                @endif>
                                    {{$genre->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{$movie->description}}</textarea>
                    </div>
                    @if (isset($errors) && count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection