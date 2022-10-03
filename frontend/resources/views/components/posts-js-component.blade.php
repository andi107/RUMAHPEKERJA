<script src="{{ asset('cke/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('txtbody');

    const toastLiveExample = document.getElementById('liveToast')
    const toast = new coreui.Toast(toastLiveExample)

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
                let resBody = CKEDITOR.instances.txtbody.getData();
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
                fd.append('status', 1);
                if (isType !== 'new') {
                    fd.append('baner_name',$("input[name=baner_name]").val());
                    fd.append('baner_ext',$("input[name=baner_ext]").val());
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
                        // console.log(res)
                        let msg = '';
                        if (res.code == 200) {
                            if (typeof(res.data.ftuniq) === 'undefined') {
                                $("input[name=_id]").val(res.data.id);
                            }else{
                                $("input[name=_id]").val(res.data.ftuniq);
                                if (isType == 'new') {
                                    setInterval(function() {
                                        _save()
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
                            $("input[name=_id]").val('new');
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

</script>
