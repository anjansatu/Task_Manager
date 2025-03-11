<ul class="navbar-nav iq-main-menu" id="sidebar-menu">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span class="item-name">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.changePassword') ? 'active' : '' }}" href="{{ route('user.changePassword') }}">
            <i class="fas fa-lock"></i>
            <span class="item-name">Change Password</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('deposits.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#deposits-menu" role="button" aria-expanded="false" aria-controls="deposits-menu">
            <i class="fas fa-wallet"></i>
            <span class="item-name">Deposits</span>
            <i class="right-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" class="icon-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </i>
        </a>
        <ul class="sub-nav collapse" id="deposits-menu" data-bs-parent="#sidebar-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('deposits.index') ? 'active' : '' }}" href="{{ route('deposits.index') }}">All Deposits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('deposits.create') ? 'active' : '' }}" href="{{ route('deposits.create') }}">New Deposit</a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">
            <i class="fas fa-user"></i>
            <span class="item-name">Profile</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.changePassword') ? 'active' : '' }}" href="{{ route('user.changePassword') }}">
            <i class="fas fa-lock"></i>
            <span class="item-name">Change Password</span>
        </a>
    </li>
</ul>
