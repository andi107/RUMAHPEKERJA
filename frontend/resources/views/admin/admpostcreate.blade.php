<x-adm-base-layout>
    <x-slot name="titleSlot">
        <title>RPH Admin - Posting Baru</title>
    </x-slot>
    <div class="row">
        <div class="col">
            <h5>POST BARU</h5>
        </div>
    </div>
    <div class="row gutters pt-4">
        <div class="col col-lg">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="txtTitle" id="txtTitle" placeholder="Judul...">
                <label for="txtTitle">Judul</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-8">
            <textarea name="txtbody" id="txtbody" rows="10" cols="80" placeholder="Tuliskan apa yang terjadi?"></textarea>
        </div>
        <div class="col-6 col-md-4">
            <div class="row">
asd
            </div>
        </div>
    </div>
    
    <script src="{{ asset('cke/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('txtbody');
    </script>
</x-adm-base-layout>
