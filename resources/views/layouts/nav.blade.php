<!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="{{ url('home') }}"><i class="icon ion-android-star-outline"></i>{{ env('APP_NAME') }}</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Menus</label>
      <div class="sl-sideleft-menu">
        <a href="{{ url('home') }}" class="sl-menu-link @yield('dashboard')">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ url('category') }}" class="sl-menu-link @yield('category')">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Category</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ url('subcategory') }}" class="sl-menu-link @yield('subcategory')">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Sub-Category</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ url('product') }}" class="sl-menu-link @yield('product')">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Product</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}<span class="hidden-md-down"></span></span>
              <img src="{{ asset('uploads/profile_photos') }}/{{ Auth::user()->profile_photo }}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="{{ url('editporfile') }}"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="icon ion-power"></i> Sign Out</a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->


