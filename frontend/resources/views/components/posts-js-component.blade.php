<script src="{{ asset('cke/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('txtbody');

    // CKEDITOR.on('dialogDefinition', function(ev) {
    //     var dialogName = ev.data.name;
    //     var dialogDefinition = ev.data.definition;
    //     var editor = ev.editor;
    //     console.log('dialogName', dialogName, ev);
    //     if (dialogName == 'image2') {
    //         dialogDefinition.onOk = function(e) {
    //             console.log('e',e,'e.sender',e.sender)
    //             // var imageSrcUrl = e.sender.originalElement.$.src
    //             //     , imageWidth = e.sender.originalElement.$.width
    //             //     , imageHeight = e.sender.originalElement.$.height
    //             //     , imageAlt = e.sender.originalElement.$.alt;
    //             // // console.log(imageWidth, imageHeight) //width='" + imageWidth + "' height='"+ imageHeight +"'
    //             // editor.insertElement(CKEDITOR.dom.element.createFromHtml("<img id='attach_img_size' src='" + imageSrcUrl + "' alt='" + imageAlt + "'>"));
    //         };
    //     }
    // })



    // <div class="wrap-pic-max-w p-b-30"><img alt="" src="http://localhost:8000/imgview/postattachment/png/c40ecfdb-b545-4442-9b01-e0bdbcee47a8"></div>

    const toastLiveExample = document.getElementById('liveToast');
    const toast = new coreui.Toast(toastLiveExample);

    $(document).ready(
        function() {
            $('#formPosts').submit(
                function(e) {
                    e.preventDefault();
                    _save();
                }
            );
            var isCtrl = false;
            document.onkeyup = function(e) {
                if (e.keyCode == 17) isCtrl = false;
            }

            document.onkeydown = function(e) {
                if (e.keyCode == 17) isCtrl = true;
                if (e.keyCode == 83 && isCtrl == true) {
                    _save();
                    return false;
                }
            }


            function _save() {
                let url = "{{ route('adm.post-save') }}";

                // var editor = CKEDITOR.instances.txtbody.getData()
                // CKEDITOR.instances.txtbody.setData(editor.replace(/<img>/gi, "<img class='thiny_p'>"));
                // editor.text(editor.val())

                let resBody = CKEDITOR.instances.txtbody.getData();
                // console.log(resBody)
                let isType = $("input[name=_id]").val();

                var fd = new FormData();
                var mybaner = $('#mybaner')[0].files[0];
                fd.append('mybaner', mybaner);
                fd.append('_token', $("input[name=_token]").val());
                fd.append('type', isType);
                fd.append('title', $("input[name=txtTitle]").val());
                fd.append('body', resBody);
                fd.append('description', $.trim($("#txtDescription").val()));
                fd.append('category', 1);
                fd.append('status', 2);
                if (isType !== 'new') {
                    fd.append('baner_name', $("input[name=baner_name]").val());
                    fd.append('baner_ext', $("input[name=baner_ext]").val());
                }
                fd.append('tmp_id', $("input[name=tmp_id]").val());

                $.ajax({
                    type: 'POST'
                    , url: url
                    , data: fd
                    , dataType: 'json'
                    , contentType: false
                    , cache: false
                    , processData: false
                    , beforeSend: function() {
                        $('.submitBtn').attr("disabled", "disabled");
                        $('#formPosts').css("opacity", ".5");
                    }
                    , success: function(res) {
                        console.log(res)
                        let msg = '';
                        if (res.code == 200) {
                            if (typeof(res.data.ftuniq) === 'undefined') {
                                $("input[name=_id]").val(res.data.id);
                            } else {
                                $("input[name=_id]").val(res.data.ftuniq);
                                let tittle_url = "{{ route('post-detail',['@id@@tittle_url']) }}";
                                tittle_url = tittle_url.replace('@id', res.data.ftuniq);
                                tittle_url = tittle_url.replace('@tittle_url', res.data.fttitle_url);
                                $("input[name=tittle_url]").val(tittle_url);
                                if (isType == 'new') {
                                    setInterval(function() {
                                        _save();
                                    }, 300000);
                                }
                            }
                            if (!typeof(res.dataBaner) === 'undefined') {
                                $("input[name=baner_name]").val(res.dataBaner.baner_id);
                                $("input[name=baner_ext]").val(res.dataBaner.ext);
                            }
                            if (res.data.msg) {
                                msg = res.data.msg;
                            } else {
                                msg = res.msg;
                            }
                        } else {
                            // $("input[name=_id]").val('new');
                            msg = res.msg;
                        }
                        $('strong.me-auto').text('PEMBERITAHUAN');
                        $('div.toast-body').text(msg);
                        toast.show();

                        $('#formPosts').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            }
        }
    );
    
    function noreturnkey(event) {
        var x = event.which || event.keyCode;
        if (x == '13') event.preventDefault();
    }

    function _publish() {
        let url = "{{ route('adm.post-publish') }}";
        var fd = new FormData();
        fd.append('_token', $("input[name=_token]").val());
        fd.append('id', $("input[name=_id]").val());
        fd.append('selpublisher', $("#selpublisher").val());
        fd.append('publish_date', $("input[name=publish_date]").val());
        console.log($("#selpublisher").val());
        $.ajax({
            type: 'POST'
            , url: url
            , data: fd
            , dataType: 'json'
            , contentType: false
            , cache: false
            , processData: false
            , beforeSend: function() {
                $('.submitPublish').attr("disabled", "disabled");
                $('#formPosts').css("opacity", ".5");
            }
            , success: function(res) {
                console.log(res)
                let msg = '';
                if (res.code == 200) {



                    if (res.data.msg) {
                        msg = res.data.msg;
                    } else {
                        msg = res.msg;
                    }
                } else {
                    msg = res.msg;
                }
                $('strong.me-auto').text('PEMBERITAHUAN');
                $('div.toast-body').text(msg);
                toast.show();

                $('#formPosts').css("opacity", "");
                $(".submitPublish").removeAttr("disabled");
            }
        });
    }

    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        let isType = $("input[name=_id]").val();
        if (isType !== 'new') {
            picimg(inputElement);
        }
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }
        thumbnailElement.dataset.label = file.name;
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }

    $('#dtpublish input').datepicker({
        format: "dd-mm-yyyy"
        , todayHighlight: true
        , language: "id"
        , autoclose: true
    , });

</script>
