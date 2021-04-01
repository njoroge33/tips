<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Helpers\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
	
        return view('auth.login');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'phone'=> 'required|numeric|regex:/(07)[0-9]{8}/',
            'password'=> 'required',
        ]);

        // dd($request);

        $mobilenumber = Utils::internationalizeNumber($request -> phone);
        $unique_key =$request->password;

// $phone = $request->phone;
        $user = Profile::where(['msisdn'=> $mobilenumber,'unique_key'=>$unique_key])->first();
     
        if(!$user)
		{	
		return redirect()->back()->withError('Invalid login details provided!');
		}  
        Auth::login($user);
        return redirect()->route('tips');
       
    }

}
