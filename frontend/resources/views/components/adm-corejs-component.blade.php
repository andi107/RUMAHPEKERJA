@if (config('app.env') === 'production')
    <script src="{{ secure_asset('adm/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('adm/vendors/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ secure_asset('adm/vendors/chart.js/js/chart.min.js') }}"></script>
    <script src="{{ secure_asset('adm/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ secure_asset('adm/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
    <script src="{{ secure_asset('adm/js/main.js') }}"></script>
@else
    <script src="{{ asset('adm/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('adm/vendors/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('adm/vendors/chart.js/js/chart.min.js') }}"></script>
    <script src="{{ asset('adm/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('adm/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
    <script src="{{ asset('adm/js/main.js') }}"></script>
@endif