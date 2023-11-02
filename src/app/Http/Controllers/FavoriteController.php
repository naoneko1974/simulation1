<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request){
        $favorites = New Favorite();
        $favorites->user_id = Auth::user()->id;
        $favorites->shop_id = $request->shop_id;
        $favorites->save();
        return back();
    }

    public function destroy(Request $request){
        $user = Auth::user()->id;
        $favorites = Favorite::where('user_id',$user)->where('shop_id', $request->shop_id)->first();
        $favorites->delete();
        return back();
    }
}