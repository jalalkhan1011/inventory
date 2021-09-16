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


    <li class="sidenav-item">
{{--        @if(Auth::user()->hasRole('Admin'))--}}
        <a href="javascript:" class="sidenav-link sidenav-toggle">
            <i class="sidenav-icon feather icon-box"></i>
            <div>User & role</div>
        </a>
        <ul class="sidenav-menu">
            <li class="sidenav-item">
                <a href="{{ url('admin/users') }}" class="sidenav-link">
                    <div>Manage Users</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ url('admin/roles') }}" class="sidenav-link">
                    <div>Manage Roles</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ url('admin/profiles') }}" class="sidenav-link">
                    <div>Manage Profiles</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{ url('admin/employees') }}" class="sidenav-link">
                    <div>Manage Employees</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="bui_dropdowns.html" class="sidenav-link">
                    <div>Dropdowns</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="bui_pagination.html" class="sidenav-link">
                    <div>Pagination and breadcrumbs</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="bui_progress.html" class="sidenav-link">
                    <div>Progress bars</div>
                </a>
            </li>
        </ul>
{{--        @endif--}}
    </li>


    <li class="sidenav-divider mb-1"></li>
    <li class="sidenav-header small font-weight-semibold">Forms & Tables</li>
    <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
            <i class="sidenav-icon feather icon-clipboard"></i>
            <div>Forms</div>
        </a>
        <ul class="sidenav-menu">
            <li class="sidenav-item">
                <a href="forms_layouts.html" class="sidenav-link">
                    <div>Layouts and elements</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="forms_input-groups.html" class="sidenav-link">
                    <div>Input groups</div>
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
