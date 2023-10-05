<ul class="navbar-nav bg-white sidebar sidebar-light accordion shadow-sm" id="accordionSidebar">

    <a class="sidebar-brand d-flex text-white align-items-center bg-primary justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><span class="font-weight-bolder">ADMIN</span>PANEL</div>
    </a>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Member
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Member</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
