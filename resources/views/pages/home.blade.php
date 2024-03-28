@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
           <h3 class="section-title"><span>Phim Hot</span></h3>
        </div>
        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
            @foreach($movie->take(12) as $key => $hot)
            <article class="thumb grid-item post-38498">
                <div class="halim-item">
                    <a class="halim-thumb" href="{{ route('movie', Str::slug($hot->slug)) }}" title="{{ $hot->title }}">
                        <figure><img class="lazy img-responsive" src="{{$hot->image}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                        <span class="status">{{$hot->quality}}</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>{{$hot->subtitle}}</span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                            <p class="entry-title">{{$hot->title}}</p>
                            <p class="original_title">{{$hot->name_eng}}</p>
                        </div>
                        </div>
                    </a>
                </div>
            </article>
           @endforeach
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        {{-- Phim mới --}}
        <section id="halim-advanced-widget-2">
            <div class="section-heading">
                <a href="" title="Phim mới">
                <span class="h-text">Phim mới</span>
                </a>
            </div>
            <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                @foreach($new_movie->take(20) as $mov)
                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                <div class="halim-item">
                    <a class="halim-thumb" href="{{ route('movie',$mov->slug )}}">
                        <figure><img class="lazy img-responsive" src="{{$mov->image}}" alt="" title="{{$mov->title}}"></figure>
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
        </section>

        {{-- Phim lẻ --}}
        <section id="halim-advanced-widget-2">
            <div class="section-heading">
                <a href="" title="Phim lẻ">
                <span class="h-text">Phim lẻ</span>
                </a>
            </div>
            <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                @php
                    $count = 0;
                @endphp
                @foreach($movie as $key => $mov)
                    @if ($mov->category_id == 7 || $mov->category_id == 4)
                        @if ($count < 20)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $mov->slug )}}">
                                        <figure><img class="lazy img-responsive" src="{{$mov->image}}" alt="" title="{{$mov->title}}"></figure>
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
                            @php
                                $count++;
                            @endphp
                        @else
                            @break
                        @endif
                    @endif
                @endforeach
            </div>
        </section>

        {{-- Phim bộ, phim chiếu rạp --}}
        <section id="halim-advanced-widget-2">
            <div class="section-heading">
                <a href="" title="Phim bộ">
                <span class="h-text">Phim bộ</span>
                </a>
            </div>
            <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                @php
                    $count = 0;
                @endphp
                @foreach($movie as $key => $mov)
                    @if ($mov->category_id == 6)
                        @if ($count < 20)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $mov->slug )}}">
                                        <figure><img class="lazy img-responsive" src="{{$mov->image}}" alt="" title="{{$mov->title}}"></figure>
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
                            @php
                                $count++;
                            @endphp
                        @else
                            @break
                        @endif                     
                    @endif
                @endforeach
            </div>
            <div class="section-heading">
                <a href="" title="Phim bộ">
                <span class="h-text">Phim chiếu rạp</span>
                </a>
            </div>
            <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                @php
                    $count = 0;
                @endphp
                @foreach($movie as $key => $mov)
                    @if ($mov->category_id == 4)
                        @if ($count < 20)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $mov->slug )}}">
                                        <figure><img class="lazy img-responsive" src="{{$mov->image}}" alt="" title="{{$mov->title}}"></figure>
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
                            @php
                                $count++;
                            @endphp
                        @else
                            @break
                        @endif                       
                    @endif
                @endforeach
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
                                    <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->image}}" title="{{$mov_view->movie->title}}" />
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
                        @foreach ($view_month_total->take(10) as $mov_view)
                        <div class="item post-37176">  
                                <a href="{{route('movie',$mov_view->movie->slug)}}" title="{{$mov_view->movie->title}}">
                                    <div class="item-link">
                                    <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->image}}" title="{{$mov_view->movie->title}}" />
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
                                    <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->image}}" title="{{$mov_view->movie->title}}" />
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
                                    <img src="{{$mov_view->movie->image}}" class="lazy post-thumb" alt="{{$mov_view->movie->image}}" title="{{$mov_view->movie->title}}" />
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