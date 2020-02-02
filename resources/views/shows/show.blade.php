@extends('layouts.header')

@section('style-scripts')
    <link rel="stylesheet" href="{{ asset('css/seats-grid.css') }}">
@endsection

@extends('layouts.app')

@section('content')

    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" ><a href="/{{ $cinema->slug }} "> {{ $cinema->name   }}</a></li>
            <li class="breadcrumb-item" active aria-current="page">Make Reservation</li>
            </ol>
        </nav>
        <div class="card">


            <div class="card-header">
                {{ $cinema->name }} Cinema - Presents {{ $movie->name }} movie. Show take place {{ Carbon\Carbon::parse($show->starts_at)->format('d F Y H:i') }}
            </div>
            <div class="card-body">
                @if ($seats_grouped_by_rows->count())
                    <form action="/cinemas/{{ $cinema->slug }}/shows/{{ $show->id }}/reservations" method="POST">
                        @csrf
                    <div class="divTable">
                        <div class="divTableBody table table-hover table-dark">

                            @foreach ($seats_grouped_by_rows as $row_of_seats => $seats)
                                <div class="divTableRow">
                                    <div class="divTableCell">
                                        {{ $row_of_seats }}
                                    </div>
                                @foreach ($seats as $seat)
                                        <div class="divTableCell">
                                            @if ($occupied_seats->contains('id', $seat->id))
                                                x
                                            @else
                                                <input type="checkbox" name="seats[]" value="{{$seat->id}}">{{ $seat->seat }}
                                            @endif

                                        </div>
                                @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                        <button class="btn btn-primary form-control form-group mt-3">Make reservation</button>
                    </form>
                @endif

                </div>
            </div>
        </div>
    </div>
@endsection
