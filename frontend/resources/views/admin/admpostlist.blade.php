<x-adm-base-layout>
    <x-slot name="titleSlot">
        <title>Post | RPH Admin</title>
    </x-slot>
    
    <div class="row">
        <div class="col">
            <h5>POST</h5>
        </div>
        <div class="col-md-auto">
            <a href="{{route('adm.post-create-index')}}" class="btn btn-light">
                Post Baru
            </a>
        </div>
        {{-- cil-library-add --}}
        <div class="col col-lg-2">
            <form method="GET" action="{{ route('adm.post-list-index') }}">
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
                        <th>JUDUL</th>
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
                                    <p>{{ $r->fttitle }}</p>
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

    <script>
        
    </script>
</x-adm-base-layout>
