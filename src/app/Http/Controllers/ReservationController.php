<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request){
        $reservations = New Reservation();
        $reservations->user_id = Auth::user()->id;
        $reservations->shop_id = $request->shop_id;
        $reservations->number = $request->number;
        $reservations->reserve_date = $request->reserve_date;
        $reservations->reserve_time = $request->reserve_time;
        $reservations->rate = 0;
        $reservations->review = '';
        $reservations->save();

        return view('done');
    }

    public function mypage(Request $request){
        $user = Auth::user();
        $reservations = $user->reservations;
        $favorites = $user->favorites;
        return view('mypage',compact('reservations','favorites'));
    }

    public function update(ReservationRequest $request){
        $reservations = $request -> all();
        Reservation::find($request->id)->update($reservations);
        return back()->with('message', '予約を更新しました');
    }

    public function destroy(Request $request){
        Reservation::find($request->id)->delete();
        return back()->with('message','予約をキャンセルしました');
    }

}
