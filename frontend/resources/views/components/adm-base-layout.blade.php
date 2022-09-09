<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- <base href="./"> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard"> --}}
    
    <x-adm-corecss-component/>
    {{-- <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff"> --}}
    {{ $cssPage ?? '' }}
    {{ $titleSlot }}
  </head>
  <body>
    <x-adm-sidebar-page-component />
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg></a>
          <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" target="_blank">Rumah Pekerja Hebat</a></li>
          </ul>
          <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-bell')}}"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-list-rich')}}"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-envelope-open')}}"></use>
                </svg></a></li>
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('adm/assets/img/avatars/8.jpg')}}" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Settings</div>
                </div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                  </svg> Logout</a>
              </div>
            </li>
          </ul>
        </div>
        <x-adm-breadcrumb-component />
      </header>
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          {{ $slot }}
        </div>
      </div>
      <footer class="footer">
        <div>Rumah Pekerja Hebat © 2022.</div>
        <div class="ms-auto">Powered by&nbsp;RPH Labs</div>
      </footer>
    </div>
    
    <x-adm-corejs-component/>
    {{ $jsPage ?? '' }}
  </body>
</html>