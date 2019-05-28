@extends('layouts.app')

@section('title')
    Admin Panel
@endsection

@section('content')

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Welcome in admin panel
                </div>
                <div class="card-body">
                    <p>Select resource which You want to manege</p>
                    <div class="form-group">
                        <form action="/roles">
                            <button type="submit" class="btn btn-primary">Roles</button>
                        </form>
                    </div>
                    <div class="form-group">
                        <form action="/users">
                            <button type="submit" class="btn btn-primary">Users</button>
                        </form>
                    </div>
                    <div class="form-group">
                        <form action="/genres">
                            <button type="submit" class="btn btn-primary">Genres</button>
                        </form>
                    </div>
                    <div class="form-group">
                        <form action="/movies">
                            <button type="submit" class="btn btn-primary">Movies</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
@endsection