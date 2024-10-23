@extends('dashboard.include.d-master')
@section('title', 'Dealer History')

@section('content')
@include('dashboard.dealer.showDealer')
@include('dashboard.dealer.createDealer')
@include('dashboard.dealer.updateDealer')
@include('dashboard.dealer.deleteDealer')

@endsection