<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
// use App\Models\Movie_API;
use App\Models\Movie_Genre;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class IndexController extends Controller
{
    public function home(){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $new_movie = Movie::orderBy('created_day','DESC')->get();
        // $singer_movie = Movie::where('episode_number',0)->orderBy('created_day','DESC')->get();
        // $category_movie_series = Category::with('movie')->orderBy('id','DESC')->whereNotIn('id', [7, 5])->get();

        $movie = Movie::orderBy('year','DESC')->orderBy('view','DESC')->get();

        $view_day = View::with('movie')->whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::with('movie')->where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::with('movie')->where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::with('movie')->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
                                            // // cập nhật api vào flie
                                            // $api = [];
                                            // if(isset($movie)){
                                            //    foreach ($movie as $m) {
                                            //     $api[$m->id] = Movie_API::createFromApi($m->slug);
                                            //     } 
                                            // }
                                            

                                            // $path = public_path()."/json_file/";
                                            // if(!is_dir($path)){
                                            //     mkdir($path,0777,true);
                                            // }
                                            // $jsonString = json_encode($api);

                                            // file_put_contents($path . 'api.json', $jsonString );
        

      
        return view('pages.home', compact('new_movie', 'category', 'genre', 'country', 'movie', 'view_day', 'view_month_total', 'view_year_total', 'view_all_total'));
        // return response()->json($data[993]);
        // return response()->json($movie_slug);
        //  return response()->json($view_month_total[0]->movie->title);
        }

    public function category($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        
        $new_movie = Movie::orderBy('created_day','DESC')->orderBy('view','DESC')->paginate(20);
        $chieurap_movie = Movie::where('category_id',4)->orderBy('created_day','DESC')->orderBy('view','DESC')->paginate(20);
        $singer_movie = Movie::whereIn('category_id',[4,7])->orderBy('created_day','DESC')->orderBy('view','DESC')->paginate(20);
        $serie_movie = Movie::where('category_id',6)->orderBy('created_day','DESC')->orderBy('view','DESC')->paginate(20);

        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        return view('pages.category', compact('singer_movie','new_movie','chieurap_movie','serie_movie', 'category','genre','country','cate_slug','view_day','view_month_total','view_year_total','view_all_total'));
        
        // return response()->json($movie);
    }
    public function genre($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $genre_slug = Genre::where('slug',$slug)->first();

        $movie_genre = Movie_Genre::where('genre_id',$genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $mov){
            $many_genre[] = $mov->movie_id;
        }
        $movie = Movie::whereIn('id',$many_genre)->orderBy('year','DESC')->orderBy('view','DESC')->paginate(40);

        $movie_slug = Movie::where('slug',$slug)->first();
        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();


        return view('pages.genre', compact('movie_slug', 'category','genre','country','genre_slug','movie','view_day','view_month_total','view_year_total','view_all_total'));
    }
    public function country($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $count_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$count_slug->id)->orderBy('year','DESC')->orderBy('view','DESC')->paginate(40);

        $movie_slug = Movie::where('country_id',$count_slug->id)->first();
        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();


        return view('pages.country', compact('movie_slug','category','genre','country','count_slug','movie','view_day','view_month_total','view_year_total','view_all_total'));
        // return response()->json($movie_slug);

    }
    public function movie($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->first();
        $genre_movie = Movie_Genre::with('genre')->where('movie_id',$movie->id)->get();
        $movie_suggest = Movie::orderBy('view','DESC')->orderBy('created_day','DESC')->get();

        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();


        return view('pages.movie', compact('movie','category','genre','country', 'movie_suggest','genre_movie','view_day','view_month_total','view_year_total','view_all_total'));
        // return response()->json($genre_movie);
    }
    public function watch($slug){
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $movie_suggest = Movie::orderBy('view','DESC')->orderBy('created_day','DESC')->get();
        
        $movie = Movie::where('slug',$slug)->first();
        $episode = Episode::where('movie_id', $movie->id)->first();

        if (!Session::has('watched_movie_' . $movie->id)) {

            // Tăng giá trị cột 'view' lên 1
            $view = View::where('movie_id', $movie->id)->where('view_date', now()->toDateString())->first();

            if (!$view) {
                // Nếu bản ghi không tồn tại, tạo mới một bản ghi
                $view = new View();
                $view->movie_id = $movie->id;
                $view->view_date = now()->toDateString();
            }

            // Tăng giá trị view_number trong cả hai trường hợp
            $movie->increment('view');
            $view->view_number++;
            // Lưu bản ghi
            $view->save();
            // Đặt session để ghi nhớ rằng người dùng đã xem phim
            Session::put('watched_movie_' . $movie->id, true);
        }
        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        return view('pages.watch', compact('episode','movie_suggest','category','genre','country', 'movie','view_day','view_month_total','view_year_total','view_all_total'));
        // return response()->json($episode);

    }
    // public function tag($tag){
    //     $category = Category::orderBy('position','ASC')->get();
    //     $genre = Genre::orderBy('id','DESC')->get();
    //     $country = Country::orderBy('id','ASC')->get();
       
    //     $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('updated_day','DESC')->paginate(40);
    //     $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
    //     $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
    //     ->groupBy('movie_id') // Nhóm theo movie_id
    //     ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
    //     ->orderBy('total_views', 'DESC')
    //     ->get();

    //     $view_year_total = View::where('view_date', '>=', now()->startOfYear())
    //     ->groupBy('movie_id') // Nhóm theo movie_id
    //     ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
    //     ->orderBy('total_views', 'DESC')
    //     ->get();
    //     $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
    //     ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
    //     ->orderBy('total_views', 'DESC')
    //     ->get();
    //     return view('pages.tag', compact('category','genre','country','movie','tag','view_day','view_month_total','view_year_total','view_all_total'));

    // }
    public function watchEpisode($slug, $episode)
    {

        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();
        $movie_suggest = Movie::orderBy('year','DESC')->orderBy('view','DESC')->get();

        $movie = Movie::where('slug',$slug)->first();

        $total_episode = Episode::where('movie_id', $movie->id)->get();
        $movie_episode = Episode::where('movie_id',$movie->id)->where('episode',$episode)->first();
        if (!Session::has('watched_movie_' . $movie->id. '_'. $movie_episode->episode)) {

            // Tăng giá trị cột 'view' lên 1
            $view = View::where('movie_id', $movie->id)->where('view_date', now()->toDateString())->first();

            if (!$view) {
                // Nếu bản ghi không tồn tại, tạo mới một bản ghi
                $view = new View();
                $view->movie_id = $movie->id;
                $view->view_date = now()->toDateString();
            }

            // Tăng giá trị view_number trong cả hai trường hợp
            $movie->increment('view');
            $view->view_number++;
            // Lưu bản ghi
            $view->save();
            // Đặt session để ghi nhớ rằng người dùng đã xem phim
            Session::put('watched_movie_' . $movie->id. '_'. $movie_episode->episode);
        }
        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

       

        return view('pages.watch', compact('total_episode','movie_suggest','episode','category','genre','country', 'movie','movie_episode','view_day','view_month_total','view_year_total','view_all_total'));
        // return response()->json(count($data[867]['episodes'][0]['server_data']));
        // return response()->json($total_episode);
    }
    public function watchTrailer($slug)
    {
        $category = Category::orderBy('position','ASC')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','ASC')->get();

        $movie = Movie::with('category','genre','country', 'movie_genre', 'episode')->where('slug',$slug)->first();
        $movie_slug = Movie::where('slug',$slug)->first();
        $movie_suggest = Movie::orderBy('year','DESC')->orderBy('view','DESC')->get();
        
        $movie_trailer = Movie::where('slug', $slug)->pluck('trailer')->first();
        $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
        $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();

        $view_year_total = View::where('view_date', '>=', now()->startOfYear())
        ->groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();
        $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
        ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
        ->orderBy('total_views', 'DESC')
        ->get();


        return view('pages.watch', compact('movie_suggest','category','genre','country','movie_slug', 'movie','movie_trailer','view_day','view_month_total','view_year_total','view_all_total'));
        // return response()->json($movie_trailer);
    }
    public function search(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $movie = Movie::where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('actor', 'LIKE', '%'.$search.'%')
            ->orWhere('slug', 'LIKE', '%'.$search.'%')
            ->orWhere('director', 'LIKE', '%'.$search.'%')
            ->orWhere('name_eng', 'LIKE', '%'.$search.'%')
            ->orWhere('year', 'LIKE', '%'.$search.'%')
            ->orderBy('view','DESC')
            ->get();
            $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
            $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            $view_year_total = View::where('view_date', '>=', now()->startOfYear())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();
            $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            // return response()->json($data[29443]);
            return view('pages.search', compact('search','movie', 'category','genre','country', 'view_day','view_month_total','view_year_total','view_all_total'));
        }else{
            return redirect()->to('/');
        }
    }

    public function addNewMovie(){
        if(isset($_GET['namee_movie'])){

            $name_movie = $_GET['namee_movie'];

            // Sử dụng Str::slug để chuyển đổi về dạng slug
            $name_slug = Str::slug($name_movie);
            $movie_slug = Movie::where('slug',$name_slug)->first();
            if(!isset($movie_slug)){
                $api = Http::get("https://ophim1.com/phim/$name_slug")->json();

                if($api['status'] == false){
                    Session::flash('false', 'Thêm phim thất bại');         
                    return redirect()->back();
                }else{
                    $movie = new Movie();

                    $movie->title = $api['movie']['name'];
                    $movie->slug = $api['movie']['slug'];
                    $movie->description = $api['movie']['content'];
                    $movie->year = $api['movie']['year'];
                    $movie->name_eng = $api['movie']['origin_name'];

                    // Cắt bỏ phần đường dẫn cố định
                    $baseURL = "https://img.ophim9.cc/uploads/movies/";
                    $relativePath = str_replace($baseURL, "", $api['movie']['thumb_url']);

                    $movie->image = $relativePath;

                                // cập nhật category_id và country_id cho Movie
                                if ($api['movie']['type'] == 'series'){
                                    $movie->category_id = 6;
                                }else{
                                    if($api['movie']['chieurap'] == false){
                                        $movie->category_id = 4;
                                    }else{
                                        $movie->category_id = 7;
                                    }
                                }
                                
                                $country = Country::where('slug',$api['movie']['country'][0]['slug'])->first();
                                if($country == ''){
                                    $movie->country_id = 38;
                                }else{
                                    $movie->country_id = $country['id'];
                                }
                    // Lấy danh sách genres từ dữ liệu API
                    $apiGenres = collect($api['movie']['category']);
                    // Lấy danh sách genre_ids từ bảng genre trong Laravel dựa trên slug
                    $genreIds = Genre::whereIn('slug', $apiGenres->pluck('slug'))->pluck('id');





                    $all_api_episodes = collect($api['episodes'][0]['server_data']);
                    // Đếm số tập phim
                    $num_episodes = count($all_api_episodes);

                    // Sử dụng vòng lặp for để lưu các tập phim
                    for ($i = 0; $i < $num_episodes; $i++) {
                    $api_episode = $all_api_episodes[$i];

                    $episode = new Episode();
                    $episode->movie_id = $movie->id;
                    $episode->episode = $i + 1;
                    $episode->linkphim = $api_episode['link_embed']; 
                    $episode->save();
                    }
                    $movie->created_day = $api['movie']['created']['time'];
                    $movie->updated_day = $api['movie']['modified']['time'];
                    $movie->description = $api['movie']['content'];
                    if($api['movie']['type'] == 'singer' && $api['movie']['chieurap'] == false){
                    $movie->category_id = 7;
                    }
                    if($api['movie']['type'] == 'singer' && $api['movie']['chieurap'] == true){
                    $movie->category_id = 4;
                    }
                    if($api['movie']['type'] == 'series'){
                    $movie->category_id = 6;
                    }

                    $movie->status = $api['movie']['status'];
                    $movie->trailer = $api['movie']['trailer_url'];
                    $movie->runtime = $api['movie']['time'];
                    $movie->episode_current = $api['movie']['episode_current'];
                    $movie->quality = $api['movie']['quality'];
                    $movie->subtitle = $api['movie']['lang'];
                    $movie->view = $api['movie']['view'];
                    $movie->actor = implode(', ', $api['movie']['actor']);
                    $movie->director = implode(', ', $api['movie']['director']);

                    $movie->save();
                    $movie->movie_genre()->sync($genreIds);


                    Session::flash('success', 'Thêm phim thành công'); 
                    return redirect()->route('movie',$name_slug);
                }
            }else{
                Session::flash('no-action', 'Đã tồn tại phim'); 
                return redirect()->back();
        // return response()->json($name_slug);

            }
        }else{
            return redirect()->to('/');
        }
        // return response()->json($name_slug);
    }

    public function addMovie(){

            $category = Category::orderBy('position','ASC')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','ASC')->get();

            $view_day = View::whereDate('view_date', now()->toDateString())->orderBy('view_number', 'DESC')->get();
            $view_month_total = View::where('view_date', '>=', now()->startOfMonth()->toDateString())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            $view_year_total = View::where('view_date', '>=', now()->startOfYear())
            ->groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();
            $view_all_total = View::groupBy('movie_id') // Nhóm theo movie_id
            ->selectRaw('movie_id, SUM(view_number) as total_views') // Tính tổng view_number cho từng movie_id
            ->orderBy('total_views', 'DESC')
            ->get();

            // return response()->json($data[29443]);
            return view('pages.addMovie', compact( 'category','genre','country', 'view_day','view_month_total','view_year_total','view_all_total'));

    }
    public function updateMovie($slug){
        $movie = Movie::where('slug',$slug)->first();
    
        $api = Http::get("https://ophim1.com/phim/$movie->slug")->json();
        $movie_episode = Episode::where('movie_id',$movie->id)->get();
        if($movie->episode_current == $api['movie']['episode_current']){
            Session::flash('no-action', 'Chưa có tập phim mới'); 
        }else{
            foreach($movie_episode as $episode) {
                $episode->delete();
            }
            $index = 1;
            foreach($api['episodes'][0]['server_data'] as $epiAPI){
                $episode = new Episode();
                $episode->movie_id = $movie->id;
                $episode->linkphim = $epiAPI['link_embed'];
                $episode->episode = $index;
                
                $episode->save();
                $index++;
            }
            Session::flash('success', 'Cập nhật thành công'); 
            
            $movie->episode_current = $api['movie']['episode_current'];
            $movie->save();
        }
        // return response()->json($movie);
        return redirect()->back();
    }
    
}
