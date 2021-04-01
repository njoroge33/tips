@extends('layouts.app')

@section('content')
<div id="carouselExampleControls" class="carousel slide mb-5" data-ride="carousel">
  <div class="carousel-inner font-weight-bold" >
    <div class="carousel-item active">
      <img class="d-block w-100" style="height:50vh" src="https://res.cloudinary.com/grohealth/image/upload/$wpsize_!post-thumbnail!,w_1000,h_600,c_fill,g_auto/v1588088887/the-ball-stadion-football-the-pitch-46798.jpeg" alt="First slide">
      <div class="carousel-caption">
        <h5 class="font-weight-bold text-warning">99% Daily sure bets</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" style="height:50vh" src="https://cloudfront.penguin.co.in/wp-content/uploads/2018/06/FIFA_Header-scaled.jpg" alt="Second slide">
      <div class="carousel-caption">
        <h5 class="font-weight-bold text-warning">Sure bets for lower price</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" style="height:50vh" src="https://m.economictimes.com/thumb/msid-65210785,width-1200,height-900,resizemode-4,imgsize-343861/football1_gettyimages.jpg" alt="Third slide">
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

<div class="text-center font-weight-bold">
<h2>FEATURED MATCHES</h2>
</div>
<table class="table table-striped tab-content" id="tab-8">
  <thead class="bg-warning">
    <tr>
    <th scope="col">DATE</th>
    <th scope="col">LEGAUE</th>
    <th scope="col">MATCH</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>bjbjbj</th>
      <td class="color-orange-light">nbvbn</td>
      <td class="color-orange-light">vnbnmb</td>
     
    </tr>

    <tr>
      <th>bjbjbj</th>
      <td class="color-orange-light">nbvbn</td>
      <td class="color-orange-light">vnbnmb</td>
      
    </tr>

  </tbody>
</table>
<div class="text-center">
<a class="btn btn-sm btn-info" href="{{ route('login')}}">views tip</a>
</div>

<div class="text-center font-weight-bold mt-5">
<h2>PREVIOUS PREDICTIONS </h2>
</div>
<table class="table table-striped tab-content" id="tab-8">
  <thead class="bg-warning">
    <tr>
    <th scope="col">DATE</th>
    <th scope="col">MATCH</th>
    <th scope="col">PREDICTION</th>
    <th scope="col">RESULT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>bjbjbj</th>
      <td class="color-orange-light">nbvbn</td>
      <td class="color-orange-light">vnbnmb</td>
      <td class="color-orange-light">vnbnmb</td>
    </tr>

    <tr>
      <th>bjbjbj</th>
      <td class="color-orange-light">nbvbn</td>
      <td class="color-orange-light">vnbnmb</td>
      <td class="color-orange-light">vnbnmb</td>
    </tr>

  </tbody>
</table>
<div class="text-center">
<a class="btn btn-sm btn-info">More predictions</a>
</div>

@endsection