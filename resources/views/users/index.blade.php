@extends('layouts.app')

@section('title')
    Admin User Management Panel
@endsection

@section('content')

    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" ><a href="/admin">Admin Panel</a></li>
            <li class="breadcrumb-item" active aria-current="page">Users</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                Admin User Management Panel
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Email Verified</th>
                            <th scope="col">Created</th>
                            <th scope="col">Roles</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->email_verified_at)
                                        T
                                    @else
                                        F
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>@foreach ($user->roles as $role)
                                        @if(!$loop->last)
                                            {{ $role->name }} |
                                        @endif
                                        @if($loop->last)
                                            {{ $role->name }}
                                        @endif

                                    @endforeach</td>
                                <td>
                                    <form action="/users/{{ $user->name }}" method="GET">
                                        <button type="submit" class="btn btn-primary">Manage</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
