@extends('layouts.app')
@section('content')

    <div class="col">
        <div class="card mb-2">
            <div class="card-header">
                Select Day
            </div>
            <div class="card-body">

                @foreach ($days_to_select as $day)
                    <a href="/{{ $cinema->slug }}/?date={{ Carbon\Carbon::parse($day)->format('Y-m-d') }}">
                        @if (Carbon\Carbon::parse($day)->format('Y-m-d') == Carbon\Carbon::parse($date)->format('Y-m-d'))
                            <button class="btn btn-danger" disabled>
                            {{ Carbon\Carbon::parse($day)->format('d') }} <br>
                            {{ Carbon\Carbon::parse($day)->format('F') }}
                            </button>
                        @else
                            <button class="btn btn-primary">
                            {{ Carbon\Carbon::parse($day)->format('d') }} <br>
                            {{ Carbon\Carbon::parse($day)->format('F') }}
                            </button>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                {{$cinema->name}} - Shows on day {{ $date->format('d F Y') }}
            </div>
            <div class="card-body">
                @if ($shows_grouped_by_movie->count())
                    <table class="table table-hover table-dark">
                        @foreach ($shows_grouped_by_movie as $group_of_shows => $shows)
                        <tbody>
                            <tr>

                            <td><a href="/movies/{{ $shows[0]->movie_id }}">{{ $group_of_shows }}</a></td>
                                <td>|
                                    @foreach ($shows as $show)
                                        <a href="/cinemas/{{ $cinema->slug }}/shows/{{ $show->id }}">
                                            {{ Carbon\Carbon::parse($show->starts_at)->format('H:i') }}
                                        </a>|
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                @else
                    <p>Currently no shows scheduled for today. Please select different day.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
