<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tip;
use Carbon\Carbon;

class TipController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $tips = Tip::with('prediction')->where('game_date', '>', Carbon::now())->get();
            // dd($tips);
        return view('tips', ['tips' => $tips]);
        }else{
            return redirect()->route('login')->withError('Login first please!!');
        }
    }
}
