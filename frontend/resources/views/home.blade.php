<x-base-layout>
    <x-slot name="titleSlot">
        {!! $seometa::generate() !!}
        {!! $opengraph::generate() !!}
        {{-- {!! Twitter::generate() !!} --}}
        {!! $jsonld::generate() !!}
    </x-slot>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="block category-listing category-style2">
                        <h1 class="news-title">
                            <span>Terbaru</span>
                        </h1>
                        @foreach ($res->data as $key => $r)
                        <div class="post-block-wrapper post-list-view clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-6">
                                    <div class="post-thumbnail thumb-float-style">
                                        <a href="{{ route('post-detail',[$r->fttitle_url.'@'.$r->ftuniq]) }}">
                                            <img class="img-fluid lazy" data-original="{{route('image-view', [$r->ftgalery_folder,$r->ftgalery_ext,$r->ftgalery_name])}}" alt="{{$r->fttitle}}"/>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-6">
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span>
                                                <i class="fa-regular fa-clock"></i>
                                                @php
                                                    $isNow = $carbon::now();
                                                    $publicDate = $carbon::parse($r->published_at);
                                                    if ($publicDate->diffInDays($isNow) >= 5) {
                                                        echo $carbon::createFromFormat('Y-m-d H:i:s', $publicDate)->formatLocalized('%d %B %Y').' WIB';
                                                    }else{
                                                        echo $carbon::createFromTimeStamp(strtotime($publicDate))->diffForHumans();
                                                    }
                                                @endphp
                                            </span>

                                            <span class="post-author">
                                                <i class="fa-regular fa-user"></i>
                                                <a href="{{ route('user-profile',['@'.$r->published_by, strtolower($r->published_first_name.'-'.$r->published_last_name)]) }}" class="text-dark">
                                                    {{ $r->published_by }}
                                                </a>
                                            </span>
                                        </div>
                                        <h2 class="post-title">
                                            <a href="{{ route('post-detail',[$r->fttitle_url.'@'.$r->ftuniq]) }}">
                                                {{ $r->fttitle }}
                                            </a>
                                        </h2>

                                        <p>
                                            {{ $hlp::string_limit($r->ftdescription,165) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <nav aria-label="pagination-wrapper" class="pagination-wrapper">
                        <ul class="pagination justify-content-center">
                            @foreach ($res->links as $key => $link)
                            @if ($key == 0)
                            <li class="page-item">
                                <a class="page-link" href="{{ $res->prev_page_url }}" aria-label="Previous">
                                    <span aria-hidden="true"><i class="fa fa-angle-double-left mr-2"></i></span>
                                    <span class="">Sebelumnya</span>
                                </a>
                            </li>
                            @elseif ($key == (count($res->links)-1))
                            <li class="page-item">
                                <a class="page-link" href="{{ $res->next_page_url }}" aria-label="Next">
                                    <span class="">Berikutnya</span>
                                    <span aria-hidden="true"><i class="fa fa-angle-double-right ml-2"></i></span>
                                </a>
                            </li>
                            @else
                            {{-- <li class="page-item"><a class="page-link" href="#">1</a></li> --}}
                            <li class="page-item {{ $link->active ? 'active' : '' }}">
                                <a class="page-link" href="{{ $link->url }}">{{ $link->label }}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>

                <x-sidebar-right-component />
            </div>
        </div>
    </section>

    <div class="py-40"></div>
</x-base-layout>
