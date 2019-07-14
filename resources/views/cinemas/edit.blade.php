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


                @if (auth()->check())
                    @if (auth()->user()->isEmployee())

                        <form action="/cinemas/{{ $cinema->slug }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Slug (Is generated from Name)</label>
                                <input type="text" class="form-control" name="name" value="{{ $cinema->slug }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Name (Is generated from City and Street)</label>
                                <input type="text" class="form-control" name="name" value="{{ $cinema->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">City</label>
                                <input type="text" class="form-control" name="city" value="{{ $cinema->city }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Street</label>
                                <input type="text" class="form-control" name="street" value="{{ $cinema->street }}">
                            </div>
                            @if (isset($errors) && count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                    @endif
                @endif

            </div>
        </div>

    </div>
@endsection