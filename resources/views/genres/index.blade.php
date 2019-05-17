@extends('layouts.app')

@section('title')
    Genres Management Panel
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Genres Management Panel
            </div>
            <div class="card-body">
                @if ($genres->count())
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Genre ID</th>
                            <th scope="col">Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($genres as $genre)
                            <tr>
                                <th scope="row">{{ $genre->id }}</th>
                                <td>{{ $genre->name }}</td>
                                <td>
                                    <form action="/genres/{{ $genre->id  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/genres/{{ $genre->id  }}/edit" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">EDIT</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Genres to show</p>
                @endif
                <form action="/genres/create" method="GET">
                    <button class="btn btn-primary" type="submit">Add New Genre</button>
                </form>
            </div>
        </div>

    </div>
@endsection