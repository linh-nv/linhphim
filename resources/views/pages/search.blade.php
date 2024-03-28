@extends('layout')
@section('content')
@php
use Illuminate\Pagination\LengthAwarePaginator;
@endphp
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="yoast_breadcrumb hidden-xs">
                        <span>
                            <span>
                                <a href="{{route('homepage')}}">Trang chủ</a> 
                                » Tìm kiếm » 
                                <span>
                                    <a href="">{{$search}}</a>
                                </span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section>
            <div class="section-bar clearfix">
                <h1 class="section-title"><span>{{$search}}</span></h1>
            </div>
            <div class="halim_box">

                @foreach($movie as $key => $mov)
                    <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('movie', $mov->slug)}}">
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

            <div class="text-center" >
                {{-- <ul class='page-numbers'>
                <li><span aria-current="page" class="page-numbers current">1</span></li>
                <li><a class="page-numbers" href="">2</a></li>
                <li><a class="page-numbers" href="">3</a></li>
                <li><span class="page-numbers dots">&hellip;</span></li>
                <li><a class="page-numbers" href="">55</a></li>
                <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
                </ul> --}}
                {{-- {!! $paginatedData->links() !!} --}}
               
                {{-- {{ $movies->links("pagination::bootstrap-4") }} --}}

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