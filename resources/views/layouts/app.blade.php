@include('layouts.header')
<body>
    <div id="app">

            @include('layouts.nav')
        <div class="container">
            <div class="row" style="height: 4rem"></div>
            <div class="row">
                @yield('content')
            </div>
        </div>

    </div>
</body>
</html>
