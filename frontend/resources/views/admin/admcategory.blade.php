<x-adm-base-layout>
    <x-slot name="titleSlot">
        <title>Kategori | RPH Admin</title>
    </x-slot>
    
        
    {{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}

    {{-- <table id="myTable">
        <tr class="header">
            <th style="width:60%;">Name</th>
            <th style="width:40%;">Country</th>
        </tr>
        
        @foreach (range(1029, 1050) as $number)
        <tr>
            <td>{{ $number }}</td>
    <td>Germany</td>
    </tr>
    @endforeach
    </table> --}}
    @if (!isset($error))
    <div class="row">
        <div class="col">
            <h5>KATEGORI</h5>
        </div>
        <div class="col-md-auto">
            <a href="javascript:add()" class="btn btn-light">
                Kategori Baru
            </a>
        </div>
        {{-- cil-library-add --}}
        <div class="col col-lg-2">
            <form method="GET" action="{{ route('adm.category') }}">
                <input type="text" class="form-control" placeholder="Search" aria-describedby="btSearch" name="filter" value="{{ $qsearch }}">
            </form>
        </div>
    </div>
    <div class="row gutters pt-4">
        <div class="col col-lg">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAMA</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($res->data as $key => $r)
                    <tr>
                        <td>{{ $firstrow++ }}</td>
                        <td>
                            <div>
                                <div>
                                    <p>{{ $r->ftname }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ApiH::statusForm($r->fnstatus) }} text-white rounded-2">{{ \ApiH::statusForm2($r->fnstatus) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="actions action-btn-table">
                                <a href="javascript:edit('{{ $key + 1 }}')" class="btn btn-ghost-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit">
                                    Edit
                                </a>
                            </div>
                        </td>
                        <input type="hidden" value="{{ $r->id }}">
                        <input type="hidden" value="{{ $r->ftdescription }}">
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row gutters pt-2">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <label class="light-bg ps-3 pe-3 pt-2 pb-2"> Showing {{ $res->from }} to
                {{ $res->to }} of {{ $res->total }} entries</label>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    @foreach ($res->links as $key => $link)
                    @if ($key == 0)
                    {{-- previous-page --}}
                    <li class="page-item {{ $res->prev_page_url == null ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $res->prev_page_url }}">Previous</a>
                    </li>
                    @elseif ($key == (count($res->links)-1))
                    {{-- next-page --}}
                    <li class="page-item {{ $res->next_page_url == null ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $res->next_page_url }}">Next</a>
                    </li>
                    @else
                    <li class="page-item {{ $link->active ? 'active' : '' }}"><a class="page-link" href="{{ $link->url }}">{{ $link->label }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKategori" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Kategori Baru</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formKategori" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" name="txtKategoriName" class="form-control" id="floatingInput" placeholder="Nama Kategori">
                            <label for="floatingInput">Nama Kategori</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="txtDescription" placeholder="Deskripsi" id="ftxtDescription" style="height: 150px"></textarea>
                            <label for="ftxtDescription">Deskripsi</label>
                        </div>
                        <br />
                        <select class="form-select" name="selStatus" aria-label="Status">
                            <option value="1">Active</option>
                            <option selected value="2">Draft</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <script>
        function onlyAlphaNumS(key, e) {
            var letters = /^[a-zA-Z0-9\s-]/g;
            if (!(key).match(letters)) e.preventDefault();
        }

        function onlyNum(key, e) {
            var letters = /^[0-9]/g;
            if (!(key).match(letters)) e.preventDefault();
        }

        function add(clear = true) {
            // $('.saveBtn').text('Save');
            $('.modal-title').text('Kategori Baru');
            $('#formKategori').attr('action', "{{ route('adm.category-create') }}");
            $("input[name='form_type']").val('create');
            $("input[name='_method']").val("POST");

            if (clear) {
                $("input[name='txtKategoriName']").val("");
                $("textarea[name='txtDescription']").val("");
                $("input[name='status_form'][value='1']").prop('checked', true);
            }

            $('#modalKategori').modal('show');
        }

        function edit(key, fresh = true) {
            var Table_1 = document.querySelectorAll("table > tbody > tr:nth-child(" + key + ") > td");
            var Table_2 = document.querySelectorAll("table > tbody > tr:nth-child(" + key + ") > input");

            var url = '{{ route("adm.category-update", ":id") }}';
            url = url.replace(':id', Table_2[0].value);

            // $('.saveBtn').text('Save Change');
            $('.modal-title').text('Ubah Kategori');
            $('#formKategori').attr('action', url);
            $("input[name='form_type']").val('edit');
            $("input[name='form_key']").val(key);
            $("input[name='_method']").val("PUT");

            if (fresh) {
                $("input[name='txtKategoriName']").val(Table_1[1].querySelector("div > div > p").innerHTML);
                console.log(Table_2[1].value)
                $("textarea[name='txtDescription']").val(Table_2[1].value);
                // $("input[name='status_form'][value=" + Table_2[1].value + "]").prop('checked', true);
            }

            $('#modalKategori').modal('show');
        }
        // function myFunction() {
        //     var input, filter, table, tr, td, i, txtValue;
        //     input = document.getElementById("myInput");
        //     filter = input.value.toUpperCase();
        //     table = document.getElementById("myTable");
        //     tr = table.getElementsByTagName("tr");
        //     for (i = 0; i < tr.length; i++) {
        //         td = tr[i].getElementsByTagName("td")[0];
        //         if (td) {
        //             txtValue = td.textContent || td.innerText;
        //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                 tr[i].style.display = "";
        //             } else {
        //                 tr[i].style.display = "none";
        //             }
        //         }
        //     }
        // }

    </script>
</x-adm-base-layout>
