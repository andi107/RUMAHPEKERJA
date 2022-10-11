<x-base-layout>
    <x-slot name="titleSlot">

    </x-slot>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="all-news-block">
                        <h3 class="news-title">
                            <span>Terbaru</span>
                        </h3>
                        <div class="all-news">
                            <div class="row">
                                @foreach ($res->data as $key => $r)
                                    <div class="post-list-block">
                                        <div class="post-block-wrapper post-float clearfix">
                                            <div class="post-thumbnail">
                                                <a href="{{ route('post-detail',[$r->fncategory,$r->ftuniq,$r->fttitle_url]) }}">
                                                    <img class="img-fluid lazy" data-original="{{route('image-view', [$r->ftgalery_folder,$r->ftgalery_ext,$r->ftgalery_name])}}" alt="{{$r->fttitle}}"/>
                                                </a>
                                            </div>
                
                                            <div class="post-content">
                                                <h2 class="post-title title-sm">
                                                    <a href="{{ route('post-detail',[$r->fncategory,$r->ftuniq,$r->fttitle_url]) }}">
                                                        {{ $r->fttitle }}
                                                    </a>
                                                </h2>
                                                <p class="lead">
                                                    {{ $hlp::string_limit($r->ftdescription,165) }}
                                                </p>
                                                <div class="post-meta">
                                                    <p class="text-muted">
                                                        Dipublikasikan 
                                                        @php
                                                            $isNow = $carbon::now();
                                                            $publicDate = $carbon::parse($r->updated_at);
                                                            if ($publicDate->diffInDays($isNow) >= 5) {
                                                                echo ' '.$carbon::createFromFormat('Y-m-d H:i:s', $r->updated_at)->formatLocalized('%d %B %Y');
                                                            }else{
                                                                echo ' '.$carbon::createFromTimeStamp(strtotime($r->updated_at))->diffForHumans();
                                                            }
                                                        @endphp
                                                    </p>
                                                    <span class="post-author">oleh
                                                        <a href="{{ route('user-profile',['@'.$r->published_by, 'administrator']) }}">{{ $r->published_by }}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
