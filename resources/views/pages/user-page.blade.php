@extends('dashboard.include.d-master')
@section('title', 'User Page')


@section('content')

@include('dashboard.user.showUser')
@include('dashboard.user.createUser')
@include('dashboard.user.updateUser')
@include('dashboard.user.deleteUser')


@endsection