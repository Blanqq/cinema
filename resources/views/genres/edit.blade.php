@extends('layouts.app')

@section('title')
    Edit Genre
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Edit Genre
            </div>
            <div class="card-body">
                <form action="/genres/{{ $genre->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$genre->name}}">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection