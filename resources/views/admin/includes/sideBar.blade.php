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
    <li class="sidenav-item active">
        <a href="index-2.html" class="sidenav-link">
            <i class="sidenav-icon feather icon-home"></i>
            <div>Dashboards</div>
            <div class="pl-1 ml-auto">
                <div class="badge badge-danger">Hot</div>
            </div>
        </a>
    </li>

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">User Setting</li>


    <li class="sidenav-item {{ request()->is('admin/*') ? 'open' :'' }}">
{{--        @if(Auth::user()->hasRole('Admin'))--}}
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('admin/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-box"></i>
            <div>User & role</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('admin/*') ? 'open' :'' }}" aria-expanded="{{ request()->is('admin/*') ? 'true' :'false' }}">
            <li class="sidenav-item">
                <a href="{{ route('users.index') }}" class="sidenav-link {{ request()->is('admin/users*') ? 'active' : '' }}">//* its use for selected and mark user menu for all user menu route
                    <div>Manage Users</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('roles.index') }}" class="sidenav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                    <div>Manage Roles</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('profiles.index') }}" class="sidenav-link {{ request()->is('admin/profiles*') ? 'active' : '' }}">
                    <div>Manage Profiles</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('employees.index') }}" class="sidenav-link {{ request()->is('admin/employees*') ? 'active' : '' }}">
                    <div>Manage Employees</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('suppliers.index') }}" class="sidenav-link {{ request()->is('admin/suppliers*') ? 'active' : '' }}">
                    <div>Manage Supplier</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('customers.index') }}" class="sidenav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                    <div>Manage Customer</div>
                </a>
            </li>
        </ul>
{{--        @endif--}}
    </li>

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Product Setting</li>
    <li class="sidenav-item {{ request()->is('product-setting/*') ? 'open' :'' }}">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('product-setting/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-clipboard"></i>
            <div>Product</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('product-setting/*') ? 'open' :'' }}"  aria-expanded="{{ request()->is('product-setting/*') ? 'true' :'false' }}">
            <li class="sidenav-item">
                <a href="{{ route('categories.index') }}" class="sidenav-link {{ request()->is('product-setting/categories*') ? 'active' : '' }}">
                    <div>Category</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('brands.index') }}" class="sidenav-link {{ request()->is('product-setting/brands*') ? 'active' : '' }}">
                    <div>Brand</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ route('units.index') }}" class="sidenav-link {{ request()->is('product-setting/units*') ? 'active' : '' }}">
                    <div>Unit</div>
                </a>
            </li>
        </ul>
    </li>


    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Product</li>
    <li class="sidenav-item {{ request()->is('product-management/*') ? 'open' :'' }}">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="collapse" aria-expanded="{{ request()->is('product-management/*') ? 'true' :'false' }}">
            <i class="sidenav-icon feather icon-clipboard"></i>
            <div>Product Management</div>
        </a>
        <ul class="sidenav-menu collapse {{ request()->is('product-management/*') ? 'open' :'' }}"  aria-expanded="{{ request()->is('product-management/*') ? 'true' :'false' }}">
            <li class="sidenav-item">
                <a href="{{ route('products.index') }}" class="sidenav-link {{ request()->is('product-management/products*') ? 'active' : '' }}">
                    <div>Products Purchase</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ url('product-management/sales') }}" class="sidenav-link {{ request()->is('product-management/sales*') ? 'active' : '' }}">
                    <div>Products Sale</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="sidenav-item">
        <a href="tables_bootstrap.html" class="sidenav-link">
            <i class="sidenav-icon feather icon-grid"></i>
            <div>Tables</div>
        </a>
    </li>

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Icons</li>
    <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
            <i class="sidenav-icon feather icon-feather"></i>
            <div>Icons</div>
        </a>
        <ul class="sidenav-menu">
            <li class="sidenav-item">
                <a href="icons_feather.html" class="sidenav-link">
                    <div>Feather</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="icons_linearicons.html" class="sidenav-link">
                    <div>Linearicons</div>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Pages</li>
    <li class="sidenav-item">
        <a href="pages_authentication_login-v1.html" class="sidenav-link">
            <i class="sidenav-icon feather icon-lock"></i>
            <div>Login</div>
        </a>
    </li>
    <li class="sidenav-item">
        <a href="pages_authentication_register-v1.html" class="sidenav-link">
            <i class="sidenav-icon feather icon-user"></i>
            <div>Signup</div>
        </a>
    </li>
    <li class="sidenav-item">
        <a href="pages_faq.html" class="sidenav-link">
            <i class="sidenav-icon feather icon-anchor"></i>
            <div>FAQ</div>
        </a>
    </li>
</ul>
