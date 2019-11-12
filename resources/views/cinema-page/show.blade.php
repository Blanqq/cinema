@extends('layouts.app')
@section('content')

    <div class="col">
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
                                            {{ Carbon\Carbon::parse($show->starts_at)->format('H:m') }}
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
