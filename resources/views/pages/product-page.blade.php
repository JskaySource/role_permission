@extends('dashboard.include.d-master')
@section('title', 'Product page')


@section('content')

@include('dashboard.product.showProduct')
@include('dashboard.product.createProduct')
@include('dashboard.product.updateProduct')
@include('dashboard.product.deleteProduct')


@endsection