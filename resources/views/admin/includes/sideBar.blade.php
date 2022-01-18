<div class="app-brand demo">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('back-end/assets/img/logo.png') }}" alt="Brand Logo" class="img-fluid" />
                </span>
    <a href="index-2.html" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Empire</a>
    <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
        <i class="ion ion-md-menu align-middle"></i>
    </a>
</div>
<div class="sidenav-divider mt-0"></div>

<ul class="sidenav-inner py-1">
    <li class="sidenav-item">
        <a href="{{route('home')}}" class="sidenav-link {{ request()->is('home*') ? 'active' : '' }}">
            <i class="sidenav-icon feather icon-home"></i>
            <div>Dashboards</div>
            <div class="pl-1 ml-auto">
                <div class="badge badge-danger"></div>
            </div>
        </a>
    </li>

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">User Setting</li>


    <li class="sidenav-item {{ request()->is('admin/*') ? 'open' :'' }}">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('admin/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-box"></i>
            <div>User & role</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('admin/*') ? 'open' :'' }}" aria-expanded="{{ request()->is('admin/*') ? 'true' :'false' }}">
            @if(Auth::user()->hasRole('Admin'))
                <li class="sidenav-item">
                    <a href="{{ route('users.index') }}" class="sidenav-link {{ request()->is('admin/users*') ? 'active' : '' }}"> <!-- '/*' it's use for selected and mark user menu for all user menu route -->
                        <i class="fa fa-users"></i>
                        <div class="ml-1">Manage Users</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('roles.index') }}" class="sidenav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i>
                        <div class="ml-1">Manage Roles</div>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                <li class="sidenav-item">
                    <a href="{{ route('employees.index') }}" class="sidenav-link {{ request()->is('admin/employees*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i>
                        <div class="ml-1">Manage Employees</div>
                    </a>
                </li>
            @endif
            <li class="sidenav-item">
                <a href="{{ route('suppliers.index') }}" class="sidenav-link {{ request()->is('admin/suppliers*') ? 'active' : '' }}">
                    <i class="fas fa-user-tag"></i>
                    <div class="ml-1">Manage Supplier</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="sidenav-item">
        <a href="{{ route('profiles.index') }}" class="sidenav-link {{ request()->is('profiles*') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i>
            <div class="ml-1">Manage Profiles</div>
        </a>
    </li>
    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'))
    <li class="sidenav-item">
        <a href="{{ route('customers.index') }}" class="sidenav-link {{ request()->is('customers*') ? 'active' : '' }}"><!-- * use's after url to active single url -->
            <i class="fas fa-user-check"></i>
            <div class="ml-1">Manage Customer</div>
        </a>
    </li>
    @endif

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Product Setting</li>
    <li class="sidenav-item {{ request()->is('product-setting/*') ? 'open' :'' }}">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('product-setting/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-settings"></i>
            <div>Product</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('product-setting/*') ? 'open' :'' }}"  aria-expanded="{{ request()->is('product-setting/*') ? 'true' :'false' }}">
            @if(Auth::user()->hasRole('Admin'))
                <li class="sidenav-item">
                    <a href="{{ route('categories.index') }}" class="sidenav-link {{ request()->is('product-setting/categories*') ? 'active' : '' }}">
                        <i class="fas fa-th-list"></i>
                        <div class="ml-1">Category</div>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager') || Auth::user()->hasRole('Employee'))
                <li class="sidenav-item">
                    <a href="{{ route('brands.index') }}" class="sidenav-link {{ request()->is('product-setting/brands*') ? 'active' : '' }}">
                        <i class="far fa-copyright"></i>
                        <div class="ml-1">Brand</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('units.index') }}" class="sidenav-link {{ request()->is('product-setting/units*') ? 'active' : '' }}">
                        <i class="fa fa-weight"></i>
                        <div class="ml-1">Unit</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>


    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Product</li>
    <li class="sidenav-item {{ request()->is('product-management/*') ? 'open' :'' }}">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('product-management/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-shopping-cart"></i>
            <div>Product Management</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('product-management/*') ? 'open' :'' }}"  aria-expanded="{{ request()->is('product-management/*') ? 'true' :'false' }}">
            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                <li class="sidenav-item">
                    <a href="{{ route('products.index') }}" class="sidenav-link {{ request()->is('product-management/products*') ? 'active' : '' }}">
                        <i class="fas fa-cart-plus"></i>
                        <div class="ml-1">Products Purchase</div>
                    </a>
                </li>
            @endif
            <li class="sidenav-item">
                <a href="{{ url('product-management/sales') }}" class="sidenav-link {{ request()->is('product-management/sales*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="ml-1">Products Sale</div>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Stock</li>
    <li class="sidenav-item {{ request()->is('stock/*') ? 'open' :'' }}">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('stock/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-shopping-cart"></i>
            <div>Stock Listing</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('stock/*') ? 'open' :'' }}"  aria-expanded="{{ request()->is('stock/*') ? 'true' :'false' }}">
            <li class="sidenav-item">
                <a href="{{ route('currentStock') }}" class="sidenav-link {{ request()->is('stock/current-stock*') ? 'active' : '' }}">
                    <i class="fas fa-cart-plus"></i>
                    <div class="ml-1">Current stock</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="#" class="sidenav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="ml-1">Purchase Stock</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="#" class="sidenav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="ml-1">Sell stock</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="#" class="sidenav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="ml-1">Low stock</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="#" class="sidenav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="ml-1">Expire stock</div>
                </a>
            </li>
        </ul>
    </li>

</ul>
