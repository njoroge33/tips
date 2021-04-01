@extends('layouts.app')
 
 @section('content')
 <div class="container">
        <p class="text-center mt-2">Make sure you have subscribed to Bettip online service to get tips before you Login.<a href="#">Subscribe</a></p>
        <div class="card card-style mt-3 p-2 mb-5">

             <div class="content">
                <h2 class="font-weight-bold text-center" >SUSCRIBE</h2>

                    <form method="POST" action="{{ route('subscribe') }}" class="font-weight-bold">

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
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount:') }}</label>

                        <div class="col-md-6">
                        <select class="form-select form-select-md" name="amount" aria-label=".form-select-sm example">
  <option selected>Select the amount(Kshs)</option>
  <option value="50">50</option>
  <option value="100">100</option>
</select>
                        </div>
                            
                        </div>

                        <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                        </div>

                        <div class="form-group text-center">
                        <P>Already subscribed and have a unique key <a href="{{url('login') }}">login</a>.</P>
                        </div>

                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection