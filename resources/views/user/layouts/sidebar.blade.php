<ul class="navbar-nav iq-main-menu" id="sidebar-menu">
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
            <span class="default-icon">Home</span>
            <span class="mini-icon" data-bs-toggle="tooltip" title="Home" data-bs-placement="right">-</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">
            <i class="icon" data-bs-toggle="tooltip" title="Dashboard" data-bs-placement="right">
                <svg width="20" class="icon-20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">Dashboard</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#horizontal-menu" role="button" aria-expanded="false" aria-controls="horizontal-menu">
            <i class="icon" data-bs-toggle="tooltip" title="Menu Style" data-bs-placement="right">
                <svg width="20" class="icon-20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M13.6663 6.99992C13.6663 10.6826 10.6817 13.6666 6.99967 13.6666C3.31767 13.6666 0.333008 10.6826 0.333008 6.99992C0.333008 3.31859 3.31767 0.333252 6.99967 0.333252C10.6817 0.333252 13.6663 3.31859 13.6663 6.99992Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.01351 6.20239C3.57284 6.20239 3.21484 6.56039 3.21484 6.99973C3.21484 7.43973 3.57284 7.79839 4.01351 7.79839C4.45418 7.79839 4.81218 7.43973 4.81218 6.99973C4.81218 6.56039 4.45418 6.20239 4.01351 6.20239ZM6.99958 6.20239C6.55891 6.20239 6.20091 6.56039 6.20091 6.99973C6.20091 7.43973 6.55891 7.79839 6.99958 7.79839C7.44024 7.79839 7.79824 7.43973 7.79824 6.99973C7.79824 6.56039 7.44024 6.20239 6.99958 6.20239ZM9.18718 6.99973C9.18718 6.56039 9.54518 6.20239 9.98584 6.20239C10.4265 6.20239 10.7845 6.56039 10.7845 6.99973C10.7845 7.43973 10.4265 7.79839 9.98584 7.79839C9.54518 7.79839 9.18718 7.43973 9.18718 6.99973Z" fill="currentColor"/>
                </svg>
            </i>
            <span class="item-name">User Task</span>
            <i class="right-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" class="icon-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </i>
        </a>
        <ul class="sub-nav collapse" id="horizontal-menu" data-bs-parent="#sidebar-menu">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.tasks.pending') }}">
                  <i class="icon">
                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <g>
                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                            </g>
                        </svg>
                    </i>
                  <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Horizontal" data-bs-placement="right"> H </i>
                  <span class="item-name"> Pendin Task </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.tasks.inProgress') }}">
                    <i class="icon svg-icon">
                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <g>
                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                            </g>
                        </svg>
                    </i>
                    <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Dual Compact" data-bs-placement="right"> D </i>
                    <span class="item-name">In progress Task</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.tasks.completed') }}">
                    <i class="icon">
                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <g>
                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                            </g>
                        </svg>
                    </i>
                    <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Boxed Horizontal" data-bs-placement="right"> B </i>
                    <span class="item-name">Completed Task</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
