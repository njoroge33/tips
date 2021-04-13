@extends('layouts.app')

@section('content')
@include('partials.messages')
<div id="carouselExampleControls" class="carousel slide mb-5" data-ride="carousel">
  <div class="carousel-inner font-weight-bold" >
    <div class="carousel-item active">
      <img class="d-block w-100" style="height:60vh" src="https://res.cloudinary.com/grohealth/image/upload/$wpsize_!post-thumbnail!,w_1000,h_600,c_fill,g_auto/v1588088887/the-ball-stadion-football-the-pitch-46798.jpeg" alt="First slide">
      <div class="carousel-caption">
        <h5 class="font-weight-bold text-warning">99% Daily sure bets</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" style="height:60vh" src="https://cloudfront.penguin.co.in/wp-content/uploads/2018/06/FIFA_Header-scaled.jpg" alt="Second slide">
      <div class="carousel-caption">
        <h5 class="font-weight-bold text-warning">Sure bets for lower price</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" style="height:60vh" src="https://m.economictimes.com/thumb/msid-65210785,width-1200,height-900,resizemode-4,imgsize-343861/football1_gettyimages.jpg" alt="Third slide">
      <div class="carousel-caption">
        <h5 class="font-weight-bold text-warning">Daily sure bets</h5>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container">
<div class="text-center">
<h2 class="font-weight-bold">FEATURED MATCHES</h2>
</div>
@if ($tips-> count())
<table class="table table-striped tab-content text-center" id="tab-8">
  <thead class="bg-warning">
    <tr>
    <th scope="col">DATE</th>
    <th scope="col">LEGAUE</th>
    <th scope="col">MATCH</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($tips as $tip)
    <tr>
      <th>{{date('d F, Y (l)', strtotime($tip->game_date))}}</th>
      <td class="color-orange-light">{{ucfirst(trans($tip->league))}}</td>
      <td class="color-orange-light">{{ucfirst(trans($tip->home_team))}} <p class="m-0 p-0"><strong>VS</strong></p> {{ucfirst(trans($tip->away_team))}}</td>
    </tr>
@endforeach

  </tbody>
</table>

<div class="text-center">
<a class="btn btn-sm btn-info" href="{{ route('tips')}}">view tips</a>
</div>
@else
<div>
  <p class="text-center text-danger">No tips available.Our team is working to upload sure bets.</p>
</div>
@endif


<div class="text-center font-weight-bold mt-5">
<h2 class="font-weight-bold">PREVIOUS PREDICTIONS </h2>
</div>
<table class="table table-striped tab-content text-center" id="tab-8">
  <thead class="bg-warning">
    <tr>
    <th scope="col">DATE</th>
    <th scope="col">MATCH</th>
    <th scope="col">PREDICTION</th>
    <th scope="col">RESULT</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($outcomes as $tip)
    <tr>
      <th>{{date('d F, Y', strtotime($tip->game_date))}}</th>
      <td class="color-orange-light">{{ucfirst(trans($tip->home_team))}} <p class="m-0 p-0"><strong>VS</strong></p> {{ucfirst(trans($tip->away_team))}}</td>
      <td class="color-orange-light">{{$tip->prediction->prediction_market}}</td>
      <td class="color-orange-light">{{$tip->outcome ? $tip->outcome->prediction_market : 'N/A'}}</td>
    </tr>
@endforeach
  </tbody>
</table>
<div class="text-center">
<a class="btn btn-sm btn-info" href="{{ route('previous')}}">More predictions</a>
</div>
</div>


@endsection
