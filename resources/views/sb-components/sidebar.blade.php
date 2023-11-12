<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-utensils"></i> --}}
        </div>
        <div class="sidebar-brand-text mx-3">Invoice Manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu
    </div>

    {{-- Nav Item - Tickets --}}
    <li class="nav-item {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('invoices.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Invoices List</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
{{-- 
    <li class="nav-item {{ request()->routeIs('claim') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('claim') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Claim E-Ticket</span></a>
    </li> --}}

    {{-- <li class="nav-item {{ request()->routeIs('scan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('scan') }}">
            <i class="fas fa-fw fa-qrcode"></i>
            <span>Scan</span></a>
    </li> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ url('sb/img/undraw_rocket.svg') }}" alt="...">
        <p class="text-center mb-2"><strong>Kerja kerja kerja!</strong>
        </p>
        <a class="btn btn-success btn-sm" href="">Kerja bang</a>
    </div>

</ul>
<!-- End of Sidebar -->
