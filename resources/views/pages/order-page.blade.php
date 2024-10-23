@extends('dashboard.include.d-master')
@section('title', 'Order page')


@section('content')

@include('dashboard.invoice.showInvoice')
@include('dashboard.invoice.invoicedetails')
@include('dashboard.invoice.deleteInvoice')


@endsection