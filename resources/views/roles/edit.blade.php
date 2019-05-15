@extends('layouts.app')

@section('title')
    Edit Role
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Edit Role
            </div>
            <div class="card-body">
                <form action="/roles/{{ $role->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$role->name}}">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection