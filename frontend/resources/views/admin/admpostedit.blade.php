<x-adm-base-layout>
    <x-slot name="titleSlot">
        <title>Posting Edit | RPH Admin</title>
        <x-posts-css-component />
        <x-posts-attach-css-component />
    </x-slot>
    <div class="row">
        <div class="col">
            <h5>EDIT POST</h5>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3">
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
    <div class="text-muted">
        <input type="text" name="tittle_url" class="form-control" disabled value="{{ route('post-detail',[
            $res_edit->data->fttitle_url.'@'.
            $res_edit->data->ftuniq
        ]) }}">
    </div>
    <form action="" method="POST" id="formPosts" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_id" value="{{ $res_edit->data->ftuniq }}">
        <input type="hidden" name="baner_name" value="{{ $res_edit->banerdata->ftname }}">
        <input type="hidden" name="baner_ext" value="{{ $res_edit->banerdata->ftext }}">
        <input type="hidden" name="tmp_id" value="{{ $res_edit->data->uuid_tmp_id }}">
        <div class="row gutters pt-4">
            <div class="col col-lg">
                <div class="form-floating mb-3">
                    <input maxlength="255" type="text" class="form-control" name="txtTitle" id="txtTitle" placeholder="Judul..." value="{{ $res_edit->data->fttitle }}">
                    <label for="txtTitle">Judul</label>
                </div>
                <div class="form-floating">
                    <textarea maxlength="255" onkeydown="noreturnkey(event)" class="form-control" name="txtDescription" id="txtDescription" placeholder="Deskripsi..." style="height: 100px">{{ $res_edit->data->ftdescription }}</textarea>
                    <label for="txtDescription">Deskripsi</label>
                </div>
            </div>
        </div>
        <div class="row gutters pt-4">
            <div class="col-sm-6 col-md-8">
                <textarea name="txtbody" id="txtbody" rows="10" cols="80" placeholder="Tuliskan apa yang terjadi?">{{ $res_edit->data->ftbody }}</textarea>
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
                                    <button type="submit" class="btn btn-outline-success">SIMPAN</button>
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
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt">Klik atau jatuhkan file gambar di sini</span>
                                    <input type="file" name="mybaner" id="mybaner" accept=".jpg, .jpeg, .png" class="drop-zone__input">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Lampiran Gambar
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <div class="card">
                                        <div class="drag-area">
                                            <span class="visible">
                                                <span class="select" role="button">Upload Lampiran</span>
                                            </span>
                                            <span class="on-drop">Drop images here</span>
                                            <input id="imgattach" name="imgattach" type="file" class="file" accept=".jpg, .jpeg, .png" />
                                        </div>
                                        <div class="container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingEmpat">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#panelsStayOpen-collapseEmpat" aria-expanded="false" aria-controls="panelsStayOpen-collapseEmpat">
                                    Penerbit
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseEmpat" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingEmpat">
                                <div class="accordion-body">
                                    <div class="form-floating mb-3" id="dtpublish">
                                        <input type="text" class="form-control" id="publish_date" name="publish_date" placeholder="Tanggal">
                                        <label for="publish_date">Tanggal Publish</label>
                                    </div>
                                    <label for="selpublisher mt-3" style="width: 100%">
                                        Pilih Nama Penerbit
                                        <select class="form-select selpublisher js-states" style="width: 100%" name="selpublisher" id="selpublisher">
                                            @foreach ($user_select->data as $r)
                                                <option value="{{$r->username}}">{{ $r->ftfirst_name.' '.$r->ftlast_name.' - @'.$r->username }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <div class="mt-3">
                                        <button type="button" onclick="_publish();" class="btn btn-outline-warning submitPublish">TERBITKAN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="modalDelImg" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lampiran akan di hapus permanen. Ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">TIDAK</button>
                    <button type="submit" class="btn btn-primary" onclick="yesDelImage()">YA</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function picimg(inputElement) {
            const dropZoneElement = inputElement.closest(".drop-zone");
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
            thumbnailElement.dataset.label = `{{ $res_edit->banerdata->ftname .'.'. $res_edit->banerdata->ftext }}`;
            thumbnailElement.style.backgroundImage = `url('{{ route('image-view', [$res_edit->banerdata->ftfolder,$res_edit->banerdata->ftext,$res_edit->banerdata->ftname]) }}')`;
        };
    </script>
    <x-posts-js-component />
    <x-posts-attach-js-component />
</x-adm-base-layout>
