@extends('layouts.app')

@section('title')
    Create New Role
@endsection

@section('content')

    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" ><a href="/admin">Admin Panel</a></li>
            <li class="breadcrumb-item" ><a href="/roles">Roles</a></li>
            <li class="breadcrumb-item" active aria-current="page">Add</li>
            </ol>
        </nav>
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
