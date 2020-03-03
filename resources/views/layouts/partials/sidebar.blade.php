<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center h3">
        {{--        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
        {{--             style="opacity: .8">--}}
        <span class="brand-text font-weight-light">Sohnen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/user1.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(auth()->user()->role ==='admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>
                            Admin Area
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}"
                                class="{{(request()->is('users') ? 'nav-link active' :  'nav-link')}}">
                                <i class="fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{route('products.index')}}"
                        class="{{(request()->is('products') ? 'nav-link active' : 'nav-link')}}">
                        <i class="fas fa-box-open"></i>
                        <p>
                            Product Catalog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('quotations.index')}}"
                        class="{{(request()->is('quotations') ? 'nav-link active' : 'nav-link')}}">
                        <i class="fas fa-file-signature"></i>
                        <p>
                            Quotations
                        </p>
                    </a>
                </li>
                @if(auth()->user()->role ==='admin')
                <li class="nav-item">
                    <a href="{{route('purchase.index')}}"
                        class="{{(request()->is('purchase') ? 'nav-link active' : 'nav-link')}}">
                        <i class="fas fa-shopping-basket"></i>
                        <p>
                            Purchase History
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role ==='admin')
                <li class="nav-item">
                    <a href="{{route('sku.index')}}"
                        class="{{(request()->is('sku') ? 'nav-link active' : 'nav-link')}}">
                        <i class="fas fa-info-circle"></i>
                        <p>
                            Sku Details
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role ==='admin')
                <li class="nav-item">
                    <a href="{{route('asm.index')}}"
                        class="{{(request()->is('asm') ? 'nav-link active' : 'nav-link')}}">
                        <i class="fas fa-directions"></i>
                        <p>
                            Amazon SKU Mappining
                        </p>
                    </a>
                </li>
                @endif

                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>