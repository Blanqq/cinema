@extends('layouts.app')

@section('title')
    User Settings
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                {{ $user->name }}
            </div>
            <div class="card-body">
                @if (auth()->check())
                    @if (auth()->user()->isAdmin())
                        User Roles
                        <form action="/roles_users/update/{{ $user->name}}" method="POST">
                            @method('PATCH')
                            @csrf
                            @foreach ($all_roles as $role)
                                <div class="form-group">
                                    <input type="checkbox"
                                           value=" {{ $role->name }}" {{$user->hasRole($role->name)? 'checked' : ''}}
                                           name="user_roles[]">
                                    <label>{{ $role->name }}</label>

                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                    @endif
                @endif

            </div>
        </div>

    </div>
@endsection