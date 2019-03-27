@include('layouts.header')
<div id="app">
    <div id="home">

        @include('layouts.nav')

        <div class="landing">
            <div class="home-wrap">
                <div class="home-inner">

                </div>
            </div>
        </div>
        <div class="caption text-center">
            <h1>Welcome to our cinema network</h1>
            @if (auth()->check())
                <select-cinema :data-cinemas="{{$cinemas}}"></select-cinema>
            @else
                <h3>Please register or login to buy tickets</h3>
                <a href="/register" class="btn btn-outline-light btn-lg">Register</a>
                <a href="/login" class="btn btn-outline-light btn-lg">Login</a>
            @endif



        </div>
    </div>
</div>
@include('layouts.footer')
