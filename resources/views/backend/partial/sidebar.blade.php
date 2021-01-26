<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title text-center">BAIUST Inventory Management System</li>
                <li>
                    <a href="/home" class="waves-effect {{ request()->is('/home') ? 'mm-active' : '' }}">
                        <i class="ti-home"></i><span>Dashboard</span>
                    </a>
                </li>
                {{-- user navigation --}}
                @role('super-admin|admin')
                    <li class="{{ request()->is('admin/acl-role-edit/*') ? 'mm-active' : '' }} {{ request()->is('admin/acl-permission-edit/*') ? 'mm-active' : '' }} {{ request()->is('admin/acl-manage/*') ? 'mm-active' : '' }}">
                        <a href="javascript:void(0);" class="waves-effect {{ request()->is('admin/user') ? 'mm-active' : '' }}">
                            <i class="ti-user"></i>
                            <span> User <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span>
                        </a>
                        <ul class="submenu">
                            @can('all-users')
                                <li><a href="{{ route('user.index') }}">All Users</a></li>
                            @endcan
                            @can('acl-list')
                                <li><a href="{{ route('acl.index') }}">ACL List</a></li>
                            @endcan
                            
                        </ul>
                    </li>
                @endrole
                {{-- Product Manage --}}
                <li>
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fas fa-box-open"></i>
                        <span> Product Manage <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span>
                    </a>
                    <ul class="submenu">
                        @role('super-admin|admin')
                            @can('all-vendor')
                                <li><a href="{{ route('vendor.index') }}">Vendor</a></li>
                            @endcan
                            @can('all-category')
                                <li><a href="{{ route('category.index') }}">Product Category</a></li>
                            @endcan
                            @can('all-storage')
                                <li><a href="{{ route('storage.index') }}">Storage</a></li>
                            @endcan
                        @endrole
                        
                        @can('all-product')
                            <li><a href="{{ route('product.index') }}">Products</a></li>
                        @endcan
                    </ul>
                </li>
                {{-- Stock Management --}}
                @role('super-admin|admin')
                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fas fa-map-signs"></i>
                            <span> Stock Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span>
                        </a>
                        <ul class="submenu">
                            @can('stock-history')
                                <li><a href="{{ route('stock.index') }}">Stock History</a></li>
                            @endcan
                            @can('all-invoice')
                                <li><a href="{{ route('invoice.index') }}">Invoices</a></li>
                            @endcan
                            @can('internal-transfer')
                                <li><a href="{{ route('transfer.index') }}">Internal Transfer</a></li>
                            @endcan
                            
                        </ul>
                    </li>
                @endrole
                {{-- Report --}}
                @role('super-admin|admin')
                    <li>
                        <a href="javascript:void(0);" class="waves-effect {{ request()->is('admin/user') ? 'mm-active' : '' }}">
                            <i class="fas fa-file-invoice"></i>
                            <span> Report <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span>
                        </a>
                        <ul class="submenu">
                            @can('by-department')
                                <li><a href="{{ route('r_by_dept.index') }}">By Department</a></li>
                            @endcan
                            @can('by-lab')
                                <li><a href="{{ route('r_by_lab.index') }}">By Laboratory</a></li> 
                            @endcan
                            @can('by-date')
                                <li><a href="#">By Date</a></li>
                            @endcan
                        </ul>
                    </li>
                @endrole
                {{-- Submit Requisition --}}
                <li>
                    <a href="javascript:void(0);" class="waves-effect {{ request()->is('requisition/submit') ? 'mm-active' : '' }}">
                        <i class="fas fa-paper-plane"></i>
                        <span> Requisition <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span>
                    </a>
                    <ul class="submenu">
                        @can('requisition-submit')
                            <li><a href="{{ route('submit.index') }}">Submit</a></li>
                        @endcan
                        @role('super-admin|admin|head')
                            @can('view-approved')
                                <li><a href="{{ route('submit.approve_index') }}">Approve</a></li>
                            @endcan
                            @can('view-submitted')
                                <li><a href="{{ route('approved.final') }}">Submitted</a></li>
                            @endcan
                        @endrole
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
