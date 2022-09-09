<!DOCTYPE html>
<html lang="en">
<head>
    <title>RPH - Login</title>
    @if (config('app.env') === 'production')
        <link rel="stylesheet" href="{{ secure_asset('adm/vendors/simplebar/css/simplebar.css')}}">
        <link rel="stylesheet" href="{{ secure_asset('adm/css/vendors/simplebar.css')}}">
        <link href="{{ secure_asset('adm/css/style.css')}}" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{ asset('adm/vendors/simplebar/css/simplebar.css')}}">
        <link rel="stylesheet" href="{{ asset('adm/css/vendors/simplebar.css')}}">
        <link href="{{ asset('adm/css/style.css')}}" rel="stylesheet">
    @endif
</head>
<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    @if (isset($errLogin))
                    <div class="alert alert-danger mb-3" role="alert">
                        {{ $errLogin }}
                    </div>
                @endif
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Login</h1>
                                <p class="text-medium-emphasis">Masuk ke akun Anda</p>
                                <form action="{{ route('adm.login-submit') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                                            </svg></span>
                                        <input name="txtusername" class="form-control" type="text" placeholder="Username" required>
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('adm/vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                                            </svg></span>
                                        <input name="txtpassword" class="form-control" type="password" placeholder="Password" required>
                                    </div>
                                    {{-- <div class="input-group mb-3">
                                        <div class="form-check">
                                            <input name="ckremember" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            Ingat Saya
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Masuk</button>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-link px-0" type="button">Lupa kata sandi?</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>Sign up</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (config('app.env') === 'production')
        <script src="{{ secure_asset('adm/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
        <script src="{{ secure_asset('adm/vendors/simplebar/js/simplebar.min.js')}}"></script>
    @else
        <script src="{{ asset('adm/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
        <script src="{{ asset('adm/vendors/simplebar/js/simplebar.min.js')}}"></script>
    @endif
</body>
</html>
