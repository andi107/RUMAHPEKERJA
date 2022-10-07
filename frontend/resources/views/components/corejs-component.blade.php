@if (config('app.env') === 'production')
    <script src="{{ secure_asset('src/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ secure_asset('src/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ secure_asset('src/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ secure_asset('src/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('src/js/main.js') }}"></script>
@else
    <script src="{{ asset('src/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('src/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('src/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('src/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('src/js/main.js') }}"></script>
@endif
