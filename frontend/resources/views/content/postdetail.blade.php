<x-base-layout>
    <x-slot name="titleSlot">
        {!! $seometa::generate() !!}
        {!! $opengraph::generate() !!}
        {{-- {!! Twitter::generate() !!} --}}
        {!! $jsonld::generate() !!}
    </x-slot>

    <x-breadcrumb-component />

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-post">
                        <div class="post-header mb-5">
                            <a class="post-category" href="#">{{ $data->data->ftcategory_name }}</a>
                            <h1 class="post-title">
                                {{ $data->data->fttitle }}
                            </h1>
                            <p class="font-weight-light font-italic">{{$data->data->ftdescription}}</p>
                            <div class="post-meta">
                                <p>
                                    {{ $carbon::createFromFormat('Y-m-d H:i:s', $data->data->created_at)->formatLocalized('%A, %d %B %Y %H:%M:00').' WIB' }}
                                </p>
                                <span class="post-author">oleh
                                    <a href="{{ route('user-profile',['@'.$data->data->published_by, strtolower($data->data->published_first_name.'-'.$data->data->published_last_name)]) }}">{{ $data->data->published_by }}</a>
                                </span>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-featured-image text-center">
                                <img class="img-fluid lazy" data-original="{{route('image-view', [$data->dataBaner->ftfolder,$data->dataBaner->ftext,$data->dataBaner->ftname])}}" alt="{{ $data->data->fttitle_url }}" />
                            </div>
                            <div class="entry-content">
                                {!! $data->data->ftbody !!}
                            </div>

                            <div class="share-block d-flex justify-content-between align-items-center border-top border-bottom mt-5">
                                <div class="post-tags">
                                    <span>Tags</span>
                                    <a href="#">Dummy Tags1</a>
                                    <a href="#">Dummy Tags2</a>
                                    <a href="#">Dummy Tags3</a>
                                </div>

                                <ul class="share-icons list-unstyled">
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="gplus">
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="pinterest">
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                    </li>
                                    <li class="reddit">
                                        <a href="#">
                                            <i class="fa fa-reddit-alien"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <nav class="post-navigation clearfix">
                        <div class="previous-post">
                            <a href="#">
                                <h6 class="text-uppercase">Next</h6>
                                <h3>Intel’s new smart glasses actually look good</h3>
                            </a>
                        </div>
                        <div class="next-post">
                            <a href="#">
                                <h6 class="text-uppercase">Previous</h6>

                                <h3>Free Two-Hour Delivery From Whole Foods</h3>
                            </a>
                        </div>
                    </nav>
                    <div class="related-posts-block">
                        <h3 class="news-title">
                            <span>Related Posts</span>
                        </h3>
                        <div class="news-style-two-slide">
                            <div class="item">
                                <div class="post-block-wrapper clearfix">
                                    <div class="post-thumbnail mb-0">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('src/images/news/news-04.jpg')}}" alt="post-thumbnail" />
                                        </a>
                                    </div>
                                    <a class="post-category" href="#">Tech</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-sm">
                                            <a href="#">Intel’s new smart glasses actually look good</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="post-block-wrapper clearfix">
                                    <div class="post-thumbnail mb-0">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('src/images/news/news-10.jpg')}}" alt="post-thumbnail" />
                                        </a>
                                    </div>
                                    <a class="post-category" href="#">Food</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-sm">
                                            <a href="#">Free Two-Hour Delivery From Whole Foods</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="post-block-wrapper clearfix">
                                    <div class="post-thumbnail mb-0">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('src/images/news/news-11.jpg')}}" alt="post-thumbnail" />
                                        </a>
                                    </div>
                                    <a class="post-category" href="#">Tour</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-sm">
                                            <a href="#">Snow and Freezing Rain in Paris Forces the</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="post-block-wrapper clearfix">
                                    <div class="post-thumbnail mb-0">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('src/images/news/news-18.jpg')}}" alt="post-thumbnail" />
                                        </a>
                                    </div>
                                    <a class="post-category" href="#">Beauty</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-sm">
                                            <a href="#">The Best Eye Makeup Tutorials for all</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-sidebar-right-component />
            </div>
        </div>
    </section>
</x-base-layout>
