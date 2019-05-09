@extends('layouts.app')

@section('title')
    Admin User Management Panel
@endsection

@section('content')

    <div class="col">
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection