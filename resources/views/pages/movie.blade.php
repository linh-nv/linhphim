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
    @if(Session::has('success'))
        <div id="custom-alert" class="custom-alert">
            <span class="close-btn" onclick="hideAlert();">&times;</span>
            <p>{{ Session::get('success') }}</p>
        </div>
    
        <script>
            function hideAlert() {
                var alertDiv = document.getElementById('custom-alert');
                if (alertDiv) {
                    alertDiv.style.display = 'none';
                    {{session()->forget('success')}}
                }
            }
        </script>
    @elseif(Session::has('no-action'))
        <div id="custom-alert" class="custom-alert">
            <span class="close-btn" onclick="hideAlert();">&times;</span>
            <p>{{ Session::get('no-action') }}</p>
        </div>

        <script>
            function hideAlert() {
                var alertDiv = document.getElementById('custom-alert');
                if (alertDiv) {
                    alertDiv.style.display = 'none';
                    {{session()->forget('no-active')}}
                }
            }
        </script>
    @endif
    


    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section id="content" class="test">
            <div class="clearfix wrap-content">
                <div class="halim-movie-wrapper">
                <div class="movie_info col-xs-12">
                    <div class="movie-poster col-md-3">
                        <img class="movie-thumb" src="{{$movie->image}}" alt="{{$movie->title}}">
                        <div class="d-flex" style="display: inline-flex;width: 100%;justify-content: space-between;">
                            
                            @if ($movie->status != 'trailer')
                                @if ($movie->trailer != null)
                                    @if ($movie->category_id == 7 || $movie->category_id == 4)
                                    <a style="width: 49%"href="{{ route('watch', $movie->slug) }}" class="btn btn-danger">Xem phim</a>
                                    @else
                                    <a style="width: 49%" href="{{ route('watch.episode', ['slug' => $movie->slug, 'episode' => 1]) }}" class="btn btn-danger">Xem phim</a>
                                    @endif
                                    <a style="width: 49%" href="{{ route('watch.trailer',$movie->slug) }}" class="btn btn-info">Xem trailer</a>
                                @else
                                    @if ($movie->category_id != 6)
                                    <a style="width: 100%"href="{{ route('watch', $movie->slug) }}" class="btn btn-danger">Xem phim</a>
                                    @else
                                    <a style="width: 100%" href="{{ route('watch.episode', ['slug' => $movie->slug, 'episode' => 1]) }}" class="btn btn-danger">Xem phim</a>
                                    @endif
                                @endif
                            @else
                                <a style="width: 100%" href="{{ route('watch.trailer',$movie->slug) }}" class="btn btn-info">Xem trailer</a>                            
                            @endif    

                        </div>
                        <a href="{{route('updateMovie',$movie->slug)}}" class="btn btn-success" style="width: 100%; margin-top: 5px">Cập nhật tập phim mới</a>
                        
                        
                    </div>
                    <div class="film-poster col-md-9">
                        <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                        <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
                        <ul class="list-info-group">
                            <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">{{$movie->quality}}</span><span class="episode">{{$movie->episode_current == '' || $movie->episode_current == 0 ? 'Đang xử lý' : $movie->episode_current }}</span></li>
                            <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->runtime}}</li>
                            <li class="list-info-group-item">
                                <span>Thể loại</span> : 
                                
                                @foreach ($genre_movie as $gen)
                                    <a href="{{$gen->genre->slug}}" rel="category tag">{{$gen->genre->title}}</a>
                                    @if (!$loop->last)
                                        , <!-- Thêm dấu phẩy nếu không phải là actor cuối cùng -->
                                    @endif
                                @endforeach
                            </li>
                            {{-- <li class="list-info-group-item"><span>Quốc gia</span> : <a href="" rel="tag">{{$movie->country->title}}</a></li> --}}
                            <li class="list-info-group-item"><span>Đạo diễn</span> : 
                                @php
                                    $directorsArray = array_map('trim', explode(',', $movie->director));
                                @endphp
                                @foreach ($directorsArray as $director)
                                    <a class="director" rel="nofollow" href="" title="{{$director}}">
                                        {{$director}}
                                    </a>
                                    @if (!$loop->last)
                                        , <!-- Thêm dấu phẩy nếu không phải là actor cuối cùng -->
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : 
                                @php
                                    $actorsArray = array_map('trim', explode(',', $movie->actor));
                                @endphp
                                @foreach($actorsArray as $actor)
                                    <a href="" rel="nofollow" title="{{ $actor }}">
                                        {{$actor}}
                                    </a>
                                    @if (!$loop->last)
                                        , <!-- Thêm dấu phẩy nếu không phải là actor cuối cùng -->
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                        <div class="movie-trailer hidden"></div>
                    </div>
                </div>
                </div>
                <div class="clearfix"></div>
                <div id="halim_trailer"></div>
                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            <span>{{$movie->title}}</span> - <span>{{$movie->name_eng}}</span>:
                            {{$movie->title}} &#8211; {{$movie->name_eng}}: {{$movie->description}}
                        </article>
                    </div>
                </div>
            </div>
            <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Để lại bình luận của bạn</span></h2>
            </div>
            @php
                $current_url = Request::url();
            @endphp
            <div class="fb-comments" style="background-color: #fff" data-href="{{$current_url}}" data-width="100%" data-numposts="5"></div>
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
                                <a class="halim-thumb" href="{{route('movie', $mov->slug)}}" title="{{$mov->title}}">
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