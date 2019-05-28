@include('layouts.header')
<body>
    <div id="app">

            @include('layouts.nav')
        <div class="container">
            <div class="row" style="height: 4rem"></div>
            <div class="row">
                @yield('content')
                @if(Session::has('message'))
                    <flash message="{{ session('message') }}" level="{{ session('level') }}"></flash>
                @endif
            </div>
        </div>

    </div>
@include('layouts.footer')
