@extends('layouts.app')

@section('content')
@include('partials.messages')
<div class="container">

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

</div>


@endsection
