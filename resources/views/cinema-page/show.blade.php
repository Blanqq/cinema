@extends('layouts.app')
@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Select Day
            </div>
            <div class="card-body">

                        @foreach ($days_to_select as $day)
                            <a href="/{{ $cinema->slug }}/?date={{ Carbon\Carbon::parse($day)->format('Y-m-d') }}">{{ Carbon\Carbon::parse($day)->format('d F Y') }}</a>
                        @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{$cinema->name}} - Shows on day {{ $date->format('d F Y') }}
            </div>
            <div class="card-body">
                @if ($shows_grouped_by_movie->count())
                    <table class="table table-hover table-dark">
                        @foreach ($shows_grouped_by_movie as $group_of_shows => $shows)
                        <tbody>
                            <tr>
                                <td>{{ $group_of_shows }}</td>
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

                @endif
            </div>
        </div>
    </div>
@endsection
