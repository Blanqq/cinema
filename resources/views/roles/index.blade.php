@extends('layouts.app')

@section('title')
    Roles Management Panel
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Roles Management Panel
            </div>
            <div class="card-body">
                @if ($roles)
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Role ID</th>
                            <th scope="col">Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <form action="/roles/{{ $role->id  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/roles/{{ $role->id  }}/edit" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">EDIT</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                    <form action="/roles/create" method="GET">
                        <button class="btn btn-primary" type="submit">Add New Role</button>
                    </form>
            </div>
        </div>

    </div>
@endsection