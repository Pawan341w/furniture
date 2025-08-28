<!-- Desktop Sidebar (hidden on small screens) -->
<nav class="sidebar sidebar-offcanvas d-none d-md-block" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ auth()->user()->profile_image
                      ? asset('storage/' . auth()->user()->profile_image)
                      : asset('assets/images/faces/face1.jpg') }}" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
          <span class="text-secondary text-small">{{auth()->user()->role}}</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>

    <!--<li class="nav-item">-->
    <!--  <a class="nav-link" href="/">-->
    <!--    <span class="menu-title">Dashboard</span>-->
    <!--    <i class="mdi mdi-home menu-icon"></i>-->
    <!--  </a>-->
    <!--</li>-->

    <li class="nav-item">
      <a class="nav-link" href="{{ route('bank.details.index') }}">
        <span class="menu-title">Bank-details</span>
        <i class="mdi mdi-bank menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('withdraw.index') }}">
        <span class="menu-title">Withdrawal</span>
        <i class="mdi mdi-cash-multiple menu-icon"></i>
      </a>
    </li>

    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.products.index') }}">
        <span class="menu-title">Product List</span>
        <i class="mdi mdi-cart menu-icon"></i>
        </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('orders.show') }}">
        <span class="menu-title">My Order</span>
        <!--<i class="mdi mdi-format-list-bulleted menu-icon"></i>-->
       <i class="mdi mdi-package-variant-closed menu-icon"></i>
       
      </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link text-center" href="{{ route('wallet.history') }}">
                <span class="menu-title">History</span>
        <i class="mdi mdi-history menu-icon"></i>

        </a>
    </li>


  </ul>
</nav>

<!-- Mobile Bottom Navbar (shown only on small screens) -->
<nav class="navbar fixed-bottom navbar-light bg-light d-md-none d-flex justify-content-around border-top">
  <!--<a class="nav-link text-center" href="/">-->
  <!--  <i class="mdi mdi-home menu-icon d-block"></i>-->
  <!--  <small>Dashboard</small>-->
  <!--</a>-->
  <a class="nav-link text-center" href="{{ route('bank.details.index') }}">
    <i class="mdi mdi-bank menu-icon d-block"></i>
    <small>Bank</small>
  </a>
  
  <!--<a class="nav-link text-center" href="{{ route('bank.details.index') }}">-->
  <!--</a>-->
  
  <a class="nav-link text-center" href="{{ route('withdraw.index') }}">
    <i class="mdi mdi-cash-multiple menu-icon d-block"></i>
    <small>Withdraw</small>
  </a>
  
  <a class="nav-link text-center" href="{{ route('user.products.index') }}">
    <i class="mdi mdi-cart menu-icon d-block"></i>
    <small>Products</small>
  </a>
  
  <a class="nav-link text-center" href="{{ route('wallet.history') }}">
    <i class="mdi mdi-history menu-icon d-block"></i>
    <small>History</small>
  </a>
  
</nav>
