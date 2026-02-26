<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grah Mitra</title>
  <!-- Bootstrap CSS -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">
    <!-- Litepicker CSS -->
<link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.10/css/tempus-dominus.min.css"
  >
  <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

  <link rel="icon" href="{{ asset('frontend/images/black.png') }}" type="image/x-icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

  <style>
    /* Mobile header topbar */
    .mobile-topbar-row { display: flex; gap: 10px; align-items: center; justify-content: space-between; }
    .mobile-location { display:flex; align-items:center; gap:8px; }
    .mobile-location .loc-text { font-weight:700; }
    .mobile-search { margin-top:10px; }
    .mobile-cart-btn { position: relative; }
    .mobile-cart-badge { position:absolute; top:-6px; right:-6px; background:#ff4d4f; color:#fff; font-size:11px; padding:3px 7px; border-radius:12px; }

    /* Bottom navigation */
    .bottom-nav { position: fixed; left: 0; right: 0; bottom: 0; background: #fff; border-top: 1px solid #eee; display: none; z-index: 1050; }
    .bottom-nav-inner { max-width: 960px; margin: 0 auto; display:flex; gap:6px; padding:8px 12px; }
    .bottom-nav-item { flex:1; text-align:center; padding:6px 4px; font-size:13px; color:#444; }
    .bottom-nav-item .icon { font-size:18px; display:block; margin-bottom:4px; }
    .bottom-nav-item.active { color:#4a7ff3; }

    @media (max-width: 991px) {
      .bottom-nav { display:block; }
      body { padding-bottom: 70px; }
    }

    /* Address Picker Modal */
    .address-picker-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 2000; display: none; flex-direction: column; overflow: hidden; }
    .address-picker-modal.show { display: flex; }
    .address-picker-header { display: flex; align-items: center; gap: 12px; padding: 16px; border-bottom: 1px solid #eee; }
    .address-picker-header .back-btn { background: none; border: none; font-size: 20px; cursor: pointer; }
    .address-picker-header input { flex: 1; border: 1px solid #ddd; border-radius: 8px; padding: 10px 12px; font-size: 14px; }
    .address-picker-body { flex: 1; overflow-y: auto; padding: 16px; }
    .address-section { margin-bottom: 24px; }
    .address-section-title { font-weight: 700; font-size: 14px; margin-bottom: 12px; color: #333; }
    .address-item { display: flex; gap: 12px; padding: 12px; border-radius: 8px; cursor: pointer; margin-bottom: 8px; }
    .address-item:hover { background: #f5f5f5; }
    .address-item-icon { font-size: 20px; color: #999; flex-shrink: 0; }
    .address-item-content { flex: 1; }
    .address-item-name { font-weight: 600; font-size: 14px; margin-bottom: 4px; }
    .address-item-detail { font-size: 12px; color: #999; }
    .use-current-location { color: #667eea; font-weight: 600; display: flex; align-items: center; gap: 8px; padding: 12px; cursor: pointer; margin-bottom: 16px; }
    .use-current-location i { font-size: 16px; }
    .address-view-more { color: #667eea; font-weight: 600; cursor: pointer; }
    .address-picker-footer { padding: 12px 16px; border-top: 1px solid #eee; text-align: center; font-size: 12px; color: #999; }
    .address-picker-footer img { height: 14px; }
  </style>

  <!-- Add Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  
</head>
<body data-services-route="{{ route('services') }}">
    {{-- Loader overlay (injected) --}}
    <div class="loader-wrapper" id="loader">
      <div class="logo">Grah Mitra</div>
      <div class="progress-bar">
        <div class="progress-fill" id="progress"></div>
      </div>
    </div>
    <!-- Header Start -->
<header class="border-bottom bg-white py-2">
  <div class="container px-4">
    <div class="d-none d-lg-flex align-items-center justify-content-between">

      <!-- Left: Logo -->
      <div class="d-flex align-items-center gap-3">
        <a href="{{ route('/') }}" class="d-flex align-items-center text-decoration-none">
          <div class="bg-dark text-white px-2 py-1 fw-bold rounded me-2">
            GM
          </div>
          <div>
            <div class="fw-bold text-dark" style="line-height: 1;">Grah</div>
            <div class="fw-bold text-dark" style="line-height: 1;">Mitra</div>
          </div>
        </a>
        {{-- <span class="text-muted small">Native</span> --}}
      </div>

      <!-- Center: Location + Search -->
      {{-- <div class="d-none d-lg-flex align-items-center gap-3 w-50">

        <!-- Location -->
        <div class="input-group">
          <span class="input-group-text bg-white">
            <i class="fa-solid fa-location-dot text-muted"></i>
          </span>
          <select class="form-select border-start-0">
            <option>Ashok Nagar, Jaipur</option>
            <option>Delhi</option>
            <option>Mumbai</option>
          </select>
        </div>

        <!-- Search -->
        <div class="input-group">
          <span class="input-group-text bg-white">
            <i class="fa-solid fa-magnifying-glass text-muted"></i>
          </span>
          <input type="text" class="form-control border-start-0" placeholder="Search for 'Kitchen cleaning'">
        </div>

      </div> --}}

      <!-- Right: Icons -->
      <div class="d-none d-lg-flex align-items-center gap-3">
        <a href="{{ route('cart') }}" class="text-dark position-relative">
          <i class="fa-solid fa-cart-shopping fs-5"></i>
        </a>
        <!-- Test profile dropdown (always visible for testing) -->
        <div class="dropdown d-inline-block">
          <a class="d-flex align-items-center text-dark text-decoration-none" href="#" id="testProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center" style="width:32px;height:32px;font-weight:600;">R</div>
          </a>
          <div class="dropdown-menu dropdown-menu-end p-4 shadow-lg rounded-4 raaz" aria-labelledby="testProfileDropdown" style="min-width:280px; border:none;">
            <!-- Header Section -->
            <div class="mb-3 pb-3 border-bottom">
              <h6 class="fw-bold mb-1" style="font-size:0.95rem;">Raj</h6>
              <small class="text-muted d-block">9461937396</small>
            </div>
            
            <!-- Menu Items -->
            <div class="d-flex flex-column gap-2">
              <a href="{{ route('my_requests') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-solid fa-list" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">My requests</span>
              </a>
              <a href="{{ route('profile') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-regular fa-user" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">Profile</span>
              </a>
              {{-- <a href="{{ route('payment-history') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-regular fa-credit-card" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">Payment History</span>
              </a> --}}
              <a href="{{ route('wallet') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-solid fa-coins" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">Wallet</span>
              </a>
            </div>
            
            <!-- Divider -->
            <hr class="my-3">
            
            <!-- Sign Out -->
            <a href="{{ route('user.logout') }}" class="dropdown-item rounded-2 px-3 py-2 text-danger text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
              <i class="fa-solid fa-arrow-right-from-bracket" style="width:18px;text-align:center;"></i>
              <span style="font-size:0.95rem;">Sign out</span>
            </a>
          </div>
        </div>  
        {{-- Profile dropdown: shows when user is authenticated, otherwise opens login modal --}}
        @auth
        <div class="dropdown">
          <a class="d-flex align-items-center text-dark text-decoration-none" href="#" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center" style="width:34px;height:34px;font-weight:600;">{{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}</div>
            <div class="ms-2 d-none d-md-block text-start">
              <div class="fw-bold small">{{ auth()->user()->name ?? 'User' }}</div>
              <div class="small text-muted">{{ auth()->user()->phone ?? '9461937396' }}</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end p-4 shadow-lg rounded-4" aria-labelledby="profileDropdown" style="min-width:280px; border:none;">
            <!-- Header Section -->
            <div class="mb-3 pb-3 border-bottom">
              <h6 class="fw-bold mb-1" style="font-size:0.95rem;">{{ auth()->user()->name ?? 'User' }}</h6>
              <small class="text-muted d-block">{{ auth()->user()->phone ?? '9461937396' }}</small>
            </div>
            
            <!-- Menu Items -->
            <div class="d-flex flex-column gap-2">
              <a href="{{ route('my_requests') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-regular fa-square-list" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">My requests</span>
              </a>
              <a href="{{ route('profile') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-regular fa-user" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">Profile</span>
              </a>
              <a href="{{ route('payment-history') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-solid fa-wallet" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">Payment History</span>
              </a>
              <a href="{{ route('wallet') }}" class="dropdown-item rounded-2 px-3 py-2 text-dark text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
                <i class="fa-solid fa-coins" style="width:18px;text-align:center;"></i>
                <span style="font-size:0.95rem;">Wallet</span>
              </a>
            </div>
            
            <!-- Divider -->
            <hr class="my-3">
            
            <!-- Sign Out -->
            <a href="{{ route('user.logout') }}" class="dropdown-item rounded-2 px-3 py-2 text-danger text-decoration-none" style="transition:all 0.2s;display:flex;align-items:center;gap:0.75rem;">
              <i class="fa-solid fa-arrow-right-from-bracket" style="width:18px;text-align:center;"></i>
              <span style="font-size:0.95rem;">Sign out</span>
            </a>
          </div>
        </div>
        @else
        <a href="#" class="text-dark">
          <i class="fa-regular fa-user fs-5" data-bs-toggle="modal" data-bs-target="#loginModal"></i>
        </a>
        @endauth
      </div>

    </div>

    <!-- Mobile Topbar (Visible on small devices, home page only) -->
    @if (request()->routeIs('/'))
      <div class="d-lg-none mt-3">
        <div class="mobile-topbar-row">
          <div class="mobile-location small text-muted" onclick="openAddressPicker()" style="cursor:pointer; flex:1;">
            <i class="fa-solid fa-location-dot text-muted"></i>
            <div>
              <div class="loc-text">Home</div>
              <div class="small text-muted">19,New Sanganer Rd, Kalyanpuri Colony</div>
            </div>
          </div>
          <div class="mobile-cart-btn">
            <a href="{{ route('cart') }}" class="btn btn-light rounded-circle" style="width:42px;height:42px;display:inline-flex;align-items:center;justify-content:center;">
              <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <span class="mobile-cart-badge">2</span>
          </div>
        </div>

        <div class="mobile-search">
          <div class="input-group">
            <span class="input-group-text bg-white">
              <i class="fa-solid fa-magnifying-glass text-muted"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search for 'AC service'">
          </div>
        </div>
      </div>
    @endif

  </div>
</header>
<!-- Header End -->


<!-- Address Picker Modal -->
<div class="address-picker-modal" id="addressPickerModal">
  <div class="address-picker-header">
    <button class="back-btn" onclick="closeAddressPicker()">
      <i class="fa-solid fa-arrow-left"></i>
    </button>
    <input type="text" class="address-search-input" placeholder="Search for your location/society/apartment" id="addressSearch">
  </div>

  <div class="address-picker-body">
    <!-- Use Current Location -->
    <div class="use-current-location" onclick="useCurrentLocation()">
      <i class="fa-solid fa-location-dot"></i>
      <span>Use current location</span>
    </div>

    <!-- Saved Addresses Section -->
    <div class="address-section">
      <div class="address-section-title">Saved</div>
      <div class="address-item" onclick="selectAddress(this)">
        <div class="address-item-icon">
          <i class="fa-solid fa-home"></i>
        </div>
        <div class="address-item-content">
          <div class="address-item-name">Home</div>
          <div class="address-item-detail">19, New Sanganer Rd, Kalyanpuri Colony, Sodala, Jaipur, Rajasthan 302019, India</div>
        </div>
      </div>

      <div class="address-item" onclick="selectAddress(this)">
        <div class="address-item-icon">
          <i class="fa-solid fa-home"></i>
        </div>
        <div class="address-item-content">
          <div class="address-item-name">Home</div>
          <div class="address-item-detail">19, Kalawala, Chokhi Dhani, Sukhdeopura Nohara, Jaipur, Shyosinghpura at Kallawala, Rajasthan 302029, ...</div>
        </div>
      </div>

      <div class="address-view-more" onclick="viewMoreAddresses()">View more</div>
    </div>

    <!-- Recents Section -->
    <div class="address-section">
      <div class="address-section-title">Recents</div>
      <div class="address-item" onclick="selectAddress(this)">
        <div class="address-item-icon">
          <i class="fa-solid fa-clock"></i>
        </div>
        <div class="address-item-content">
          <div class="address-item-name">Fineoutput</div>
          <div class="address-item-detail">New Sanganer Road, Kalyanpuri Colony, Sodala, Jaipur, Rajasthan, India</div>
        </div>
      </div>
    </div>
  </div>

  <div class="address-picker-footer">
    powered by <img src="https://www.gstatic.com/images/branding/product/1x/maps_64dp.png" alt="Google"> 
  </div>
</div>


<!-- Mobile Profile Modal -->
<div class="modal fade" id="mobileProfileModal" tabindex="-1">
  <div class="modal-dialog modal-fullscreen-sm-down">
    <div class="modal-content border-0 rounded-0 h-100">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body py-0">
        <div class="p-4">
          <!-- Header Section -->
          <div class="mb-3 pb-3 border-bottom">
            <h6 class="fw-bold mb-1" style="font-size:0.95rem;">{{ auth()->user()->name ?? 'Guest' }}</h6>
            <small class="text-muted d-block">{{ auth()->user()->phone ?? '' }}</small>
          </div>

          <!-- Menu Items -->
          <div class="d-flex flex-column gap-2 mt-3">
            <a href="{{ route('my_requests') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-solid fa-list me-2"></i> My requests
            </a>
            <a href="{{ route('profile') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-regular fa-user me-2"></i> Profile
            </a>
            <a href="{{ route('payment-history') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-regular fa-credit-card me-2"></i> Payment History
            </a>
            <a href="{{ route('wallet') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-solid fa-coins me-2"></i> Wallet
            </a>
          </div>

          <hr class="my-4">

          @auth
          <a href="{{ route('user.logout') }}" class="btn btn-danger w-100">Sign out</a>
          @else
          <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Sign in / Sign up</button>
          @endauth
        </div>
      </div>
    </div>
  </div>
</div>


{{-- ////////////// Login modal --}}
<!-- Bottom Navigation (mobile) -->
<nav class="bottom-nav d-lg-none" aria-label="Mobile navigation">
  <div class="bottom-nav-inner container d-flex justify-content-between">
    <a href="{{ route('/') }}" class="bottom-nav-item text-center" style="text-decoration: none;">
      <span class="icon"><i class="fa-solid fa-house"></i></span>
      <span class="small">GM</span>
    </a>

    <a href="#" class="bottom-nav-item text-center" style="text-decoration: none;">
      <span class="icon"><i class="fa-solid fa-question-circle"></i></span>
      <span class="small">Help</span>
    </a>

    <a href="{{ route('services') }}" style="text-decoration: none;" class="bottom-nav-item text-center active">
      <span class="icon position-relative"><i class="fa-solid fa-store"></i></span>
      <span class="small">Servicees</span>
    </a>

    <a href="{{ route('profile') }}" style="text-decoration: none;" class="bottom-nav-item text-center">
      <span class="icon"><i class="fa-regular fa-user"></i></span>
      <span class="small">Account</span>
    </a>
  </div>
</nav>
<!-- ================= LOGIN MODAL ================= -->
<!-- ================= LOGIN MODAL ================= -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 p-4 position-relative">

      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
              data-bs-dismiss="modal"></button>

      <!-- STEP 1 : PHONE SECTION -->
      <div id="phoneSection">

        <div class="mb-3">
          <i class="fa-solid fa-phone fa-2x text-primary"></i>
        </div>

        <h4 class="fw-bold mb-2">Enter your phone number</h4>
        <p class="text-muted small">
          We'll send you a text with a verification code.
        </p>

        <div class="input-group mb-3 mt-3">
          <select class="form-select w-auto flex-grow-0" style="max-width:90px;">
            <option selected>+91</option>
          </select>
          <input type="tel" id="phoneInput" class="form-control"
                 placeholder="Enter your phone number" maxlength="10">
        </div>

        <button id="continueBtn"
                class="btn btn-secondary w-100 rounded-3"
                disabled>
          Continue
        </button>

        <p class="small text-muted mt-3 mb-0">
          By continuing, you agree to our 
          <a href="#">T&C</a> and 
          <a href="#">Privacy policy</a>.
        </p>
      </div>

      <!-- STEP 2 : OTP SECTION (Hidden Initially) -->
      <!-- STEP 2 : OTP SECTION -->
<div id="otpSection" style="display:none;">

  <div class="mb-3">
    <i class="fa-solid fa-shield-halved fa-2x text-primary"></i>
  </div>

  <h4 class="fw-bold mb-2">Enter OTP</h4>
  <p class="text-muted small">
    We sent a code to <span id="displayNumber"></span>
  </p>

  <!-- OTP BOXES -->
  <div class="d-flex justify-content-between gap-2 my-4" id="otpInputs">
    <input type="text" maxlength="1" class="otp-box form-control text-center">
    <input type="text" maxlength="1" class="otp-box form-control text-center">
    <input type="text" maxlength="1" class="otp-box form-control text-center">
    <input type="text" maxlength="1" class="otp-box form-control text-center">
    <input type="text" maxlength="1" class="otp-box form-control text-center">
    <input type="text" maxlength="1" class="otp-box form-control text-center">
  </div>

  <button id="verifyBtn" class="btn btn-secondary w-100 rounded-3" disabled>
    Verify & Continue
  </button>

  <p class="small text-muted mt-3 text-center">
    Didn’t receive code? <a href="#">Resend</a>
  </p>

</div>

    </div>
  </div>
</div>

<!-- ================= CATEGORIES MODAL ================= -->
<div class="modal fade" id="categoriesModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 p-4">
      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      
      <!-- Title -->
      <h4 class="fw-bold mb-4" id="categoryTitle">Select Service</h4>
      
      <!-- Categories Grid -->
      <div class="row g-3" id="categoriesGrid">
        <!-- Will be populated by JS -->
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script src="{{ asset('frontend/script.js') }}"></script>
<script src="{{ asset('frontend/loader.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){
  // Profile modal open on mobile
  function openMobileProfile(e){
    if(window.innerWidth <= 991){
      e.preventDefault();
      var modalEl = document.getElementById('mobileProfileModal');
      if(modalEl){
        var m = new bootstrap.Modal(modalEl);
        m.show();
      }
    }
  }
  var test = document.getElementById('testProfileDropdown');
  if(test) test.addEventListener('click', openMobileProfile);
  var profile = document.getElementById('profileDropdown');
  if(profile) profile.addEventListener('click', openMobileProfile);

  // Address search filter
  var searchInput = document.getElementById('addressSearch');
  if(searchInput){
    searchInput.addEventListener('input', function(e){
      var query = e.target.value.toLowerCase();
      var items = document.querySelectorAll('.address-item');
      items.forEach(function(item){
        var text = item.innerText.toLowerCase();
        item.style.display = text.includes(query) ? 'flex' : 'none';
      });
    });
  }
});

// Open address picker
function openAddressPicker(){
  var modal = document.getElementById('addressPickerModal');
  if(modal) modal.classList.add('show');
  document.body.style.overflow = 'hidden';
}

// Close address picker
function closeAddressPicker(){
  var modal = document.getElementById('addressPickerModal');
  if(modal) modal.classList.remove('show');
  document.body.style.overflow = 'auto';
}

// Use current location
function useCurrentLocation(){
  alert('Getting your current location...');
  // Add geolocation logic here
}

// Select address
function selectAddress(elem){
  var name = elem.querySelector('.address-item-name').innerText;
  var detail = elem.querySelector('.address-item-detail').innerText;
  
  // Truncate address to keep it small (max 50 chars)
  var truncatedDetail = detail.length > 20 ? detail.substring(0, 20) + '...' : detail;
  
  // Update mobile location display with proper selectors
  var locElement = document.querySelector('.mobile-location .loc-text');
  var detailElement = document.querySelector('.mobile-location > div > .small.text-muted');
  
  if(locElement) locElement.innerText = name;
  if(detailElement) detailElement.innerText = truncatedDetail;
  
  // Close modal
  closeAddressPicker();
  
  console.log('Selected address: ' + name + ' - ' + detail);
}

// View more addresses
function viewMoreAddresses(){
  alert('View more addresses');
  // Navigate to full address list or show more modal
}
</script>