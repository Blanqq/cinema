@extends('layouts.app')

@section('title')
    Movies Management Panel
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Movies Management Panel
            </div>
            <div class="card-body">
                @if ($movies->count())
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Movie ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Year</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($movies as $movie)
                            <tr>
                                <th scope="row">{{ $movie->id }}</th>
                                <td><a href="/movies/{{ $movie->id }}">{{ $movie->name }}</a></td>
                                <td>{{ $movie->year }}</td>
                                <td>
                                    <form action="/movies/{{ $movie->id  }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" disabled>DELETE</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/movies/{{ $movie->id  }}/edit" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">EDIT</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Movies to show</p>
                @endif
                <form action="/movies/create" method="GET">
                    <button class="btn btn-primary" type="submit">Add New Movie</button>
                </form>
            </div>
        </div>

    </div>
@endsection
