<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('image/icon.jpg')}}">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{asset('asset/css')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('asset/css')}}/animate.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('asset/fontawesome')}}/all.min.css">


    <link rel="stylesheet" href="{{asset('asset/css')}}/toastify.min.css">
    <link rel="stylesheet" href="{{asset('asset/css')}}/style.css">



    <link rel="stylesheet" href="{{asset('asset/css')}}/jquery.dataTables.min.css">


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</head>
<body>
