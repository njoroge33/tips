<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller
{
    public function index() {
        if (!Auth::check()) {
        return view('tips');
        }
    }
}
