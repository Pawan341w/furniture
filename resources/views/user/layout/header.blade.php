<!-- Navbar partial -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <!-- Logo section -->
    <div class="navbar-brand-wrapper d-none d-md-flex align-items-center justify-content-start">

        <!-- Desktop Logo -->
        <a class="navbar-brand brand-logo d-none d-md-block" href="/">
            <img src="{{ get_setting('logo') }}" alt="logo" />
        </a>
        <!-- Mobile Logo -->
        <!--<a class="navbar-brand brand-logo-mini d-md-none" href="/">-->
        <!--    <img src="{{ get_setting('mini_logo') }}" alt="mini logo" />-->
        <!--</a>-->
    </div>

    <!-- Desktop Menu -->
    <div class="navbar-menu-wrapper d-none d-md-flex justify-content-between align-items-center flex-grow-1">
        <!-- Mobile toggle (hidden on desktop) -->
        <button class="navbar-toggler navbar-toggler align-self-center d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
            <span class="mdi mdi-menu"></span>
        </button>

        <!-- Search Bar -->
        <div class="search-field">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form>
        </div>

        <!-- Right Icons -->
        <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
            <!-- Profile -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('assets/images/faces/face1.jpg') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text d-none d-md-block">
                        <p class="mb-1 text-black">{{ auth()->user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-account-edit me-2 text-primary"></i> Edit Profile
                    </a>
                </div>
            </li>

            <!-- Wallet -->
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="walletDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-wallet-outline"></i>
                    <img src="{{ asset('assets/images/icons/coin.png') }}" alt="Scan QR Code" style="width: 20px; height: 20px;" />
                    {{ num_format(auth()->user()->wallet) }}
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="walletDropdown">
                    <h6 class="p-3 mb-0">My Wallet</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-item-content">
                            <p class="text-gray mb-0">1 <img src="{{ asset('assets/images/icons/coin.png') }}" style="width: 20px;" /> = {{ get_setting('coin') }} ₹</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-cash text-success" style="font-size: 28px;"></i>
                        </div>
                        <div class="preview-item-content">
                            <p class="text-gray mb-0">
                                <img src="{{ asset('assets/images/icons/coin.png') }}" style="width: 20px;" />
                                {{ num_format(auth()->user()->wallet) }}
                            </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center" href="{{ route('wallet.history') }}">View Wallet History</a>
                </div>
            </li>

            <!-- Logout -->
            <li class="nav-item nav-logout">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>
        </ul>
    </div>

    
    <!-- Mobile Compact Menu -->
<div class="navbar-menu-wrapper d-flex d-md-none justify-content-between align-items-center flex-grow-1 px-2">
    <!-- Left: Logo -->
    <a class="navbar-brand p-0 m-0" href="/">
        <img src="{{ get_setting('mini_logo') }}" alt="logo" style="height: 35px;">
    </a>

    <!-- Right Side: Profile, Wallet, Menu -->
    <div class="d-flex align-items-center gap-3">

        <!-- Profile (left of menu button) -->
        <a href="{{ route('profile.edit') }}">
            <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('assets/images/faces/face1.jpg') }}"
                 alt="image" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
        </a>

        <!-- Wallet (left of menu button) -->
        <a href="{{ route('wallet.history') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('assets/images/icons/coin.png') }}" style="width: 18px; height: 18px; margin-right: 3px;" />
            <span style="font-size: 13px;">{{ num_format(auth()->user()->wallet) }}</span>
        </a>

        <!-- Menu Button (dropdown) -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="mobileMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-menu" style="font-size: 24px;"></i>
            </a>

            <!-- Dropdown Items -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mobileMenuDropdown">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('orders.show') }}">
                        <i class="mdi mdi-package-variant-closed menu-icon text-primary me-2"></i> My Order
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('address.index') }}">
                        <i class="mdi mdi-map-marker-outline menu-icon text-primary me-2"></i> Manage Addresses
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                        <i class="mdi mdi-power me-2 text-danger"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>


</nav>


 <div class="container-fluid page-body-wrapper">
