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
                    <form action="/admin/users">
                        <button type="submit" class="btn btn-primary">Users</button>
                    </form>
                </div>
            </div>

        </div>
@endsection