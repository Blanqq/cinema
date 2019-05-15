@extends('layouts.app')

@section('title')
    Create New Role
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Create New Role
            </div>
            <div class="card-body">
                <form action="/roles/" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name of new role">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection