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
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-fork')}}"></use>
            </svg> Kategori</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('adm.category') }}"><span class="nav-icon"></span> Daftar Kategori</a></li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-newspaper')}}"></use>
            </svg> Post</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="#"><span class="nav-icon"></span> Daftar Posting</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('adm.post-create-index')}}"><span class="nav-icon"></span> Tambah</a></li>
            </ul>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
