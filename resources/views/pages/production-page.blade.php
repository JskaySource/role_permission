@extends('dashboard.include.d-master')
@section('title', 'Production History')


@section('content')

@include('dashboard.production.showFilling')
@include('dashboard.production.createFilling')
@include('dashboard.production.deleteFilling')
@include('dashboard.production.updateFilling')

@endsection