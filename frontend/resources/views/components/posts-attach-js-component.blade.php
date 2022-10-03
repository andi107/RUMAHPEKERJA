<script>
    /** Variables */
    let files = []
        , dragArea = document.querySelector('.drag-area')
        , input = document.querySelector('.drag-area input')
        , button = document.querySelector('.card button')
        , select = document.querySelector('.drag-area .select')
        , container = document.querySelector('.container');

    /** CLICK LISTENER */
    select.addEventListener('click', () => input.click());

    // function filePush(isFIle) {
    //     for (let i = 0; i < isFIle.length; i++) {
    //         console.log('filePush',i)
    //         if (isFIle[i].type.split("/")[0] != 'image') continue;
    //         if (!files.some(e => e.name == isFIle[i].name)) files.push(isFIle[i])
    //     }
    // }

    function save() {
        let url = "{{ route('adm.post-tmp-save') }}";
        var imgattach = $('#imgattach')[0].files[0];
        console.log(imgattach)
        var fd = new FormData();
        let tmp_id = $("input[name=tmp_id]").val();
        fd.append('_token', $("input[name=_token]").val());
        fd.append('imgattach', imgattach);
        fd.append('tmp_id', tmp_id);
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
                    if (typeof(res.data.id) !== 'undefined') {
                        // filePush(file)
                        showImages(res.data,tmp_id);
                    }
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
                $(".submitBtn").removeAttr("disabled");
            }
        });
    }

    /* INPUT CHANGE EVENT */
    input.addEventListener('change', () => {
        // let file = input.files;
        // if (file.length == 0) return;
        save();
    });

    /* DROP EVENT */
    // dragArea.addEventListener('drop', e => {
    //     e.preventDefault()
    //     dragArea.classList.remove('dragover');
    //     // let file = e.dataTransfer.files;
    //     console.log('TES')
    //     save();
    // });

    /** SHOW IMAGES */
    function showImages(res = null,tmp_id) {
        console.log(res)
        // container.innerHTML = files.reduce((prev, curr, index) => {
            // if (res == null) {
            //     return `${prev}
            //     <div class="image">
            //         <span onclick="delImage(${index})">&times;</span>
            //         <img src="${URL.createObjectURL(curr)}" />
            //     </div>`;
            // } else {
        let fileName = "{{ route('image-view', ['@folder','@ext','@name']) }}";
        fileName = fileName.replace('@folder',res.ftfolder);
        fileName = fileName.replace('@ext',res.ftext);
        fileName = fileName.replace('@name',res.ftname);
        console.log('filename',fileName)
        // return `${prev}
        // <div class="image">
        //     <button type="button" onclick="urlCopy('imgattach_${res.id}')">Copy Url</button>
        //     <input type="hidden" name="imgattach_${res.id}" value="${fileName}">
        //     <span onclick="delImage(${index})">&times;</span>
        //     <img src="${URL.createObjectURL(curr)}" />
        // </div>`;
        $( ".container" ).append(`<div class="image" id="${res.id}">
            <button type="button" onclick="urlCopy('imgattach_${res.id}')">Salin Url</button>
            <input type="hidden" name="imgattach_${res.id}" value="${fileName}">
            <span onclick="delImage('${res.id}','${res.ftname}','${tmp_id}');">&times;</span>
            <img src="${fileName}" />
        </div>`);
            // }
        // }, '');
    }

    function urlCopy(e) {
        var contentToCopy = $("input[name=" + e + "]").val();
        navigator.clipboard.writeText(contentToCopy).then(function() {
            $('strong.me-auto').text('PEMBERITAHUAN');
            $('div.toast-body').text('Url Lampiran tersalin ke papan klip.');
            toast.show();
        }, function(err) {
            console.error('Unable to copy with async ', err);
        });
    }

    /* DELETE IMAGE */
    function delImage(id,fileName,tmp_id) {
        $('#' + id).remove();
        // files.splice(index, 1);
        // showImages();
        // let url = "{{ route('adm.post-tmp-save') }}";
        // var fd = new FormData();
        // fd.append('_token', $("input[name=_token]").val());
        // fd.append('file_id', id);
        // fd.append('file_name', fileName);
        // fd.append('tmp_id', tmp_id);
        // $.ajax({
        //     type: 'POST'
        //     , url: url
        //     , data: fd
        //     , dataType: 'json'
        //     , contentType: false
        //     , cache: false
        //     , processData: false
        //     , beforeSend: function() {
        //         $('.submitBtn').attr("disabled", "disabled");
        //         $('#formPosts').css("opacity", ".5");
        //     }
        //     , success: function(res) {
        //         console.log(res)
        //         // let msg = '';
        //         // if (res.code == 200) {
        //         //     if (typeof(res.data.id) !== 'undefined') {
        //         //         // filePush(file)
        //         //         $('#' + id).remove();
        //         //     }
        //         //     if (res.data.msg) {
        //         //         msg = res.data.msg;
        //         //     } else {
        //         //         msg = res.msg;
        //         //     }
        //         // } else {
        //         //     msg = res.msg;
        //         // }
        //         // $('strong.me-auto').text('PEMBERITAHUAN');
        //         // $('div.toast-body').text(msg);
        //         // toast.show();

        //         $('#formPosts').css("opacity", "");
        //         $(".submitBtn").removeAttr("disabled");
        //     }
        // });
    }

    // /* DRAG & DROP */
    // dragArea.addEventListener('dragover', e => {
    //     e.preventDefault()
    //     dragArea.classList.add('dragover')
    // })

    // /* DRAG LEAVE */
    // dragArea.addEventListener('dragleave', e => {
    //     e.preventDefault()
    //     dragArea.classList.remove('dragover')
    // });

</script>
