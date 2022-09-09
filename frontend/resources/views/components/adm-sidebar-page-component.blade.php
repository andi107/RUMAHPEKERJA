<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('adm/assets/brand/coreui.svg#full')}}"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('adm/assets/brand/coreui.svg#signet')}}"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('adm.dashboard') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
                </svg>Dashboard
            </a>
        </li>
        <li class="nav-title">
            Content
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('adm.category') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-fork')}}"></use>
                </svg> Tambah Kategori
            </a>
            <a class="nav-link" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-newspaper')}}"></use>
                </svg> Tambah Postingan
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
