@extends('layouts.app')

@section('title')
    Cinema Management Panel
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                {{ $cinema->name }} - Cinema Management Panel
            </div>
            <div class="card-body">
                <p>Cinema Name: {{ $cinema->name }}</p>
                <p>City: {{ $cinema->city }}</p>
                <p>Street: {{ $cinema->street }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                {{ $cinema->name }} - Rooms
            </div>
            <div class="card-body">

                @if ($rooms->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Room ID</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <th scope="row">{{ $room->id }}</th>
                                    <td>{{ $room->name }}</td>
                                    <td>
                                        <form action="/rooms/{{ $room->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Room</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/rooms/{{ $cinema->slug }}/{{$room->id}}" method="GET">
                                            <button type="submit" class="btn btn-primary">Manage</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No rooms assigned to this cinema</p>
                @endif

                    <form action="/cinemas/{{ $cinema->slug }}/rooms/" method="POST">
                        @csrf
                        <div class="form-inline">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Name of new room">
                            <button type="submit" class="btn btn-danger">Add New Room To This Cinema</button>
                        </div>
                        <div class="form-group">

                        </div>
                        @include('layouts.validation-error-messages')

                    </form>

            </div>
        </div>

    </div>
@endsection