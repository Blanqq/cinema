@extends('layouts.app')

@section('title')
    401 - Access Denied
@endsection

@section('content')
    <div class="col-12">
        <h1>401 - Access Denied, You are not logged in!!!</h1>

        <p>
            <a href="/">Go To Home Page</a> or
            <a href="/login">Login</a>
        </p>
    </div>



@endsection