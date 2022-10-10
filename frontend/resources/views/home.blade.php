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
                                <div class="col-lg-6 col-md-6">
                                    <div class="post-block-wrapper post-float-half clearfix">
                                        <div class="post-thumbnail">
                                            <a href="#">
                                                <img class="img-fluid lazy" data-original="{{asset('src/images/news/news-01.jpg')}}" alt="post-thumbnail" />
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <a class="post-category" href="#">Google</a>
                                            <h2 class="post-title mt-3">
                                                <a href="#">Ex-Googler warns coding bootcamps are lacking</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="posted-time">an hour ago</span>
                                                <span class="post-author">by
                                                    <a href="#">John Snow</a>
                                                </span>
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel eaque, aliquid accusamus
                                                soluta!...
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <nav aria-label="pagination-wrapper" class="pagination-wrapper">
                        <ul class="pagination justify-content-center">
                            @foreach ($res->links as $key => $link)
                                @if ($key == 0)
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fa fa-angle-double-left mr-2"></i></span>
                                            <span class="">Previous</span>
                                        </a>
                                    </li>
                                @elseif ($key == (count($res->links)-1))
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $res->next_page_url }}" aria-label="Next">
                                            <span class="">Next</span>
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
                <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12">
                    <div class="sidebar sidebar-right">
                        <div class="widget">
                            <h3 class="news-title">
                                <span>TERPOPULER</span>
                            </h3>
                            <div class="post-list-block">
                                <div class=" review-post-list">
                                    <div class="top-author">
                                        <img class="lazy" data-original="{{asset('src/images/news/author-01.jpg')}}" alt="author-thumb">
                                        <div class="info">
                                            <h4 class="name"><a href="author.html">Jack Rockshow</a></h4>
                                            <ul class="list-unstyled">
                                                <li>37 Posts</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="top-author">
                                        <img class="lazy" data-original="{{asset('src/images/news/author-02.jpg')}}" alt="author-thumb">
                                        <div class="info">
                                            <h4 class="name"><a href="author.html">Lint Handson</a></h4>
                                            <ul class="list-unstyled">
                                                <li>28 Posts</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="top-author">
                                        <img class="lazy" data-original="{{asset('src/images/news/author-03.jpg')}}" alt="author-thumb">
                                        <div class="info">
                                            <h4 class="name"><a href="author.html">Ronny Robeen</a></h4>
                                            <ul class="list-unstyled">
                                                <li>19 Posts</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="top-author">
                                        <img class="lazy" data-original="{{asset('src/images/news/author-02.jpg')}}" alt="author-thumb">
                                        <div class="info">
                                            <h4 class="name"><a href="author.html">Handson</a></h4>
                                            <ul class="list-unstyled">
                                                <li>18 Posts</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="py-40"></div>
</x-base-layout>
