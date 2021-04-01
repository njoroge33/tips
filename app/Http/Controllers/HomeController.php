<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;

class HomeController extends Controller
{
    public function index() {
            $tips = Tip::all();
        return view('home', ['tips' => $tips]);
    }
}
