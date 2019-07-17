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

        {{--<div class="card">
            <div class="card-header">
                {{ $cinema->name }} - Rooms
            </div>
            <div class="card-body">
                @foreach ($cinema as $c)

                @forelse

                @endforelse
            </div>
        </div>--}}

    </div>
@endsection