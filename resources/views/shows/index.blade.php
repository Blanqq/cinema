@extends('layouts.app')

@section('title')
    Cinema Shows
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Select Day
            </div>
            <div class="card-body">
                <form action="/cinemas/{{ $cinema->slug }}/shows" method="GET">
                    <div class="form-group">
                        <input class="form-control" type="date" name="date" value="{{Carbon\Carbon::parse($date)->format('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary form-control" type="submit" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                Add New Show
            </div>
            <div class="card-body">
                <form action="/cinemas/{{ $cinema->slug }}/shows" method="POST">
                    @csrf
                    <input type="hidden" name="date" value="{{Carbon\Carbon::parse($date)->format('Y-m-d')}}">
                    <div class="form-group">
                        <label for="movie">Movie:</label>
                        <select class="form-control" name="movie" id="movie">
                            <option value="">Select movie</option>
                            @foreach ($movies as $movie)
                                <option value="{{$movie->id}}">{{$movie->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="movie">Room:</label>
                        <select class="form-control" name="room" id="room">
                            <option value="">Select room</option>
                            @foreach ($rooms as $room)
                                <option value="{{$room->id}}">{{$room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="starts_at">Starts:</label>
                        <input class="form-control" type="date" name="starts_at_date" value="{{Carbon\Carbon::parse($date)->format('Y-m-d')}}">
                        <input class="form-control" type="time" name="starts_at_time">
                    </div>
                    <div class="form-group">
                        <label for="starts_at">Ends:</label>
                        <input class="form-control" type="date" name="ends_at_date" value="{{Carbon\Carbon::parse($date)->format('Y-m-d')}}">
                        <input class="form-control" type="time" name="ends_at_time">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary form-control">Add Show</button>
                    </div>
                </form>
                @include('layouts.validation-error-messages')
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
                                <td>{{ $show->movie_name }}</td>
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
            <div class="alert alert-primary mt-3" role="alert">
                Currently no shows for this cinema on day {{ Carbon\Carbon::parse($date)->format('d F Y') }}, add shows using form above.
            </div>
        @endif




    </div>
@endsection