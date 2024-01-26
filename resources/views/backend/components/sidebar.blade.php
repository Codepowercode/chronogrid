{{--{{dd(auth()->user()->roles()->get())}}--}}
{{--{{dd(auth()->user()->can('dashboard_company_tab_deleted_companies'))}}--}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{asset('assets/custom/img/logo.png')}}" alt="AdminLTE Logo" class="elevation-3"
             style="opacity: .8;    margin: 0 auto;display: block;">
{{--        <span class="brand-text font-weight-light">Admin panel</span>--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->type === 'admin')
                    <img src="{{asset('assets/custom/img/admin-logo1.png')}}" class="elevation-2" alt="User Image" style="width: 3.1rem;">
                @else
                    <img src="{{asset('assets/custom/img/support-logo1.png')}}" class="elevation-2" alt="User Image" style="width: 3.1rem;">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block" style=" padding: 5px;">{{auth()->user()->name}}</a>
            </div>
        </div>
        @can('dashboard')
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @canany(['dashboard_company_tab', 'dashboard_company_access_tab', 'dashboard_company_blocked_tab', 'dashboard_company_tab_deleted_companies'])
                    <li class="nav-item has-treeview {{Route::currentRouteNamed(['company.index', 'company.access.index', 'company.block.index', 'company.create', 'company.edit', 'company.show', 'member.index', 'member.create', 'member.edit', 'get.deleted.company', 'show.deleted.company']) ? ' menu-open' : ''}}"> <!-- menu-open  -->
                        <a href="#" class="nav-link {{Route::currentRouteNamed(['company.index', 'company.access.index', 'company.block.index', 'company.create', 'company.edit', 'company.show', 'member.index', 'member.create', 'member.edit', 'get.deleted.company', 'show.deleted.company']) ? 'active' : ''}}"><!-- active  -->
                            <i class="nav-icon fas fa-send-backward"></i>
                            <p>
                                Companies
                                <i class="right fas fa-angle-left"></i>
                                @if($companiesCountGlobal > 0)
    {{--                                <span class="right badge badge-danger">New</span>--}}
                                    <span class="badge badge-info right">{{$companiesCountGlobal}}</span>
                                @endif
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('dashboard_company_tab')
                            <li class="nav-item">
                                <a href="{{route('company.index')}}" class="nav-link {{Route::currentRouteNamed(['company.index', 'company.create', 'company.edit', 'company.show', 'member.index', 'member.create', 'member.edit']) ? 'active' : ''}}"> <!-- active  -->
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Companies</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard_company_access_tab')
                            <li class="nav-item">
                                <a href="{{route('company.access.index')}}" class="nav-link {{Route::currentRouteNamed(['company.access.index']) ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Companies access</p>
                                    @if($companiesCountGlobal > 0)
    {{--                                    <span class="right badge badge-danger">New</span>--}}
                                        <span class="badge badge-info right">{{$companiesCountGlobal}}</span>
                                    @endif
                                </a>
                            </li>
                            @endcan
                            @can('dashboard_company_blocked_tab')
                            <li class="nav-item">
                                <a href="{{route('company.block.index')}}" class="nav-link {{Route::currentRouteNamed(['company.block.index']) ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Companies blocked</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard_company_tab_deleted_companies')
                                <li class="nav-item">
                                    <a href="{{route('get.deleted.company')}}" class="nav-link {{Route::currentRouteNamed(['get.deleted.company', 'show.deleted.company']) ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Deleted Companies</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('dashboard_subscription_tab')
                    <li class="nav-item">
                        <a href="{{route('subscription.index')}}" class="nav-link {{Route::currentRouteNamed(['subscription.index', 'subscription.create', 'subscription.edit']) ? 'active' : ''}}">
                            <i class=" nav-icon fas fa-handshake-o"></i>
                            <p>
                                Subscription
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('dashboard_auction_tab')
                    <li class="nav-item">
                        <a href="{{route('auction.index')}}" class="nav-link {{Route::currentRouteNamed(['auction.index', 'auction.show']) ? 'active' : ''}}">
                            <i class="nav-icon fa-solid fa-hand-holding-dollar"></i>
                            <p>
                                Auction
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('dashboard_product_verify_tab')
                    <li class="nav-item">
                        <a href="{{route('product.verify.index')}}" class="nav-link {{Route::currentRouteNamed(['product.verify.index', 'product.verify.show']) ? 'active' : ''}}">
                            <i class="nav-icon fas fa-file-plus"></i>
                            <p>
                                Product Verify
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('dashboard_listing_tab')
                    <li class="nav-item">
                        <a href="{{route('listing.index')}}" class="nav-link {{Route::currentRouteNamed(['listing.index', 'listing.create', 'listing.edit']) ? 'active' : ''}}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Listing
                            </p>
                        </a>
                    </li>
                    @endcan
                    @canany(['dashboard_permission_tab', 'dashboard_role_tab'])
                    <li class="nav-item has-treeview {{Route::currentRouteNamed(['permission.index', 'role.index', 'role.create', 'role.edit']) ? ' menu-open' : ''}}"> <!-- menu-open  -->
                        <a href="#" class="nav-link {{Route::currentRouteNamed(['permission.index', 'role.index', 'role.create', 'role.edit']) ? 'active' : ''}}"><!-- active  -->
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Role and Permission
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('dashboard_permission_tab')
                            <li class="nav-item">
                                <a href="{{route('permission.index')}}" class="nav-link {{Route::currentRouteNamed(['permission.index']) ? 'active' : ''}}"> <!-- active  -->
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permission</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard_role_tab')
                            <li class="nav-item">
                                <a href="{{route('role.index')}}" class="nav-link {{Route::currentRouteNamed(['role.index', 'role.create', 'role.edit']) ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('dashboard_support_tab')
                    <li class="nav-item">
                        <a href="{{route('support.index')}}" class="nav-link {{Route::currentRouteNamed(['support.index','support.create' ,'support.edit']) ? 'active' : ''}}">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>
                                Support
                            </p>
                        </a>
                    </li>
                    @endcan

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{url('/code/run/5')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-user-tag"></i>--}}
{{--                            <p>--}}
{{--                                Cash clear--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}


    {{-- ------------------------------------------------------------------------------------------------- --}}
    {{--                <li class="nav-item has-treeview menu-open">--}}
    {{--                    <a href="#" class="nav-link active">--}}
    {{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
    {{--                        <p>--}}
    {{--                            Dashboard--}}
    {{--                            <i class="right fas fa-angle-left"></i>--}}
    {{--                        </p>--}}
    {{--                    </a>--}}
    {{--                    <ul class="nav nav-treeview">--}}
    {{--                        <li class="nav-item">--}}
    {{--                            <a href="./index.html" class="nav-link active">--}}
    {{--                                <i class="far fa-circle nav-icon"></i>--}}
    {{--                                <p>Dashboard v1</p>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li class="nav-item">--}}
    {{--                            <a href="./index2.html" class="nav-link">--}}
    {{--                                <i class="far fa-circle nav-icon"></i>--}}
    {{--                                <p>Dashboard v2</p>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li class="nav-item">--}}
    {{--                            <a href="./index3.html" class="nav-link">--}}
    {{--                                <i class="far fa-circle nav-icon"></i>--}}
    {{--                                <p>Dashboard v3</p>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </li>--}}
    {{--                <li class="nav-item">--}}
    {{--                    <a href="pages/widgets.html" class="nav-link">--}}
    {{--                        <i class="nav-icon fas fa-th"></i>--}}
    {{--                        <p>--}}
    {{--                            Widgets--}}
    {{--                            <span class="right badge badge-danger">New</span>--}}
    {{--                        </p>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="nav-item has-treeview">--}}
    {{--                    <a href="#" class="nav-link">--}}
    {{--                        <i class="nav-icon fas fa-copy"></i>--}}
    {{--                        <p>--}}
    {{--                            Layout Options--}}
    {{--                            <i class="fas fa-angle-left right"></i>--}}
    {{--                            <span class="badge badge-info right">6</span>--}}
    {{--                        </p>--}}
    {{--                    </a>--}}
    {{--                    <ul class="nav nav-treeview">--}}
    {{--                        <li class="nav-item">--}}
    {{--                            <a href="pages/layout/top-nav.html" class="nav-link">--}}
    {{--                                <i class="far fa-circle nav-icon"></i>--}}
    {{--                                <p>Top Navigation</p>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li class="nav-item">--}}
    {{--                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">--}}
    {{--                                <i class="far fa-circle nav-icon"></i>--}}
    {{--                                <p>Top Navigation + Sidebar</p>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </li>--}}
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        @endcan
    </div>
    <!-- /.sidebar -->
</aside>
