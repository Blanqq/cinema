@extends('layouts.app')

@section('title')
    Cinemas Management Panel
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Cinemas Management Panel
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Cinema ID</th>
                            <th scope="col">Cinema Slug</th>
                            <th scope="col">Name</th>
                            <th scope="col">City</th>
                            <th scope="col">Street</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cinemas as $cinema)
                            <tr>
                                <th scope="row">{{ $cinema->id }}</th>
                                <td>{{ $cinema->slug }}</td>
                                <td>{{ $cinema->name }}</td>
                                <td>{{ $cinema->city }}</td>
                                <td>{{ $cinema->street }}</td>
                                <td>
                                    <form action="/cinemas/{{ $cinema->slug }}/edit" method="GET">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/cinemas/{{ $cinema->slug  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form action="/cinemas/create" method="GET">
                        <button class="btn btn-primary" type="submit">Add New Cinema</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection