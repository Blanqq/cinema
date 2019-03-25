@include('layouts.header')
<body>
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
                <form>
                    <select class="btn-lg" id="exampleFormControlSelect1">
                        <option selected>Please select your cinema</option>
                        <option>Rzeszów ul. Warszawska</option>
                        <option>New York Broadway</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <button class="btn btn-outline-light btn-lg">Go Reserve Tickets</button>
                </form>
            @else
                <h3>Please register or login to buy tickets</h3>
                <a href="" class="btn btn-outline-light btn-lg">Register</a>
                <a href="" class="btn btn-outline-light btn-lg">Login</a>
            @endif



        </div>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
