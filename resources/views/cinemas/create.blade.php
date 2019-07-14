@extends('layouts.app')

@section('title')
    Add New Cinema
@endsection

@section('content')

    <div class="col">
        <div class="card">
            <div class="card-header">
                Add New Cinema
            </div>
            <div class="card-body">
                <form action="/cinemas/" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">City</label>
                        <input type="text" class="form-control" name="city" placeholder="City of new cinema">
                    </div>
                    <div class="form-group">
                        <label for="year">Street</label>
                        <input type="text" class="form-control" name="street" placeholder="Street of new cinema">
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection