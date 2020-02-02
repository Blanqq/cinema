@extends('layouts.app')

@section('title')
    Employee Panel
@endsection

@section('content')

    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" active aria-current="page">Employee Panel</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                Welcome in employee panel
            </div>
            <div class="card-body">
                <p>Select resource which You want to manege</p>
                <div class="form-group">
                    <form action="/genres">
                        <button type="submit" class="btn btn-primary">Genres</button>
                    </form>
                </div>
                <div class="form-group">
                    <form action="/movies">
                        <button type="submit" class="btn btn-primary">Movies</button>
                    </form>
                </div>
                <div class="form-group">
                    <form action="/cinemas">
                        <button type="submit" class="btn btn-primary">Cinemas</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
