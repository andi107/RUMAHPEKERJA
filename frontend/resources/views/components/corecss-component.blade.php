@if(config('app.env') === 'production')
{{-- <link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/bootstrap-5/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/animate/animate.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/css-hamburgers/hamburgers.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/animsition/css/animsition.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/css/util.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/css/main.min.css')}}"> --}}
@endif

<link rel="stylesheet" href="{{asset('src/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('src/plugins/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('src/plugins/slick-carousel/slick.min.css')}}">
<link rel="stylesheet" href="{{asset('src/plugins/slick-carousel/slick-theme.min.css')}}">
<link rel="stylesheet" href="{{asset('anim/css/animsition.min.css')}}">

{{-- <link rel="stylesheet" href="{{asset('src/css/style.css')}}"> --}}

<style>
    @import url("https://fonts.googleapis.com/css?family=Barlow:300,400,700|Libre+Franklin:400,600,700|Poppins:400,600,700,800");

    body,
    p {
        font-family: "Libre Franklin", sans-serif;
        line-height: 26px;
        font-size: 16px;
        text-rendering: optimizeLegibility;
        /* color: #666; */
        font-weight: 400;
    }

    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3,
    h4,
    .h4,
    h5,
    .h5,
    h6,
    .h6 {
        color: #1c1c1c;
        font-weight: 700;
        font-family: "Poppins", sans-serif;
        letter-spacing: -0.03em;
    }

    h1,
    .h1 {
        font-size: 36px;
        line-height: 48px;
    }

    h2,
    .h2 {
        font-size: 28px;
        line-height: 36px;
    }

    h3,
    .h3 {
        font-size: 24px;
    }

    h4,
    .h4 {
        font-size: 18px;
        line-height: 28px;
    }

    h5,
    .h5 {
        font-size: 14px;
        line-height: 24px;
    }

    /* 1.2. Common styles
================================================== */
    body {
        background: #fff;
        color: #575769;
    }

    html,
    body {
        height: 100%;
    }

    a {
        color: #FA7070;
    }

    a:link,
    a:visited {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
        color: #000;
    }

    a.read-more {
        color: #FA7070;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    a.read-more:hover {
        color: #000;
    }

    .section-padding {
        padding: 70px 0;
        position: relative;
    }

    .section-sm {
        padding: 30px 0;
    }

    .p-top-0 {
        padding-top: 0;
    }

    .p-bottom-0 {
        padding-bottom: 0;
    }

    .m-top-0 {
        margin-top: 0 !important;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .media>.pull-left {
        margin-right: 20px;
    }

    img.banner {
        display: inline-block;
    }

    .gap-60 {
        clear: both;
        height: 60px;
    }

    .py-50 {
        clear: both;
        height: 50px;
    }

    .py-40 {
        clear: both;
        height: 40px;
    }

    .py-30 {
        clear: both;
        height: 30px;
    }

    .gap-20 {
        clear: both;
        height: 20px;
    }

    .mrb-30 {
        margin-bottom: 30px;
    }

    .mrb-80 {
        margin-bottom: -80px;
    }

    .mrt-0 {
        margin-top: 0 !important;
    }

    .pab {
        padding-bottom: 0;
    }

    .mt-3 {
        margin-top: 3px;
    }

    a:focus {
        outline: 0;
    }

    img.pull-left {
        margin-right: 20px;
        margin-bottom: 20px;
    }

    img.pull-right {
        margin-left: 20px;
        margin-bottom: 20px;
    }

    ol,
    ul {
        margin-bottom: 20px;
    }

    .ts-padding {
        padding: 60px;
    }

    .solid-bg {
        background: #f9f9f9;
    }

    .solid-row {
        background: #f0f0f0;
    }

    /* Dropcap */
    .dropcap {
        font-size: 44px;
        line-height: 50px;
        display: inline-block;
        /* float: left; */
        margin: 0 12px 0 0;
        position: relative;
        text-transform: uppercase;
    }

    /* Video responsive */
    .embed-responsive {
        padding-bottom: 56.25%;
        position: relative;
        display: block;
        height: 0;
        overflow: hidden;
    }

    .embed-responsive iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Input form */
    .form-control {
        box-shadow: none;
        border: 1px solid transparent;
        padding: 15px 20px;
        background: #f0f1f4;
        font-size: 14px;
        border-radius: 2px;
    }

    .form-control:focus {
        box-shadow: none;
        border: 1px solid #dc359c;
    }

    hr {
        background-color: #e7e7e7;
        border: 0;
        height: 1px;
        margin: 40px 0;
    }

    blockquote {
        position: relative;
        background: #f7f7f7;
        padding: 45px 50px 30px;
        border: 0;
        margin: 50px 0 40px;
        font-size: 22px;
        line-height: 34px;
        font-family: Arimo, sans-serif;
        font-weight: 400;
        text-align: center;
    }

    blockquote:before {
        position: absolute;
        content: "\f10e";
        font-family: FontAwesome;
        font-size: 24px;
        padding: 8px 15px;
        top: -30px;
        left: 50%;
        margin-left: -44px;
        color: #fff;
        background: #FA7070;
    }

    cite {
        display: block;
        font-size: 14px;
        margin-top: 10px;
    }

    blockquote.pull-left {
        padding-left: 15px;
        padding-right: 0;
        text-align: left;
        border-left: 5px solid #eee;
        border-right: 0;
    }

    /* Button */
    .btn-primary,
    .btn-dark {
        border: 0;
        border-radius: 2px;
        padding: 15px 30px;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff;
        transition: 350ms;
    }

    .btn-white.btn-primary {
        background: #fff;
        color: #FA7070;
    }

    .btn-primary {
        background: #FA7070;
    }

    .btn-primary:hover {
        background: #d32535;
        color: #fff;
    }

    .btn-dark {
        background: #292931;
    }

    .btn-dark:hover,
    .btn-white.btn-primary:hover {
        background: #272d33;
        color: #fff;
    }

    .general-btn {
        clear: both;
        margin-top: 50px;
    }

    /* Ul, Ol */
    .list-round,
    .list-arrow,
    .list-check {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .list-round li {
        line-height: 28px;
    }

    .list-round li:before {
        font-family: FontAwesome;
        content: "\f138";
        margin-right: 10px;
        color: #FA7070;
        font-size: 12px;
    }

    .list-arrow {
        padding: 0;
    }

    ul.list-arrow li:before {
        font-family: FontAwesome;
        content: "\f105";
        margin-right: 10px;
        color: #FA7070;
        font-size: 16px;
    }

    ul.list-check li:before {
        font-family: FontAwesome;
        content: "\f00c";
        margin-right: 10px;
        color: #FA7070;
        font-size: 14px;
    }

    /* Bootstrap */
    .nav-tabs>li.active>a {
        border: 0;
        background: none;
    }

    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: 0;
        background: none;
    }

    .nav-tabs>li>a {
        border: 0;
        background: none;
    }

    .nav-tabs>li>a:hover {
        border: 0;
        background: none;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background: none;
    }

    a[href^=tel] {
        color: inherit;
        text-decoration: none;
    }

    /*-- Block title --*/
    .news-title {
        font-size: 18px;
        line-height: 28px;
        line-height: 100%;
        text-transform: uppercase;
        margin: 0 0 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #ddd;
    }

    .news-title span {
        line-height: 28px;
        padding-bottom: 14px;
        position: relative;
    }

    .news-title span:after {
        content: "";
        position: absolute;
        width: 30px;
        height: 2px;
        background: #FA7070;
        left: 0px;
        bottom: 0px;
    }

    .block {
        position: relative;
    }

    .ad-section img {
        display: inline-block;
    }

    .breadcrumb-wrapper {
        background: #fff;
    }

    .breadcrumb {
        color: #777;
        margin: 20px 0 20px 0;
        padding: 0;
        background: none;
    }

    .breadcrumb>li+li:before {
        content: "\f105";
        font-family: FontAwesome;
        padding: 0 8px;
        color: #777;
    }

    .slick-slide {
        outline: 0;
    }

    .alert .icon {
        margin-right: 15px;
    }

    /* 2. HEADER
================================================== */
    .navigation {
        padding: 10px 0;
    }

    .header-navigation {
        padding: 10px 0;
        background: #fff;
    }

    .logo {
        padding: 28px 0;
    }

    .navbar-collapse {
        padding-left: 0;
    }

    .navbar-toggler {
        padding: 8px;
    }

    .navbar-toggler:focus {
        outline: none;
    }

    .navbar-nav .nav-item .active.nav-link:before {
        opacity: 1;
    }

    .navbar-nav .nav-item .nav-link {
        padding-right: 25px;
        display: inline-block;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff;
        margin: 0;
        position: relative;
        transition: 350ms;
    }

    @media (max-width: 767px) {
        .navbar-nav .nav-item .nav-link {
            display: block;
        }
    }

    @media (max-width: 575px) {
        .navbar-nav .nav-item .nav-link {
            display: block;
        }
    }

    @media (max-width: 991px) {
        .navbar-nav .nav-item .nav-link {
            display: block;
            padding: 10px 0;
        }
    }

    .navbar-nav .nav-item .nav-link:hover:before,
    .navbar-nav .nav-item .nav-link.active .navbar-nav .nav-item .nav-link:before {
        opacity: 1;
    }

    .main-navbar {
        position: relative;
        border-bottom: 3px solid #FA7070;
    }

    .main-navbar .dropdown:hover .dropdown-menu {
        transform: scaleY(1);
        opacity: 1;
        display: block;
        visibility: visible;
    }

    .main-navbar .dropdown-menu {
        text-align: left;
        background: #fff;
        z-index: 999;
        min-width: 230px;
        border-radius: 0;
        border: 0;
        margin: 0;
        display: block;
        transform: scaleY(0);
        opacity: 0;
        visibility: hidden;
        transform-origin: top;
        transition: all 0.5s cubic-bezier(0.075, 0.82, 0.165, 1);
        box-shadow: 0px 5px 8px 0px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 767px) {
        .main-navbar .dropdown-menu {
            display: none;
        }
    }

    @media (max-width: 575px) {
        .main-navbar .dropdown-menu {
            display: none;
        }
    }

    @media (max-width: 991px) {
        .main-navbar .dropdown-menu {
            display: none;
        }
    }

    .main-navbar .dropdown-menu .dropdown-item {
        display: block;
        font-size: 14px;
        padding: 8px 15px;
        border-bottom: 1px solid #e5e5e5;
        color: #1c1c1c;
        font-family: "Poppins", sans-serif;
        transition: all 0.3s ease;
    }

    .main-navbar .dropdown-menu .dropdown-item:last-child {
        border: none;
    }

    .main-navbar .dropdown-menu .dropdown-item:hover {
        background: #FA7070;
        color: #fff;
    }

    .site-search {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        transition: 0.3s;
        background-color: #fff;
        opacity: 0;
        visibility: hidden;
        z-index: 10;
        top: 0;
    }

    .site-search input {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        padding: 0 3%;
        border: 0;
        background-color: #fff;
        color: #FA7070;
        font-size: 17px;
        font-family: "Poppins", sans-serif;
    }

    .site-search input:focus {
        outline: 0;
        box-shadow: none;
        border: none;
    }

    .site-search .search-close {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        right: 3%;
        cursor: pointer;
    }

    .site-search.visible {
        opacity: 1;
        visibility: visible;
    }

    .nav-search span {
        display: inline-block;
        cursor: pointer;
        padding: 10px;
        font-size: 18px;
    }

    .close-search {
        font-size: 20px;
    }

    .top-navigation {
        padding: 8px 0;
        border-bottom: 1px solid #dedede;
        color: #a3a3a3;
        font-size: 13px;
    }

    .top-nav {
        display: inline-block;
    }

    .top-nav li {
        display: inline-block;
        line-height: 12px;
        padding-left: 12px;
    }

    .top-nav li a {
        background: none;
        color: #a3a3a3;
        padding: 0;
        line-height: 100%;
    }

    .top-nav li a:hover {
        color: #FA7070;
    }

    .top-nav-social-lists ul {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: -3px;
    }

    .top-nav-social-lists li {
        display: inline-block;
        padding: 0;
    }

    .top-nav-social-lists li a {
        color: #a3a3a3;
        margin-right: 15px;
        font-size: 14px;
        transition: 400ms;
    }

    .top-nav-social-lists li a:hover {
        color: #fff;
    }

    .bg-dark {
        background: #000 !important;
    }

    .dropdown-menu {
        padding: 0px;
    }

    .navbar-toggler span {
        color: #fff;
    }

    /* 3. TRANDING NEWS
================================================== */
    .trending-bar-dark {
        background: #292931;
        color: #fff;
        padding: 10px 0;
    }

    .trending-bar-title {
        background: #FA7070;
        color: #fff;
        display: inline-block;
        font-size: 11px;
        padding: 5px 10px;
        line-height: 100%;
        text-transform: uppercase;
        /* float: left; */
        margin: 0 20px 0 0;
        border-radius: 2px;
    }

    .trending-bar-dark .post-content,
    .trending-light .post-content {
        padding: 0;
    }

    .trending-news-slider .post-title a {
        color: #fff;
        font-weight: 600;
    }

    .trending-news-slider .post-title.title-sm {
        font-weight: 400;
        margin: 0;
        font-size: 12px;
        line-height: 20px;
    }

    .trending-news-slider .slick-prev:before,
    .trending-news-slider .slick-next:before {
        font-family: FontAwesome;
        font-size: 13px;
        color: #fff;
        opacity: 1;
    }

    .trending-news-slider .slick-next:before {
        content: "\f105";
    }

    .trending-news-slider .slick-prev:before {
        content: "\f104";
    }

    .trending-news-slider .slick-next {
        border-radius: 2px;
        right: 0;
        background: #FA7070;
    }

    .trending-news-slider .slick-prev {
        background: #FA7070;
        border-radius: 2px;
        left: unset;
        right: 30px;
        z-index: 3;
    }

    /* 4. SIDEBAR
================================================== */
    .post-title {
        font-size: 20px;
        line-height: 25px;
    }

    .post-title a {
        color: #292931;
        transition: 0.2s all;
    }

    .post-title.title-xl {
        font-size: 26px;
        line-height: 30px;
        margin-top: 15px;
        margin-bottom: 0px;
    }

    .post-title.title-large {
        font-size: 22px;
        line-height: 32px;
        margin-bottom: 10px;
        margin-top: 0px;
    }

    .post-title.title-medium {
        font-size: 16px;
        line-height: 22px;
        font-weight: 600;
    }

    .post-title.title-sm {
        font-weight: 600;
        font-size: 18px;
        line-height: 24px;
    }

    .title-large {
        font-size: 22px;
    }

    a.post-category {
        position: relative;
        font-size: 11px;
        background: transparent;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
        background: #eee;
        padding: 4px 8px;
        margin-top: 10px;
        margin-bottom: 10px;
        display: inline-block;
        transition: all 0.3s ease-in-out;
        line-height: 1.2;
        color: #fff;
        background: #FA7070;
    }

    a.post-category.white:hover {
        color: #fff;
        background: #FA7070;
    }

    a.post-category.absolute {
        position: absolute;
        left: 5px !important;
    }

    .post-category a {
        color: #fff;
    }

    .post-meta {
        text-transform: capitalize;
        font-size: 14px;
    }

    .post-meta span {
        font-family: "Poppins", sans-serif;
        margin-right: 8px;
        display: inline-block;
        color: #999;
    }

    .post-meta span a {
        color: #999;
    }

    .post-meta.white span {
        color: #fff;
    }

    .post-meta.white a {
        color: #fff;
    }

    .post-meta span i {
        margin-right: 5px;
    }

    .post-author a {
        color: #999;
    }

    .post-author a:hover {
        color: #FA7070;
    }

    .post-overlay-wrapper {
        position: relative;
    }

    .post-overlay-wrapper:before {
        content: " ";
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        z-index: 1;
        bottom: 0;
        left: 0;
        border-radius: 4px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 20%, rgba(0, 0, 0, 0.95) 100%);
    }

    .post-overlay-wrapper .post-thumbnail {
        position: relative;
    }

    .post-overlay-wrapper .post-thumbnail a {
        display: inline-block;
    }

    .post-overlay-wrapper .post-thumbnail img {
        display: block;
        width: 100%;
        height: auto;
        transition: all 0.3s ease-out;
    }

    .post-overlay-wrapper .post-content {
        position: absolute;
        bottom: 0;
        padding: 25px;
        width: 100%;
        z-index: 9;
    }

    @media (max-width: 991px) {
        .post-overlay-wrapper .post-content {
            padding: 8px;
        }

        .post-overlay-wrapper .post-content .post-title {
            font-size: 15px;
            line-height: 20px;
        }
    }

    .post-overlay-wrapper .post-title a,
    .post-overlay-wrapper .posted-time {
        color: #fff;
    }

    .thumb-float-style .post-category {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1;
    }

    .post-overlay-wrapper.contentTop .post-content {
        top: 0;
        bottom: auto;
    }

    .post-overlay-wrapper.contentTop:before {
        top: 0;
        left: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0.85) 100%);
    }

    .post-overlay-wrapper.text-center {
        margin-bottom: 30px;
    }

    .post-overlay-wrapper.text-center .post-content {
        padding: 30px 30px 60px;
    }

    .post-overlay-wrapper.text-center:last-child {
        margin-bottom: 0;
    }

    .post-overlay-wrapper.text-center .post-meta span {
        padding: 0;
        margin: 0;
    }

    .post-overlay-wrapper.text-center:before {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0.85) 100%);
    }

    .post-block-wrapper {
        position: relative;
    }

    .post-block-wrapper .post-thumbnail {
        margin-bottom: 20px;
    }

    .post-block-wrapper .post-content {
        padding: 0;
    }

    .post-block-wrapper .post-content .post-title a:hover {
        color: #FA7070;
    }

    .post-block-wrapper .post-category {
        top: 10px;
    }

    .post-block-wrapper .post-content .post-meta {
        margin: 3px 0 10px 0px;
        line-height: 0px;
    }

    .post-list-block {
        margin-top: 30px;
    }

    @media (max-width: 991px) {
        .post-list-block {
            margin-bottom: 30px;
        }
    }

    .post-block-wrapper.post-float {
        display: flex;
    }

    .post-block-wrapper.post-float .post-thumbnail {
        position: relative;
        z-index: 1;
        margin-right: 13px;
        /* flex: 1; */
        object-fit: cover;
        width: 350px;
        height: 233px;
    }

    .post-block-wrapper.post-float .post-title {
        margin-top: 0;
    }

    .post-block-wrapper.post-float .post-content {
        z-index: 0;
        flex: 1;
    }

    .post-block-wrapper.post-float .post-category {
        font-size: 8px;
        left: 0;
        top: 0;
    }

    .block-wrapper {
        padding: 20px 0px 70px 0px;
    }

    .post-block-wrapper.post-float-half .post-thumbnail {
        float: left;
        position: relative;
        z-index: 1;
    }

    @media (max-width: 767px) {
        .post-block-wrapper.post-float-half .post-thumbnail {
            margin-right: 0;
        }
    }

    .news-style-one-slide .post-block-wrapper {
        padding: 0 15px 0px 0px;
    }

    .news-style-one-slide .slick-prev:before,
    .news-style-one-slide .slick-next:before {
        font-family: FontAwesome;
        font-size: 13px;
        color: #999;
        opacity: 1;
        color: #fff;
    }

    .news-style-one-slide .slick-next:before {
        content: "\f105";
    }

    .news-style-one-slide .slick-prev:before {
        content: "\f104";
    }

    .news-style-one-slide .slick-next {
        right: 0;
        border: 1px solid #FA7070;
        background: #FA7070;
        border-radius: 2px;
    }

    .news-style-one-slide .slick-prev {
        border: 1px solid #FA7070;
        left: unset;
        right: 35px;
        z-index: 3;
        background: #FA7070;
        border-radius: 2px;
    }

    .news-style-one-slide .slick-prev,
    .news-style-one-slide .slick-next {
        height: 33px;
        width: 33px;
        top: -42px;
        transition: 0.2s all;
    }

    .news-style-one-slide .slick-prev:hover,
    .news-style-one-slide .slick-next:hover {
        background: #FA7070;
        border-color: #FA7070;
    }

    .news-style-one-slide .slick-prev:hover:before,
    .news-style-one-slide .slick-next:hover:before {
        color: #fff !important;
    }

    .post-slide .slick-prev:before,
    .post-slide .slick-next:before {
        font-family: FontAwesome;
        font-size: 13px;
        color: #fff;
        opacity: 1;
    }

    .post-slide .slick-next:before {
        content: "\f105";
    }

    .post-slide .slick-prev:before {
        content: "\f104";
    }

    .post-slide .slick-next {
        border-radius: 2px;
        right: 0;
        background: #FA7070;
    }

    .post-slide .slick-prev {
        background: #FA7070;
        border-radius: 2px;
        left: unset;
        right: 36px;
        z-index: 3;
    }

    .post-slide .slick-prev,
    .post-slide .slick-next {
        height: 33px;
        width: 33px;
        top: -42px;
    }

    .post-list-view {
        margin-bottom: 20px;
    }

    .post-grid-view {
        margin-bottom: 40px;
    }

    .post-thumbnail img {
        border-radius: 4px;
        object-fit: cover;
        width: 350px;
        height: 233px;
    }

    .pagination-wrapper {
        position: relative;
        margin-top: 60px;
    }

    .pagination {
        margin: 0;
        text-align: center;
    }

    .pagination .page-item {
        display: inline-block;
    }

    .pagination .page-item a {
        margin-right: 8px;
        color: #292931;
        padding: 10px 16px;
        transition: all 0.3s ease;
        display: inline-block;
        border-radius: 3px;
        border: 1px solid #dedede;
    }

    .pagination .page-item a:hover {
        color: #fff;
        background: #FA7070;
        border-color: #FA7070;
    }

    .pagination .page-item.active>a {
        color: #fff;
        background: #FA7070;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.02);
        border-color: #FA7070;
    }

    .pagination .page-item.active>a:hover {
        color: #fff;
        background: #FA7070;
        border-color: #FA7070;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.02);
    }

    .pagination li>a:hover {
        color: #fff;
        background: #FA7070;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.02);
    }

    .page-item:first-child .page-link {
        margin-left: 0;
        border-radius: 3px;
    }

    .post-cat {
        padding: 3px 7px;
        color: #fff;
        text-transform: uppercase;
        font-size: 11px;
        margin-bottom: 10px;
        display: inline-block;
        font-weight: 600;
        letter-spacing: 0.5px;
        line-height: 17px;
    }

    .post-cat:hover {
        color: #fff;
    }

    .post-featured-style {
        min-height: 230px;
        margin-bottom: 15px;
        position: relative;
        width: 100%;
        border-radius: 4px;
        background-size: cover;
        transition: all 300ms ease-in-out;
    }

    .post-featured-style .post-content {
        padding: 30px;
        transition: all 0.3s ease;
        position: absolute;
        z-index: 9;
        bottom: 0;
    }

    .post-featured-style .post-title a {
        color: #fff;
    }

    .post-featured-style .post-meta span {
        color: #fff;
    }

    .post-featured-style .post-meta a {
        color: #fff;
    }

    .post-featured-style:after {
        position: absolute;
        content: "";
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        border-radius: 4px;
        background: rgba(0, 0, 0, 0.4);
    }

    .post-author img {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 100%;
        margin-right: 10px;
    }

    .news-style-two-slide .item {
        padding-right: 5px;
    }

    /* 5. POST SINGLE STYLES
================================================== */
    .single-block-wrapper {
        background: #fff;
    }

    .single-post .post-title {
        font-size: 23px;
        line-height: 31px;
        padding: 15px 0 8px 0;
        margin: 0;
        font-weight: 800;
    }

    .single-post p {
        margin-bottom: 15px;
        color: #000;
    }

    .post-body {
        margin: 20px 0;
    }

    .post-featured-image {
        margin-bottom: 30px;
        border-radius: 2px;
        overflow: hidden;
    }

    .post-ad-holder {
        margin: 20px 0;
    }

    @media (max-width: 767px) {
        .post-ad-holder {
            flex-direction: column;
        }
    }

    .post-ad-holder img {
        margin-right: 30px;
    }

    @media (max-width: 767px) {
        .post-ad-holder img {
            margin-right: 0;
            margin-bottom: 20px;
        }
    }

    @media (max-width: 767px) {
        .post-ad-holder p {
            flex-basis: 100%;
        }
    }

    .post-media.post-video,
    .post-media.post-audio {
        margin-bottom: 30px;
    }

    .entry-content h3 {
        margin: 0;
        padding: 20px;
        font-size: 22px;
        line-height: 30px;
    }

    .tags-source {
        margin: 20px 0;
    }

    .post-source span,
    .post-tags span {
        text-transform: uppercase;
        border-radius: 2px;
        margin-right: 5px;
        font-size: 12px;
    }

    .post-source a,
    .post-tags a {
        border-radius: 2px;
        display: inline;
        list-style: none;
        padding: 5px 10px;
        margin-right: 5px;
        text-align: center;
        font-size: 12px;
        color: #292931;
        background: #f0f1f4;
        transition: all 0.3s ease-in-out;
    }

    .post-source a:hover,
    .post-tags a:hover {
        background: #FA7070;
        color: #fff;
        border-color: #FA7070;
    }

    .share-block {
        padding: 20px 0px;
        margin: 25px 0px 55px 0px;
    }

    .share-icons {
        margin-bottom: 0px;
    }

    .share-icons>li {
        display: inline-block;
    }

    .share-icons>li:not(:last-child) {
        margin-right: 8px;
    }

    .share-icons a {
        text-align: center;
        height: 38px;
        color: #000;
        background: #f0f1f4;
        width: 38px;
        display: block;
        border-radius: 100%;
    }

    .share-icons a i {
        font-size: 14px;
        line-height: 38px;
    }

    .share-icons>li.facebook a {
        color: #3B5998;
    }

    .share-icons>li.twitter a {
        color: #00aced;
    }

    .share-icons>li.gplus a {
        color: #c53942;
    }

    .share-icons>li.pinterest a {
        color: #ce222b;
    }

    .share-icons>li.reddit a {
        color: orangered;
    }

    .post-navigation {
        display: inline-block;
        padding: 30px 20px;
        background: #f0f1f4;
        border-radius: 2px;
        margin-bottom: 30px;
    }

    .post-navigation span:hover,
    .post-navigation h3:hover {
        color: #FA7070;
    }

    .post-navigation .previous-post,
    .post-navigation .next-post {
        width: 50%;
    }

    .post-navigation h6 {
        font-weight: 400;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .post-navigation i {
        margin: 0 5px;
    }

    .post-navigation span {
        font-size: 14px;
        color: #ccc;
        margin-top: 10px;
    }

    .post-navigation .previous-post {
        text-align: left;
        float: left;
        border-left: 0 none;
        border-right: 0 none;
        padding: 0 30px 0 0;
        border-right: 1px solid #dedede;
    }

    .post-navigation .previous-post span {
        margin-right: 20px;
    }

    .post-navigation .next-post {
        text-align: right;
        float: left;
        border-right: 0 none;
        padding: 0 0 0 30px;
    }

    .post-navigation .next-post span {
        margin-left: 20px;
    }

    .post-navigation h3 {
        font-size: 20px;
        margin: 8px 0 0;
    }

    .author-block {
        padding: 25px 40px 55px 40px;
        margin-bottom: 50px;
        border-radius: 3px;
        text-align: center;
        background: #f0f1f4;
        position: relative;
        margin-top: 95px;
    }

    .author-thumb img {
        width: 130px;
        height: 130px;
        border-radius: 100%;
        margin-top: -70px;
        margin-bottom: 25px;
    }

    .author-url a {
        color: #1c1c1c;
        font-size: 13px;
    }

    .author-content h3 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    .author-content h3 a {
        color: #292931;
    }

    .author-content .author-counter {
        margin: 10px 0;
    }

    .author-content .author-counter span {
        background: #292931;
        color: #fff;
        font-size: 12px;
        font-family: "Poppins", sans-serif;
        padding: 5px 10px;
        border-radius: 2px;
    }

    .author-content .author-counter span a {
        color: #fff;
    }

    .authors-social a {
        color: #292931;
        margin-right: 10px;
    }

    .authors-social a i {
        font-size: 16px;
    }

    .comments-block {
        margin: 40px 0;
    }

    .all-comments .comment-content {
        margin: 15px 0;
    }

    .all-comments .comment-reply {
        font-weight: 400;
        color: #777;
        font-size: 13px;
        border: 1px solid #dadada;
        padding: 5px 10px;
        border-radius: 3px;
    }

    .all-comments .comment-reply:hover {
        background: #FA7070;
        color: #fff;
        border-color: #FA7070;
    }

    .comments-counter {
        font-size: 18px;
    }

    .comments-counter a {
        color: #323232;
    }

    .all-comments {
        list-style: none;
        margin: 0;
        padding: 20px 0;
    }

    .all-comments .comment {
        border-bottom: 1px solid #e7e7e7;
        padding-bottom: 20px;
        margin-bottom: 20px;
        display: flex;
    }

    .all-comments .comment.last {
        border-bottom: 0;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .all-comments img.commented-person {
        height: 80px;
        margin-right: 20px;
        border-radius: 5px;
    }

    .all-comments .commented-person-name {
        margin-bottom: 0;
        margin-top: 0;
        font-weight: 600;
        font-size: 18px;
        color: #303030;
    }

    .all-comments .comment-hour {
        color: #959595;
        font-size: 14px;
    }

    .comments-reply {
        list-style: none;
        margin: 0 0 0 70px;
    }

    .comment-form {
        margin-bottom: 0;
    }

    .comment-form .title-normal {
        font-size: 22px;
    }

    .comment-form .comments-btn {
        margin-top: 10px;
        font-size: 12px;
    }

    .newsletter-form .btn-primary {
        padding: 10px 25px;
        font-size: 14px;
    }

    .single-media img {
        width: 50%;
    }

    @media (max-width: 991px) {
        .single-media img {
            width: 50%;
        }
    }

    @media (max-width: 991px) {
        .media {
            display: block;
        }

        .single-media img {
            width: 100%;
            margin-bottom: 20px;
        }
    }

    /* 6. FEATURE POST STYLES 
================================================== */
    .featured-posts {
        padding: 20px 0;
    }

    .featured-posts .second-post {
        margin-top: 10px;
    }

    .featured-slider .item {
        min-height: 477px;
        position: relative;
        background-position: 50% 50%;
        background-size: cover;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    @media (max-width: 991px) {
        .featured-slider .item {
            min-height: 296px;
        }
    }

    @media (max-width: 767px) {
        .featured-slider .item {
            margin-bottom: 20px;
        }
    }

    .featured-slider .item:before {
        content: " ";
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        z-index: 1;
        bottom: 0;
        left: 0;
        border-radius: 4px;
        transition: all 0.3s ease;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, 0.85) 100%);
    }

    .featured-slider .post-content {
        padding: 30px;
        transition: all 0.3s ease;
        position: absolute;
        z-index: 9;
        bottom: 0;
    }

    .featured-slider .slider-post-title {
        margin-bottom: 0;
    }

    .featured-slider .slider-post-title a {
        color: #fff;
    }

    .featured-post .posted-time,
    .featured-post .post-title a {
        color: #fff;
    }

    .featured-slider.content-bottom .featured-post {
        position: absolute;
        bottom: 0;
    }

    .featured-slider.content-bottom .item:before {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, 0.85) 100%);
    }

    /* 7. POST CATEGORY STYLES
================================================== */
    .category-listing .post-block-wrapper .post-content p {
        font-size: 14px;
    }

    .subCategory>li {
        display: inline-block;
        margin-bottom: 30px;
    }

    .subCategory>li>a {
        border: 1px solid #dedede;
        padding: 2px 6px;
        margin-right: 6px;
        color: #515151;
        font-size: 11px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .subCategory>li>a:hover {
        background: #FA7070;
        color: #fff;
        border: 1px solid transparent;
    }

    /* Post grid */
    .post-grid {
        margin-bottom: 15px;
        min-height: 455px;
    }

    /* Post list */
    .post-list {
        margin-bottom: 40px;
    }

    /* Top large post */
    .top-larget-post {
        margin-bottom: 30px;
    }

    .top-larget-post .post-title.title-large {
        margin-top: 20px;
        font-size: 24px;
    }

    .category-style2 .post-title {
        margin-top: 0;
    }

    /* 8. SIDEBAR
================================================== */
    .sidebar .widget.mb-0 {
        margin-bottom: 0;
    }

    .social-widget a {
        display: inline-block;
        width: 40px;
        height: 40px;
        text-align: center;
        margin-bottom: 10px;
    }

    .social-widget a i {
        color: #fff;
        font-size: 18px;
        line-height: 40px;
    }

    .social-widget .facebook {
        background: #516eab;
    }

    .social-widget .twitter {
        background: #29c5f6;
    }

    .social-widget .youtube {
        background: #e14e42;
    }

    .social-widget .pinterest {
        background: #C92228;
    }

    .social-widget .linkedin {
        background: #3f729b;
    }

    .social-widget .youtube {
        background: #C92228;
    }

    .sidebar .widget {
        margin-bottom: 50px;
    }

    @media (max-width: 991px) {
        .sidebar .widget {
            margin: 25px 0;
        }
    }

    .sidebar-left .widget {
        margin-right: 20px;
    }

    .sidebar-right .widget {
        margin-left: 20px;
    }

    .sidebar ul.nav-tabs {
        border: 0;
    }

    .sidebar ul.nav-tabs li {
        color: #303030;
        line-height: normal;
    }

    .sidebar ul.nav-tabs li a {
        color: #303030;
        border-radius: 0;
        padding: 15px 0;
        padding-left: 0;
        font-weight: 400;
        border-bottom: 1px solid #ddd;
        transition: 400ms;
    }

    .sidebar ul.nav-tabs li.active a,
    .sidebar ul.nav-tabs li:hover a {
        color: #FA7070;
    }

    .sidebar ul.nav-tabs li:last-child a {
        border-bottom: 0;
    }

    .newsletter-text {
        font-size: 16px;
        font-family: "Poppins", sans-serif;
    }

    .newsletter-form button {
        margin-top: 15px;
    }

    .widget-tags ul>li {
        float: left;
        margin: 3px;
    }

    .sidebar .widget-tags ul>li a {
        border: 1px solid #dadada;
        color: #303030;
        display: block;
        font-size: 14px;
        padding: 3px 15px;
        transition: all 0.3s ease 0s;
    }

    .sidebar .widget-tags ul>li a:hover {
        background: #FA7070;
        color: #fff;
        border: 1px solid transparent;
    }

    .post-block-wrapper.post-float.review-post-block {
        max-width: 140px;
        min-height: 105px;
    }

    .post-block-wrapper.post-float.review-post-block .post-thumbnail img {
        max-width: 140px;
        min-height: 105px;
    }

    .block-wrapper.no-sidebar {
        max-width: 850px;
        margin: 0 auto;
    }

    .block-wrapper.no-sidebar>.container {
        max-width: 850px;
        margin: 0 auto;
    }

    .block-wrapper.solid-bg {
        background: #f7f7f7;
        background: rgb(247, 247, 247);
    }

    .solid-bg .pr-2 {
        padding-right: 4px;
    }

    .solid-bg .pl-2 {
        padding-left: 4px;
    }

    .top-author {
        display: flex;
        margin-bottom: 38px;
        object-fit: cover;
        width: 169px;
        height: 112px;
    }

    .top-author .info {
        margin-left: 20px;
    }

    .top-author .info h4 {
        margin: 0;
    }

    .top-author .info h4 a {
        color: #292931;
    }

    .top-author .info li {
        font-family: "Poppins", sans-serif;
    }

    .job-item p {
        margin-bottom: 0px;
    }

    .info-list li {
        margin-bottom: 15px;
    }

    .signup {
        border: 2px solid #eee;
        padding: 40px;
    }

    .login {
        border: 2px solid #eee;
        padding: 40px;
    }

    /* Error page
================================================== */
    .error-block {
        padding: 50px;
        text-align: center;
    }

    .error-block .throw-code h2 {
        display: block;
        font-size: 170px;
        line-height: 170px;
        color: #FA7070;
        margin-bottom: 30px;
    }

    .error-block a {
        text-transform: capitalize;
        font-weight: 600;
        color: #000;
        font-size: 16px;
    }

    .broken-img {
        text-align: center;
        border-radius: 10px;
    }

    .mt-50 {
        margin-top: 50px;
    }

    @media (max-width: 575px) {
        .error-block .throw-code h2 {
            font-size: 100px;
            line-height: 115px;
        }
    }

    @media (max-width: 400px) {
        .error-block .throw-code h2 {
            font-size: 100px;
            line-height: 115px;
        }
    }

    @media (max-width: 767px) {
        .error-block .throw-code h2 {
            font-size: 100px;
            line-height: 115px;
        }
    }

    .search-info i {
        width: 90px;
        height: 90px;
        background: #f0f1f4;
        border-radius: 100%;
        font-size: 22px;
        padding-top: 35px;
    }

    .job-item h4 {
        flex-basis: 40%;
    }

    .login-signup {
        display: flex;
        align-items: center;
        height: 100%;
        width: 100%;
    }

    /* 10. CONTACT
================================================== */
    .contact-info-box {
        margin-top: 20px;
    }

    .contact-info-box-content h4 {
        font-size: 16px;
        margin-top: 0;
        line-height: normal;
        font-weight: 700;
    }

    .contact-info-box-content p {
        margin-bottom: 0;
    }

    label {
        font-weight: 400;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .lh-45 {
        line-height: 45px;
    }

    select.form-control:not([size]):not([multiple]) {
        height: auto !important;
    }

    /* 11. FOOTER
================================================== */
    .footer {
        background: #000;
    }

    .footer-main {
        padding: 60px 0px;
    }

    .footer-widget .post-block-wrapper.post-float .post-thumbnail img {
        max-width: 95px;
        min-height: 75px;
    }

    .footer-widget.widget-categories ul {
        padding-right: 30px;
    }

    .footer-widget.widget-categories ul li .catCounter {
        float: right;
    }

    .copyright-text p a {
        color: #fff;
    }

    .footer-social {
        margin: 25px 0px;
    }

    .footer-social a {
        font-size: 16px;
        padding: 10px 10px;
        width: 35px;
        height: 35px;
        display: inline-block;
        color: #fff;
        background: #111;
        border-radius: 2px;
        padding-top: 5px;
    }

    .footer-social a:hover {
        background: #FA7070;
    }

    .scroll-to-top {
        position: fixed;
        display: none;
        right: 40px;
        bottom: 30px;
        z-index: 10;
    }

    .scroll-to-top .btn.btn-primary {
        width: 50px;
        height: 50px;
        line-height: 50px;
        background: rgba(41, 41, 49, 0.9);
        font-size: 20px;
        padding: 0;
        border-radius: 4px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.08);
        outline: none;
    }

    .scroll-to-top .btn.btn-primary:hover {
        color: #fff;
        background: #FA7070;
    }

    .widget-tags a {
        display: inline-block;
        padding: 12px 15px;
        border: 1px solid #eee;
        font-size: 18px;
        color: #000;
        margin-bottom: 10px;
        margin-right: 8px;
        text-transform: capitalize;
    }

    .widget-tags a:hover {
        background: #FA7070;
        color: #fff;
    }

    .lead {
        line-height: 28px;
        font-size: 18px;
        color: #787878;
    }

    .footer-post .post-content h4 {
        font-size: 18px;
        line-height: 22px;
    }

    .footer-post .post-content a {
        color: #000;
    }

    .footer-post .post-content a:hover {
        color: #FA7070;
    }

    .footer-post .footer-post-thumbnail img {
        width: 90px;
        margin-right: 20px;
        border-radius: 4px;
    }

    a {
        transition: all 0.35s ease;
    }

    /* 12. RESPONSIVE STYLES
================================================== */
    /* Medium Devices, Desktops */
    @media (min-width: 992px) and (max-width: 1199px) {

        /* Header */
        ul.navbar-nav>li {
            padding: 0 10px;
        }

        ul.navbar-nav>li>a,
        .dropdown-menu li a {
            font-size: 12px;
        }

        /* Projects */
        .project-item-title {
            font-size: 18px;
        }

        /* Clients */
        .clients-logo {
            margin-bottom: 20px;
        }

        /* Action box */
        .action-box-text {
            font-size: 13px;
        }

        /* Footer */
        .footer-social-icons ul li {
            margin: 0 3px 0 0;
        }

        .footer-menu {
            float: none;
        }

        #back-to-top.affix {
            bottom: 35px;
        }

        #back-to-top {
            right: 15px;
        }

        .mega-menu-content {
            max-width: 940px;
        }
    }

    /* Small Devices, Tablets */
    @media (min-width: 768px) and (max-width: 991px) {

        /* top info */
        ul.top-info li {
            padding-right: 12px;
        }

        /* Header */
        .navbar-fixed {
            position: relative;
            -webkit-animation: none;
            animation: none;
            box-shadow: none;
        }

        .logo {
            padding: 13px 0;
        }

        .logo img {
            height: 40px;
        }

        /* Navigation breakpoint */
        .navbar-toggle {
            display: block;
            z-index: 1;
        }

        .navbar-collapse {
            border-top: 1px solid transparent;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        ul.navbar-nav {
            float: none !important;
            margin-top: 7.5px;
        }

        ul.navbar-nav>li {
            float: none;
            display: block;
        }

        .collapse.in {
            display: block !important;
        }

        .navbar-collapse.in {
            overflow-y: auto;
        }

        ul.nav li.dropdown:hover ul.dropdown-menu {
            display: none;
        }

        ul.nav li.dropdown.open ul.dropdown-menu {
            display: block;
        }

        .navbar-nav .open .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
            border: 0;
            box-shadow: none;
        }

        /* Navigation */
        .navbar-collapse {
            background: none;
            width: 100%;
        }

        ul.navbar-nav>li:hover>a:after,
        ul.navbar-nav>li.active>a:after {
            content: "";
        }

        ul.navbar-nav>li>a:before {
            border-bottom: 0;
        }

        .navbar-nav .open .dropdown-menu>li {
            padding-left: 0;
        }

        .navbar-nav .open .dropdown-menu>li>a,
        .navbar-nav .open .dropdown-menu .dropdown-header {
            padding: 5px 15px 10px 10px;
        }

        ul.navbar-nav>li,
        .nav-style-boxed ul.navbar-nav>li {
            display: block;
        }

        .navbar-nav .open .dropdown-menu>li>a {
            line-height: 30px;
        }

        ul.navbar-nav>li.nav-search,
        ul.navbar-nav>li.header-get-a-quote {
            display: none;
        }

        ul.navbar-nav {
            width: 100%;
            padding: 0 0 10px;
        }

        ul.navbar-nav li {
            float: none;
        }

        ul.navbar-nav li a {
            line-height: normal !important;
            color: #333;
            border-bottom: 0;
            padding: 10px 0;
            display: block;
            min-width: 350px;
        }

        /* Sidebar */
        .sidebar-right {
            margin-top: 50px;
        }

        .sidebar-right .widget {
            margin-left: 0;
        }

        /* Footer */
        .footer-widget {
            display: inline-block;
            margin-bottom: 30px;
        }

        .footer-info-contents-content {
            padding: 50px 100px 0;
        }

        #back-to-top.affix {
            bottom: 78px;
        }
    }

    /* Small Devices Potrait */
    @media (max-width: 767px) {
        .boxed-layout .body-inner {
            margin: 0 auto;
        }

        /* Top bar */
        .top-nav-date {
            padding: 0;
            border-right: 0;
            display: block;
        }

        .top-nav {
            display: block;
            margin: 10px 0;
        }

        .top-navigation {
            text-align: center;
        }

        .top-nav-social-lists {
            float: none;
            text-align: center;
            display: inline-block;
        }

        /* Header */
        .navbar-fixed {
            position: relative;
            -webkit-animation: none;
            animation: none;
            box-shadow: none;
        }

        .logo {
            padding: 13px 0 25px;
            text-align: center;
        }

        .logo img {
            height: 40px;
        }

        /* Navigation */
        /* Search */
        .nav-search {
            position: absolute;
            top: 15px;
            right: 20px;
        }

        .search-block {
            width: 220px;
        }

        .header.header-menu {
            position: relative;
            margin-bottom: 20px;
        }

        .search-area {
            position: absolute;
            right: 0;
            top: 50px;
        }

        .post-title {
            font-size: 18px;
            line-height: 26px;
        }

        /* Sidebar */
        .sidebar-right {
            margin-top: 50px;
        }

        .sidebar-right .widget {
            margin-left: 0;
        }

        .social-icon li a i {
            margin-bottom: 10px;
        }

        .post-block-wrapper.post-float-half .post-thumbnail img {
            max-width: 100%;
            min-height: 100%;
            margin-bottom: 20px;
        }

        /* Footer */
        .footer-widget {
            display: inline-block;
            margin-bottom: 30px;
        }

        .footer-info-contents-content {
            padding: 50px 20px 0;
        }

        .footer-social-icons li a i {
            margin-bottom: 10px;
        }

        #back-to-top.affix {
            bottom: 78px;
        }

        /* Copyright */
        .copyright-text {
            text-align: center;
        }

        .footer-menu {
            float: none;
            text-align: center;
        }

        #back-to-top.affix {
            bottom: 0;
            right: 20px;
        }

        /* Block title */
        .news-style-two .nav-tabs>li>a {
            font-size: 12px;
        }

        /* Category style */
        .category-style2 .post-thumbnail {
            margin-bottom: 20px;
        }
    }

    /*# sourceMappingURL=style.css.map */



    .logo_img_size {
        height: 100%;
        width: -webkit-fill-available;
    }

    .footer_logo_img_size {
        height: 73px;
        width: 159px;
    }

    #attach_img_size {
        width: 90%;
        max-width: 600px;
    }

</style>
