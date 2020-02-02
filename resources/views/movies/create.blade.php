@extends('layouts.app')

@section('title')
    Add New Movie
@endsection

@section('content')

    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" ><a href="/employee">Employee Panel</a></li>
            <li class="breadcrumb-item" ><a href="/movies">Movies</a></li>
            <li class="breadcrumb-item" active aria-current="page">Add</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                Add New Movie
            </div>
            <div class="card-body">
                <form action="/movies/" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name of new movie">
                    </div>
                    <div class="form-group">
                        <label for="year">Year of premiere</label>
                        <input type="text" class="form-control" name="year" placeholder="Year">
                    </div>
                    <div class="form-group">
                        <label for="genres">Genres (can select many)</label>
                        <select multiple class="form-control" name="genres[]" id="genres">
                        @foreach ($genres as $genre)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
