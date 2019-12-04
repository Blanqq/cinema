@extends('layouts.app')

@section('title')
    User Settings
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                {{ $user->name }}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name {{ $user->name }}</li>
                <li class="list-group-item">User email: {{ $user->email }}  
                @if (!$user->email_verified_at)
                        <div class="alert alert-danger" role="alert">
                            Email not verified
                        </div>
                @endif
                </li>
                <li class="list-group-item">Account created: {{ Carbon\Carbon::parse($user->created_at)->format('d F Y H:i') }}</li>
            </ul>
        </div>
        <div class="card mt-3">
            <div class="card-header">{{ $user->name }} - Reservations</div>
        </div>
        @foreach ($reservations as $reservations_group => $tickets)
        <div class="card mt-3">
            <div class="card-header">
                Reservation ID: {{ $reservations_group }}
            </div>
            @foreach ($tickets as $ticket)
            <div class="card-body">
                <h5 class="card-title">{{ $ticket->cinema_name }} Cinema</h5>
                <h5 class="card-title">Ticket ID: {{ $ticket->id }}</h5>
                <p class="card-text">Movie: {{ $ticket->movie_name }}</p>
                <p class="card-text">Show Starts: {{ Carbon\Carbon::parse($ticket->show_start)->format('d F Y H:i') }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Room: {{ $ticket->room_name }}</li>
                <li class="list-group-item">Row: {{ $ticket->row }} Seat: {{ $ticket->seat }}</li>
            </ul>
            <div class="card-footer"><p></p></div>
            @endforeach
        </div>
        @endforeach

    </div>
@endsection