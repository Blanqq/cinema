@extends('layouts.app')

@section('title')
    Create New Genre
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Create New Genre
            </div>
            <div class="card-body">
                <form action="/genres/" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name of new genre">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection