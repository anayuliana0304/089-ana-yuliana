<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-solid fa-rainbow"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BloomBoutique</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item  {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item  {{ Request::is('customers', 'customers/*') ? 'active' : '' }}">
                <a class="nav-link" href="/customers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customers</span></a>
            </li>

            <li class="nav-item  {{ Request::is('flowers', 'flowers/*') ? 'active' : '' }}"">
                <a class="nav-link" href="/flowers">
                    <i class="fas fa-fw fa-solid fa-sun"></i>
                    <span>Flowers</span></a>
            </li>

            <li class="nav-item {{ Request::is('transactions', 'transactions/*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaction" aria-expanded="true" aria-controls="collapseTransaction">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Transaction</span>
                </a>
                <div id="collapseTransaction" class="collapse {{ Request::is('transactions', 'transactions/*') ? 'show' : '' }}" aria-labelledby="headingTransaction" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('transactions.create') }}">Sales</a>
                        <a class="collapse-item" href="{{ route('transactions.index') }}">History</a>
                    </div>
                </div>
            </li>

            @if(session('level') == 'admin')
            <hr class="sidebar-divider">
            <li class="nav-item {{ Request::is('users', 'users/*') ? 'active' : '' }}">
                <a class="nav-link" href="/users">
                    <i class="fas fa-fw fa-solid fa-user"></i>
                    <span>Users</span>
                </a>
            </li>
            @endif

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>