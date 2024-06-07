<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
    <li class="nav-item active ps-4">
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

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ps-4">
        <a class="nav-link collapsed" href="{{ route('admin.users.index') }}" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-user"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item ps-4">
        <a class="nav-link collapsed" href="{{ route('products.index') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa-solid fa-burger"></i>
            <span>Food</span>
        </a>
    </li>
    <li class="nav-item ps-4">
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

    <li class="nav-item ps-4">
        <a class="nav-link collapsed" href="{{ route('orders.index') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Order</span>
            @if (!$showOrders && $newOrdersCount > 0)
                <span class="ms-4 border-2 p-1" style="color: red; border-color: red;">
                    <span style="color: yellowgreen;">{{ $newOrdersCount }} </span> New !!
                </span>
            @endif
        </a>
    </li>
</ul>
<!-- End of Sidebar -->
