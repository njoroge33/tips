<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tip;

class TipController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $tips = Tip::all();
            // dd($tips);
        return view('tips', ['tips' => $tips]);
        }else{
            return redirect()->route('login');
        }
    }
}
