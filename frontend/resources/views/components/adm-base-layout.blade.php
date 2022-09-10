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
      <x-adm-header-component />
      
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