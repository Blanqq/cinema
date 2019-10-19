@extends('layouts.app')

@section('title')
    Cinema Shows
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Cinema Shows
            </div>
            <div class="card-body">
                <form action="/cinemas/{{ $cinema->slug }}/shows">
                    <input type="date" name="date">
                    <button type="submit" class="btn btn-primary">Select</button>
                </form>
            </div>
        </div>

                @if ($shows_grouped_by_rooms->count())
                    @foreach ($shows_grouped_by_rooms as $group_of_shows => $shows)
                    <div class="card mt-3">
                <div class="card-header mb-3">
                    Room {{$group_of_shows}}
                </div>
                <div class="card-body">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Starts at</th>
                            <th scope="col">Ends at</th>
                            <th scope="col">Movie</th>
                            <th scope="col">Room ID</th>
                            <th scope="col">Room name</th>
                        </tr>
                        </thead>


                        @foreach($shows as $show)
                            <tbody>
                            <tr>
                                <th scope="row">{{ $show->id }}</th>
                                <td>{{ $show->starts_at }}</td>
                                <td>{{ $show->ends_at }}</td>
                                <td>{{ $show->movie_id }}</td>
                                <td>{{ $show->room_id }}</td>
                                <td>{{ $show->room_name }}</td>

                            </tr>
                            </tbody>
                        @endforeach


                    </table>
                </div>
                    </div>
                    @endforeach
                @else
                    <p>No data to show.</p>
                @endif




    </div>
@endsection