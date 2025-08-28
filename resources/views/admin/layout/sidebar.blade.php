        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
<img src="{{ auth()->user()->profile_image
                        ? asset('storage/' . auth()->user()->profile_image)
                        : asset('assets/images/faces/face1.jpg') }}" alt="profile" />                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
           <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                  <span class="text-secondary text-small">{{auth()->user()->role}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('categories.index') }}">
        <span class="menu-title">Category</span>
        <i class="mdi mdi-shape menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('products.index') }}">
        <span class="menu-title">Products</span>
        <i class="mdi mdi-view-grid menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('product-catalog.view') }}">
        <span class="menu-title">Products Catalog</span>
        <i class="mdi mdi-package-variant menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('qr.mang') }}">
        <span class="menu-title">Qr Management</span>
<i class="mdi mdi-qrcode menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('users.index') }}">
        <span class="menu-title">User Management</span>
<i class="mdi mdi-account-multiple menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.withdrawals.management') }}">
        <span class="menu-title">Withdrawal Management</span>
        <i class="mdi mdi-cash-minus menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('orders.index') }}">
        <span class="menu-title">Order Management</span>
<i class="mdi mdi-cart-outline menu-icon"></i>
   </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.general-settings.index') }}">
        <span class="menu-title">Developar Tools</span>
<i class="mdi mdi-code-tags	 menu-icon"></i>
    </a>
</li>

          </ul>
        </nav>
