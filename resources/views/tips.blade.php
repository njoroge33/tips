@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2 class="text-center">Today's Predictions </h2>
@if ($tips-> count())
<table class="table table-striped tab-content text-center" id="tab-8">
  <thead class="bg-warning">
    <tr>
    <th scope="col">DATE</th>
    <th scope="col">MATCH</th>
    <th scope="col">PREDICTION</th>

    </tr>
  </thead>
  <tbody>
  @foreach ($tips as $tip)
    <tr>
      <th>{{date("Y-m-d H:i:s", strtotime($tip->game_date))}}</th>
      <td class="color-orange-light">{{ucfirst(trans($tip->home_team))}} <p class="m-0 p-0"><strong>VS</strong></p> {{ucfirst(trans($tip->away_team))}}</td>
      <td class="color-orange-light">{{$tip->prediction_id}}</td>
    </tr>
@endforeach
  </tbody>
</table>
@endif 
</div>

@endsection
