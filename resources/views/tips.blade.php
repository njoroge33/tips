@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2 class="text-center font-weight-bold">Today's Predictions </h2>
@if ($tips-> count())
<div class="table-responsive container">
<table class="table table-striped text-center m-0">
  <thead class="bg-warning">
    <tr>
    <th scope="col">DATE</th>
    <th scope="col">LEGAUE</th>
    <th scope="col">MATCH</th>
    <th scope="col">PREDICTION</th>

    </tr>
  </thead>
  <tbody>
  @foreach ($tips as $tip)
    <tr>
      <th>{{date('d F, Y (l)', strtotime($tip->game_date))}}</th>
      <td class="color-orange-light">{{ucfirst(trans($tip->league))}}</td>
      <td class="color-orange-light">{{ucfirst(trans($tip->home_team))}} <p class="m-0 p-0"><strong>VS</strong></p> {{ucfirst(trans($tip->away_team))}}</td>
      
      <td class="color-orange-light">{{$tip->prediction->prediction_market}}</td>
    </tr>
@endforeach
  </tbody>
</table>
</div>

@endif 
</div>

@endsection
