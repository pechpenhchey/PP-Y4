<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #ce1212;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div class="sidebar-brand-text mx-4">{{ Auth::user()->name }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ps-4 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-tachometer fa-fw me-2" style="font-size: 1rem;"></i>
                <span>Dashboard</span>
            </div>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading ms-4">
        Interface
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item ps-4 {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('admin.users.index') }}" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-user"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Nav Item - Food -->
    <li class="nav-item ps-4 {{ request()->routeIs('products.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('products.index') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa-solid fa-burger"></i>
            <span>Food</span>
        </a>
    </li>

    <!-- Nav Item - Category -->
    <li class="nav-item ps-4 {{ request()->routeIs('categories.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('categories.index') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa-solid fa-table-list"></i>
            <span>Category</span>
        </a>
    </li>

    @php
        $newOrdersCount = app('App\Http\Controllers\OrderController')->countNewOrders();
        $showOrders = session('show_orders');
    @endphp

    <!-- Nav Item - Order -->
    <li class="nav-item ps-4 {{ request()->routeIs('orders.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('orders.index') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Order</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->