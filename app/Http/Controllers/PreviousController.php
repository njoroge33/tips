<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;
use Carbon\Carbon;
use App\Models\Profile;

class PreviousController extends Controller
{
    public function index() {
        // $tips = Tip::where('game_date', '>', Carbon::now())->get();
        
        $outcomes = Tip::with('outcome')->where('game_date', '<', Carbon::now())->get();
        // dd($outcomes);
        // Profile::where('unique_key_expiry', '<', Carbon::now())->delete();
        
    return view('previous', ['outcomes' => $outcomes]);
}
}
