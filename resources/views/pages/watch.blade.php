@extends('layout')
@section('content')
<div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs">
                            <span>
                                <span>
                                    <a href="{{route('homepage')}}">Trang chủ</a> 
                                    » 
                                    <span>
                                        <a href="{{route('country', $movie->country->slug)}}">{{$movie->country->title}}</a>
                                        » 
                                        <span class="breadcrumb_last" aria-current="page">{{$movie->year}}</span>
                                        »
                                        <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span>
                                    </span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8" style="padding-top: 15px;">
        <section id="content" class="test">
            <div class="clearfix wrap-content">
                @if(!isset($movie_trailer))
                    {{-- phim bo --}}
                    @if ($movie->category_id == 6)
                        <iframe width="100%" height="500" src="{{$movie_episode->linkphim}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    {{-- phim le --}}
                    @else
                        <iframe width="100%" height="500" src="{{$episode->linkphim}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @endif
                {{-- trailer --}}
                @else
                    @php
                    // Link YouTube ban đầu
                    $originalLink = $movie->trailer;
                    // Chuyển đổi thành link nhúng
                    $embedLink = str_replace("youtube.com/watch?v=", "youtube.com/embed/", $originalLink);
                    @endphp
                    <iframe width="100%" height="500" src="{{$embedLink}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div class="title-block">
                    <div class="title-wrapper-xem full">
                        @if(!isset($movie_trailer))
                            {{-- phim bộ --}}
                            @if ($movie->category_id == 6) 
                                <h1 class="entry-title"><a style = " pointer-events: none;cursor: default;" href="" title='{{$movie->title." tập ".$episode}}' class="tl">{{$movie->title." tập ".$episode}}</a></h1>
                            {{-- phim lẻ --}}
                            @else
                                <h1 class="entry-title"><a style = " pointer-events: none;cursor: default;" href="" title='{{$movie->title}}' class="tl">{{$movie->title}}</a></h1>
                            @endif
                        {{-- trailer --}}
                        @else
                            <h1 class="entry-title"><a style = " pointer-events: none;cursor: default;" href="" title='{{"Trailer ".$movie->title}}' class="tl">Trailer {{$movie->title}}</a></h1>
                        @endif
                    </div>
                </div>
                <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                    <article id="post-37976" class="item-content post-37976"></article>
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    <div id="halim-ajax-list-server"></div>
                </div>
                <div id="halim-list-server">
                    <div class="tab-content">
                    @if ($movie->category_id == 6 && !isset($movie_trailer)) 
                        <div role="tabpanel" class="tab-pane active server-1 htmlwrap" id="server-0">
                            <p style="text-transform: uppercase;font-weight: 600">Danh sách phát</p>
                            
                            <div class="halim-server">
                                <ul class="halim-list-eps">
                                    @if (count($total_episode) > 50)
                                        @for ($i = count($total_episode); $i >= 1 ; $i--)
                                            <a href="{{ route('watch.episode', ['slug' => $movie->slug, 'episode' => $i]) }}">
                                                <li class="halim-episode">
                                                    <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow" >
                                                        Tập {{$i}}
                                                    </span>
                                                </li>
                                            </a>                                
                                        @endfor
                                    @else
                                        @for ($i = 1; $i <= count($total_episode); $i++)
                                            <a href="{{ route('watch.episode', ['slug' => $movie->slug, 'episode' => $i]) }}">
                                                <li class="halim-episode">
                                                    <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow" >
                                                        Tập {{$i}}
                                                    </span>
                                                </li>
                                            </a>                                
                                        @endfor
                                    @endif
                                    
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                </div>
                <div class="htmlwrap clearfix">
                    <span>{{$movie->title}}</span> - <span>{{$movie->name_eng}}</span>:
                    {{$movie->description}}
                </div>
        </section>
        <section class="related-movies">
            <div id="halim_related_movies-2xx" class="wrap-slider">
                <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                </div>
                <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                    @foreach ($movie_suggest->take(10) as $mov)
                        <article class="thumb grid-item post-38498">
                            <div class="halim-item">
                                <a class="halim-thumb" href="" title="{{$mov->title}}">
                                    <figure><img class="lazy img-responsive" src="{{$mov->image}}" alt="{{$mov->title}}" title="{{$mov->title}}"></figure>
                                    <span class="status">{{$mov->quality}}</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>{{$mov->subtitle}}</span> 
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{$mov->title}}</p>
                                        <p class="original_title">{{$mov->name_eng}}</p>
                                    </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <script>
                jQuery(document).ready(function($) {				
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                </script>
            </div>
        </section>
        </main>
        <script>
            jQuery(document).ready(function($) {				
            var owl = $('#halim_related_movies-2');
            owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
        </script>
        <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
            <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                <div class="section-bar clearfix">
                    <div class="section-title">
                    <span>Top Views</span>
                    <ul class="halim-popular-tab" role="tablist">
                        <li role="presentation" class="active show-view-day">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="today">Day</a>
                        </li>
                        <li role="presentation" class="show-view-month">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="month">Month</a>
                        </li>
                        <li role="presentation" class="show-view-year">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="week">Year</a>
                        </li>
                        <li role="presentation" class="show-view-all">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                        </li>
                    </ul>
                    </div>
                </div>
                <section class="tab-content">
                    <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="popular-post">
                        <div id="view-by-day">
                            @foreach ($view_day->take(10) as $key => $mov_view)
                            <div class="item post-37176">  
                                    <a href="{{route('movie',$mov_view->movie->slug)}}" title="{{$mov_view->movie->title}}">
                                        <div class="item-link">
                                        <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->title}}" title="{{$mov_view->movie->title}}" />
                                        <span class="is_trailer">{{$mov_view->movie->quality}}</span>
                                        </div>
                                        <p class="title">{{$mov_view->movie->title}}</p>
                                    </a>
                                    <div class="viewsCount" style="color: #9d9d9d;">{{$mov_view->view_number}} lượt xem</div>
                                    <div style="float: left;">
                                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                        <span style="width: 0%"></span>
                                        </span>
                                    </div>
                            </div>
                            @endforeach 
                        </div>
                        <div id="view-by-month">
                            @foreach ($view_month_total->take(10) as $key => $mov_view)
                            <div class="item post-37176">  
                                    <a href="{{route('movie',$mov_view->movie->slug)}}" title="{{$mov_view->movie->title}}">
                                        <div class="item-link">
                                        <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->title}}" title="{{$mov_view->movie->title}}" />
                                        <span class="is_trailer">{{$mov_view->movie->quality}}</span>
                                        </div>
                                        <p class="title">{{$mov_view->movie->title}}</p>
                                    </a>
                                    <div class="viewsCount" style="color: #9d9d9d;">{{$mov_view->total_views}} lượt xem</div>
                                    <div style="float: left;">
                                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                        <span style="width: 0%"></span>
                                        </span>
                                    </div>
                            </div>
                            @endforeach 
                        </div>
                        <div id="view-by-year">
                            @foreach ($view_year_total->take(10) as $key => $mov_view)
                            <div class="item post-37176">  
                                    <a href="{{route('movie',$mov_view->movie->slug)}}" title="{{$mov_view->movie->title}}">
                                        <div class="item-link">
                                        <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->title}}" title="{{$mov_view->movie->title}}" />
                                        <span class="is_trailer">{{$mov_view->movie->quality}}</span>
                                        </div>
                                        <p class="title">{{$mov_view->movie->title}}</p>
                                    </a>
                                    <div class="viewsCount" style="color: #9d9d9d;">{{$mov_view->total_views}} lượt xem</div>
                                    <div style="float: left;">
                                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                        <span style="width: 0%"></span>
                                        </span>
                                    </div>
                            </div>
                            @endforeach 
                        </div>
                        <div id="view-all">
                            @foreach ($view_all_total->take(10) as $key => $mov_view)
                            <div class="item post-37176">  
                                    <a href="{{route('movie',$mov_view->movie->slug)}}" title="{{$mov_view->movie->title}}">
                                        <div class="item-link">
                                        <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->title}}" title="{{$mov_view->movie->title}}" />
                                        <span class="is_trailer">{{$mov_view->movie->quality}}</span>
                                        </div>
                                        <p class="title">{{$mov_view->movie->title}}</p>
                                    </a>
                                    <div class="viewsCount" style="color: #9d9d9d;">{{$mov_view->total_views}} lượt xem</div>
                                    <div style="float: left;">
                                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                        <span style="width: 0%"></span>
                                        </span>
                                    </div>
                            </div>
                            @endforeach 
                        </div>
                    </div>
                    </div>
                </section>
                <div class="clearfix"></div>
            </div>
        </aside>
</div>
@endsection