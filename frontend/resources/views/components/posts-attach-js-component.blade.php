<script>
    let files = []
        , dragArea = document.querySelector('.drag-area')
        , input = document.querySelector('.drag-area input')
        , button = document.querySelector('.card button')
        , select = document.querySelector('.drag-area .select')
        , container = document.querySelector('.container')
        , isId = $("input[name=_id]").val();
        
    select.addEventListener('click', () => input.click());

    function save() {
        let url = "{{ route('adm.post-tmp-save') }}";
        var imgattach = $('#imgattach')[0].files[0];
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

    input.addEventListener('change', () => {
        save();
    });

    function showImages(res = null,tmp_id) {
        let fileName = "{{ route('image-view', ['@folder','@ext','@name']) }}";
        fileName = fileName.replace('@folder',res.ftfolder);
        fileName = fileName.replace('@ext',res.ftext);
        fileName = fileName.replace('@name',res.ftname);
        $( ".container" ).append(`<div class="image" id="${res.id}">
            <button type="button" onclick="urlCopy('imgattach_${res.id}')">Salin Url</button>
            <input type="hidden" name="imgattach_${res.id}" value="${fileName}">
            <span onclick="delImage('${res.id}','${res.ftname}','${tmp_id}','${res.ftfolder}','${res.ftext}');">&times;</span>
            <img src="${fileName}" />
        </div>`);
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

    var _tmpDel = [];

    function delImage(id,fileName,tmp_id,folder,ext) {
        _tmpDel.push({
            'id': id,
            'fileName': fileName,
            'tmp_id': tmp_id,
            'folder': folder,
            'ext': ext
        });
        $('#modalDelImg').modal('show');
    }

    function yesDelImage() {
        // files.splice(index, 1);
        // showImages();
        let url = "{{ route('adm.post-attach-del') }}";
        var fd = new FormData();
        fd.append('_token', $("input[name=_token]").val());
        fd.append('id', _tmpDel[0].id);
        fd.append('file_name', _tmpDel[0].fileName);
        fd.append('tmp_id', _tmpDel[0].tmp_id);
        fd.append('folder', _tmpDel[0].folder);
        fd.append('ext', _tmpDel[0].ext);
        
        console.log(_tmpDel)
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
                let msg = '';
                if (res.code == 200) {
                    if (typeof(res.data.id) !== 'undefined') {
                        console.log(res.data.id, _tmpDel)
                        $('#' + res.data.id).remove();
                        $('#modalDelImg').modal('hide');
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
        _tmpDel = [];
    }

    function loadAttach() {
        $.get('{{ route("adm.post-edit-index-attach")."?uniq=" }}' + isId, function(res){
            if (res.data.attachdata) {
                res.data.attachdata.forEach(e => {
                    showImages(e,isId)
                });
            }
        });
    }
    $(document).ready(function() {
        loadAttach();
    });

</script>
