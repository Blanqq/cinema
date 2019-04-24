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
                <select-cinema :data-cinemas="{{$cinemas}}"></select-cinema>
        </div>
    </div>
</div>
@include('layouts.footer')
