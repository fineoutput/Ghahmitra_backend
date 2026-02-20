<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tours Dekho</title>
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

  <!-- Add Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <!-- Header Start -->
<header class="border-bottom bg-white py-2">
  <div class="container px-4">
    <div class="d-flex align-items-center justify-content-between">

      <!-- Left: Logo -->
      <div class="d-flex align-items-center gap-3">
        <a href="#" class="d-flex align-items-center text-decoration-none">
          <div class="bg-dark text-white px-2 py-1 fw-bold rounded me-2">
            GM
          </div>
          <div>
            <div class="fw-bold text-dark" style="line-height: 1;">Grah</div>
            <div class="fw-bold text-dark" style="line-height: 1;">Mitra</div>
          </div>
        </a>
        <span class="text-muted small">Native</span>
      </div>

      <!-- Center: Location + Search -->
      <div class="d-none d-lg-flex align-items-center gap-3 w-50">

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

      </div>

      <!-- Right: Icons -->
      <div class="d-flex align-items-center gap-4">
        <a href="#" class="text-dark position-relative">
          <i class="fa-solid fa-cart-shopping fs-5"></i>
        </a>
        <a href="#" class="text-dark">
          <i class="fa-regular fa-user fs-5"></i>
        </a>
      </div>

    </div>

    <!-- Mobile Search (Visible on small devices) -->
    <div class="d-lg-none mt-3">
      <div class="input-group">
        <span class="input-group-text bg-white">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input type="text" class="form-control" placeholder="Search services...">
      </div>
    </div>

  </div>
</header>
<!-- Header End -->