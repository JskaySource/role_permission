<aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars" style="color:white"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="{{route('dashboard')}}">ZARA</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{route('user-page')}}" class="sidebar-link">
                        <i class="fa-regular fa-user"></i>
                        <span>UserList</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('productPage')}}" class="sidebar-link">
                        <i class="fa-brands fa-product-hunt"></i>
                        <span>ProductList</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('dealerPage')}}" class="sidebar-link">
                        <i class="fa-solid fa-people-group"></i>
                        <span>DealerList</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('productionPage')}}" class="sidebar-link">
                        <i class="fa-solid fa-jar"></i>
                        <span>Production</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#show" aria-expanded="false" aria-controls="show">
                        <i class="fas fa-angle-double-right"></i>
                        <span>OrderHistory</span>
                    </a>
                    <ul id="show" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                            <a href="{{route('invoicePage')}}" class="sidebar-link">Order Create</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('orderPage')}}" class="sidebar-link">Order List</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('deliveryPage')}}" class="sidebar-link">
                        <i class="fa-solid fa-dolly"></i>
                        <span>DeliveryHistory</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="fas fa-angle-double-right"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="fas fa-angle-double-right"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-regular fa-message"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('settingPage')}}" class="sidebar-link">
                        <i class="fa-solid fa-gear"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                         @csrf                    
                    <a href="route('logout')" class="sidebar-link" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
                </form>
            </div>
        </aside>

        