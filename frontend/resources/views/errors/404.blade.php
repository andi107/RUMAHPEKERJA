<x-base-layout>
    <x-slot name="titleSlot">

    </x-slot>

    <section class="error-404 section-padding">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="error-block ">
                        <div class="throw-code">
                            <h2>
                                404
                            </h2>
                        </div>
                        <div class="error-info">
                            <h2 class="mb-2">Sepertinya Anda tersesat!</h2>
                            <p class="mb-5">Halaman yang Anda cari tidak tersedia.</p>
                            <a href="{{route('home')}}">Kembali ke beranda <i class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="broken-img mt-5 mt-lg-0">
                        <img src="{{asset('src/images/broken.png')}}" alt="error_img" class="img-fluid">
                    </div> 
                </div>
            </div>
        </div>
    </section>
</x-base-layout>