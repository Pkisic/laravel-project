<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index.index')}}" class="brand-link">
        <img src="{{url('themes/admin/dist/img/AdminLTELogo.png')}}" alt="Cubes School Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('Cubes School')</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('Sizes')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.sizes.index')}}" 
                               class="nav-link @if(\Request::route()->getName()=='admin.sizes.index') active @endif"
                               
                               >
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Sizes List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.sizes.add')}}"
                               class="nav-link @if(\Request::route()->getName()=='admin.sizes.add') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Size')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('Categories')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.product_categories.index')}}"
                               class="nav-link @if(\Request::route()->getName()=='admin.product_categories.index') active @endif"
                               >
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Categories List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.product_categories.add')}}" 
                               class="nav-link @if(\Request::route()->getName()=='admin.product_categories.add') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Categories')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('Brands')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.brands.index')}}" 
                               class="nav-link @if(\Request::route()->getName()=='admin.brands.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Brands List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.brands.add')}}" 
                               class="nav-link @if(\Request::route()->getName()=='admin.brands.add') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Brands')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('Products')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" 
                               class="nav-link @if(\Request::route()->getName()=='admin.products.index') active @endif"
                               
                               >
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Products List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.add')}}"
                               class="nav-link @if(\Request::route()->getName()=='admin.products.add') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Product')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('Users')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" 
                               class="nav-link @if(\Request::route()->getName()=='admin.users.index') active @endif"
                               
                               >
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Users List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.add')}}"
                               class="nav-link @if(\Request::route()->getName()=='admin.users.add') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add User')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
