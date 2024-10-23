<nav class="navbar navbar-expand px-2 py-2">
                <form action="#" class="d-none d-sm-inline-block">

                </form>
                <div class="navbar-collapse collapse">
                    <h3 class="fw-bold">Admin Dashboard</h3>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="{{asset('image/account.png')}}" class="avatar img-fluid" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded " style="background-color:#0E2238;">
                                <ul>
                                    <li> <a href="#" class="text-white">{{ Auth::user()->name }}</a></li>
                                    <li> <a href="#" class="text-white">{{ Auth::user()->email }}</a></li>
                                    <li> 
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf                    
                                        <a href="route('logout')" class="text-white" onclick="event.preventDefault();
                                            this.closest('form').submit();">Logout</a>
                                        </form>                                    
                                    </li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>