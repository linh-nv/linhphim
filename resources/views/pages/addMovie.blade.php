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
                                » Thêm phim
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section>
            @if(Session::has('success'))
                <div class="alert alert-primary" role="alert">
                    <p>{{ Session::get('no-action') }}</p>
                </div>
            @endif

            @if(Session::has('no-action'))
                <div class="alert alert-warning" role="alert">
                    <p>{{ Session::get('no-action') }}</p>
                </div>
            @endif

            @if(Session::has('false'))
                <div class="alert alert-danger" role="alert">
                    <p>{{ Session::get('false') }}</p>
                </div>
            @endif
            <div class="halim_box">
                
                <div class="suggest" style="height: 1000px">
                    <div class="hide-header">
                        <div class="hide-scrow-left"></div>
                        <div class="hide-scrow-right"></div>
                        <div class="hide-scrow-bottom"></div>

                        <div class="section-bar clearfix">
                            <div class="item-new-movie">
                                <form id="movieForm" action="{{ route('addNewMovie') }}" method="GET" >
                                    @csrf
                                    <div class="section-bar clearfix" style="margin-bottom: 20px">
                                        <h1 class="section-title"><span>Thêm phim</span></h1>
                                    </div>
                                    <div class="addMovie">
                                        <input type="text" name="namee_movie" id="name_movie" placeholder="Nhập chính xác tên phim...">
                                        <a class="btn btn-primary" id="searchSuggestionsBtn">Tìm kiếm trong kho phim</a>
                                        <button class="btn btn-success" id="addMovieBtn">Thêm phim</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <div id="sectionBar" class="section-bar clearfix" style="display: none;    margin-top: 80px;">
                            <h1 class="section-title"><span>Các gợi ý cho bạn</span></h1>
                        </div>
                    </div>
                    <iframe id="suggestionsIframe" src="" width="100%" height="100%" frameborder="0" style="pointer-events: none"></iframe>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#searchSuggestionsBtn').on('click', function () {
                        var nameMovieValue = $('#name_movie').val();
                        var suggestionsIframe = $('#suggestionsIframe');

                        // Thay đổi thuộc tính src của iframe để chứa dữ liệu nhập vào từ input
                        suggestionsIframe.attr('src', "https://ophim9.cc/tim-kiem?keyword=" + nameMovieValue);

                        $('#sectionBar').show();

                    });
                });
            </script>
            
            <style>
                .hide-header {
                    position: absolute;
                    width: 101%;
                    height: 310px;
                    z-index: 1;
                    background-color: #171F27;
                    padding: 0 24px;
                }
                .hide-scrow-left {
                    width: 24px;
                    background: #171F27;
                    height: 1001px;
                    position: absolute;
                    left: 0;
                    top: 310px;
                }
                .hide-scrow-right {
                    width: 24px;
                    background: #171F27;
                    height: 1001px;
                    position: absolute;
                    right: 0;
                    top: 310px;
                }
                .hide-scrow-bottom {
                    width: 100%;
                    background: #171F27;
                    height: 18px;
                    position: absolute;
                    right: 0;
                    top: 982px;
                }

                .addMovie input{
                    width: 100%;
                    background-color: #17242E;
                    border: 1px solid #253A4D;
                    border-radius: 20px;
                    padding: 10px 30px;
                    margin-right: 20px;
                    margin-bottom: 20px;
                }
                /* .addMovie button {
                    color: #7aa6ce;
                    background-color: #12171b;
                    border-color: #2d3842;
                    border-left: none;
                    padding: 3px 42px;
                    border-radius: 20px !important;
                    border: 1px solid #253A4D;
                    margin-right: 20px;
                    width: 20%;
                }
                .addMovie a {
                    color: #7aa6ce;
                    background-color: #12171b;
                    border-color: #2d3842;
                    border-left: none;
                    padding: 3px 15px;
                    border-radius: 20px !important;
                    border: 1px solid #253A4D;
                    margin-right: 20px;
                    width: 20%;
                } */
                /* .item-new-movie .searchSuggestions {
                    width: 100%;
                    justify-content: end;
                    display: flex;
                    margin-top: 20px 
                } */
            </style>
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