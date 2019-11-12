@extends('layouts.header')

@section('style-scripts')
    <link rel="stylesheet" href="{{ asset('css/seats-grid.css') }}">
@endsection

@extends('layouts.app')

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                {{ $cinema->name }} Cinema - Presents {{ $movie->name }} movie. Show take place {{ Carbon\Carbon::parse($show->starts_at)->format('d F Y H:m') }}
            </div>
            <div class="card-body">
                @if ($seats_grouped_by_rows->count())
                    <div class="divTable">
                        <div class="divTableBody table table-hover table-dark">

                            @foreach ($seats_grouped_by_rows as $row_of_seats => $seats)
                                <div class="divTableRow">
                                    <div class="divTableCell">
                                        {{ $row_of_seats }}
                                    </div>
                                @foreach ($seats as $seat)
                                        <div class="divTableCell">
                                            <input type="checkbox">{{ $seat->seat }}
                                        </div>
                                @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                </div>
            </div>
        </div>
    </div>
@endsection
