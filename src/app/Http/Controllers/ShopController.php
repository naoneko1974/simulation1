<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use App\Http\Requests\ShopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ShopController extends Controller
{
    public function index() {
        $shops = Shop::all();
        $areas = Shop::select('area')->groupBy('area')->get();
        $genres = Shop::select('genre')->groupBy('genre')->get();
        if (Auth::check()) {
            $user = Auth::user()->id;
            $favorites = Favorite::where('user_id',$user)->get();
            return view('index', compact('shops', 'areas', 'genres', 'favorites'));
        } else {
            return view('index', compact('shops', 'areas', 'genres'));
        }
    }

    public function detail($id){
        $shops = Shop::find($id);
        return view('detail',compact('shops'));
    }

    public function search(Request $request){
        $shops = Shop::AreaSearch($request->area_keyword)->GenreSearch($request->genre_keyword)->TextSearch($request->text_keyword)->get();
        $areas = Shop::select('area')->groupBy('area')->get();
        $genres = Shop::select('genre')->groupBy('genre')->get();
        if (Auth::check()) {
            $user = Auth::user()->id;
            $favorites = Favorite::where('user_id', $user)->get();
            return view('index', compact('shops', 'areas', 'genres', 'favorites'));
        } else {
            return view('index', compact('shops', 'areas', 'genres'));
        }
    }

    public function manage(){
        $shops = Shop::simplePaginate(5);
        $areas = Shop::select('area')->groupBy('area')->get();
        $genres = Shop::select('genre')->groupBy('genre')->get();

        return view('manage',compact('shops', 'areas', 'genres'));
    }

    public function register(){

        return back()->with('manager-register__message', '店長を登録しました');
    }
    public function store(ShopRequest $request){
        $shops = New Shop();
        $shops->store_name = $request->store_name;
        $shops->area = $request->area;
        $shops->genre = $request->genre;
        $shops->overview = $request->overview;
        $shops->picture = $request->picture;
        $shops->save();
        return back()->with('store-register__message', '店舗を登録しました');
    }

    public function update(ShopRequest $request){
        $shops = $request->all();
        Shop::find($request->id)->update($shops);
        return back()->with('store-update__message', '店舗を更新しました');
    }

    public function search2(Request $request){
        $shops = Shop::AreaSearch($request->area_keyword)->GenreSearch($request->genre_keyword)->TextSearch($request->text_keyword)->simplePaginate(5);
        $areas = Shop::select('area')->groupBy('area')->get();
        $genres = Shop::select('genre')->groupBy('genre')->get();
        return view('manage', compact('shops', 'areas', 'genres'));
    }

}
