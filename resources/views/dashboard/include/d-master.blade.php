<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>


    <link rel="stylesheet" href="{{asset('asset/css')}}/bootstrap.min.css">
    <!-- fontawesome -->
    <!-- <link rel="stylesheet" href="{{asset('asset/fontawesome')}}/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
	<link rel="stylesheet" href="{{asset('asset/css')}}/dashboard_style.css">
    <script src="{{asset('asset/js')}}/bootstrap.bundle.min.js"></script>

    <!-- axios for loading data in data table -->
    <script src="{{asset('asset/js')}}/axios.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->

    <!-- for toastify massege -->
    <link rel="stylesheet" href="{{asset('asset/css')}}/toastify.min.css">

  
    <!-- for data table funcionality -->
    <link rel="stylesheet" href="{{asset('asset/css')}}/jquery.dataTables.min.css">
    
</head>
<body>
    <div class="wrapper">


    <!-- Added Side  navber -->
    @include('dashboard.include.aside')

        <div class="main">

            <!-- Added navber -->
        @include('dashboard.include.d-nav')

    <!-- This is content section, for loading content -->
        @yield('content')


           



<!-- <footer class="footer mt-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 text-start ">
                            <a class="text-white" href=" #">
                                <strong>Zara</strong>
                            </a>
                        </div>
                        <div class="col-6 text-end d-none d-md-block">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a class="text-white" href="#">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white" href="#">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white" href="#">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> -->

            





        </div>
    </div>
 
   
   
   <script src="{{asset('asset/js')}}/jquery3.7.min.js"></script>
    <!-- fontawesome -->
    <!-- <script src="{{asset('asset/fontawesome')}}/fontawesome.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js"></script>
    <!-- for data table funcionality -->
    <script src="{{asset('asset/js')}}/jquery.dataTables.min.js"></script>	
    <!-- default dashboard javascript -->
	<script src="{{asset('asset/js')}}/dashboard_script.js"></script>
    <!-- custom javascript code -->
    <script src="{{asset('asset/js')}}/script.js"></script>
    <!-- for toastify massege -->
    <script src="{{asset('asset/js')}}/toastify-js.js"></script>    
</body>
</html>