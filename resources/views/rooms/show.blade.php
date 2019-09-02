@extends('layouts.app')

@section('title')
    Manage Room
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Show room {{ $room->name }} from cinema {{ $cinema->name }}
            </div>
            <div class="card-body">
                <p>Cinema Name: {{ $cinema->name }}</p>
                <p>City: {{ $cinema->city }}</p>
                <p>Street: {{ $cinema->street }}</p>
                <p>Room: {{ $room->name }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                {{ $room->name }} - Seats
            </div>
            <div class="card-body">

                @if ($seats->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Seat ID</th>
                                <th scope="col">Row</th>
                                <th scope="col">Seat</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($seats as $seat)
                                <tr>
                                    <th scope="row">{{ $seat->id }}</th>
                                    <td>{{ $seat->row }}</td>
                                    <td>{{ $seat->seat }}</td>
                                    <td>
                                        <form action="" method="GET">
                                            <button type="submit" class="btn btn-primary" disabled>Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/seats/{{ $seat->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No seats assigned to this room</p>
                @endif

                <form action="/seats/{{ $room->id }}" method="POST">
                    @csrf
                    <div class="form">
                        <label for="name">Row:</label>
                        <input type="text" class="form-control" name="row" placeholder="Row of the seat">
                        <label for="name">Seat number:</label>
                        <input type="text" class="form-control" name="seat" placeholder="Number of the seat">
                        <button type="submit" class="btn btn-danger">Add New Seat To This Room</button>
                    </div>
                    <div class="form-group">

                    </div>
                    @include('layouts.validation-error-messages')

                </form>

            </div>
        </div>

    </div>
@endsection