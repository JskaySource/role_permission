
@include('layout.header')
@include('layout.menu')


@yield('content')

<div id="loader" class="LoadingOverlay d-none">
                    <div class="Line-Progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>



@include('layout.footer')