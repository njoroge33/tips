@extends('layouts.app')
 
 @section('content')
 @include('partials.messages')
 <div class="container">
        <p class="text-center mt-2">Make sure you have subscribed to Bettip online service to get tips before you Login.<a href="{{route('subscribe')}}">Subscribe</a></p>
        <div class="card card-style mt-3 p-2 mb-5">

             <div class="content">
                <h2 class="font-weight-bold text-center" >LOGIN</h2>

                    <form method="POST" action="{{ route('login') }}" class="font-weight-bold">

                         @csrf
 
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Enter Mobile Number:') }}</label>
 
                             <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="07XX XXX XXX" autocomplete="phone" autofocus>

                                 @error('phone')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                         @enderror
                             </div>
                         </div>
 
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Unique Key:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required title="unique key" placeholder="XXXXXX" autocomplete="current-password">
 
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                               </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                        <div class="form-group text-center">
                        <P>Not yet subscribed <a href="{{route('subscribe')}}">Subscribe </a>to get a unique key.</P>
                        </div>

                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection