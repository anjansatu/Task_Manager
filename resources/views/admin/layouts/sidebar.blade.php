<ul class="navbar-nav iq-main-menu" id="sidebar-menu">
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
            <span class="default-icon">Home</span>
            <span class="mini-icon" data-bs-toggle="tooltip" title="Home" data-bs-placement="right">-</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
            <i class="icon" data-bs-toggle="tooltip" title="Dashboard">
                <svg width="20" class="icon-20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2Z" fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">Dashboard</span>
        </a>
    </li>

    <!-- Profile -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.ssns.index') }}">
            <i class="icon" data-bs-toggle="tooltip" title="Profile"></i>
            <span class="item-name">SSN</span>
        </a>
    </li>

    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="icon" data-bs-toggle="tooltip" title="Users"></i>
            <span class="item-name">Users</span>
        </a>
    </li>

    <!-- Deposits -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.deposits.index') }}">
            <i class="icon" data-bs-toggle="tooltip" title="Deposits"></i>
            <span class="item-name">Deposits</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.method') }}">
            <i class="icon" data-bs-toggle="tooltip" title="Deposits"></i>
            <span class="item-name">Deposits Methods</span>
        </a>
    </li>


    <!-- Notifications -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.notify.user', ['taskId' => '1']) }}">
            <i class="icon" data-bs-toggle="tooltip" title="Notify Users"></i>
            <span class="item-name">Notify Users</span>
        </a>
    </li>

    <!-- Price -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.price.index') }}">
            <i class="icon" data
            -bs-toggle="tooltip" title="Price"></i>
            <span class="item-name">Price</span>
        </a>
    </li>
</ul>
