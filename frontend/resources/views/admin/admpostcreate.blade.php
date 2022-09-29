<x-adm-base-layout>
    <x-slot name="titleSlot">
        <title>Posting Baru | RPH Admin</title>
        <x-posts-css-component />
    </x-slot>
    <div class="row">
        <div class="col">
            <h5>POST BARU</h5>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg class="icon me-2">
                    <use xlink:href="{{asset('adm/vendors/@coreui/icons/svg/free.svg#cil-warning')}}"></use>
                </svg>
                <strong class="me-auto"></strong>
                {{-- <small>11 mins ago</small> --}}
                <button type="button" class="btn-close" data-coreui-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ...
            </div>
        </div>
    </div>
    <form action="" method="POST" id="formPosts" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_id" value="new">
        <input type="hidden" name="baner_name">
        <input type="hidden" name="baner_ext">
        <div class="row gutters pt-4">
            <div class="col col-lg">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="txtTitle" id="txtTitle" placeholder="Judul...">
                    <label for="txtTitle">Judul</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="txtDescription" id="txtDescription" placeholder="Deskripsi..." style="height: 100px"></textarea>
                    <label for="txtDescription">Deskripsi</label>
                </div>
            </div>
        </div>
        <div class="row gutters pt-4">
            <div class="col-sm-6 col-md-8">
                <textarea name="txtbody" id="txtbody" rows="10" cols="80" placeholder="Tuliskan apa yang terjadi?"></textarea>
            </div>
            <div class="col-6 col-md-4">
                <div class="row">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-coreui-toggle="collapse" data-coreui-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    AKSI
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <button type="submit" class="btn btn-outline-success submitBtn">SIMPAN</button>
                                    <button type="button" class="btn btn-info">PREVIEW</button>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Thumbnail [1000x529 Pixel]
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <div class="drop-zone">
                                        <span class="drop-zone__prompt">Klik atau jatuhkan file gambar di sini</span>
                                        <input type="file" name="mybaner" id="mybaner" accept=".jpg, .jpeg, .png" class="drop-zone__input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <x-posts-js-component />
</x-adm-base-layout>