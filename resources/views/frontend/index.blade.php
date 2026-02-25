@extends('frontend.common.app')
@section('title','home')
@section('content')

<!-- ================= Title Section ================= -->
<section class="py-5 bg-light mb-4 text-center nameset d-none d-lg-block">
    <div class="container mb-5">
        <h1 class="fw-bold mb-3">Welcome to Grah Mitra</h1>
        <p class="lead mb-0">
            Your one-stop solution for all home services. <br>
            Book trusted professionals for cleaning, repairs, beauty, and more.
        </p>
    </div>

<div class="d-flex align-items-center justify-content-center mb-5">
<div class="d-none d-lg-flex align-items-center gap-3 w-50">

        <!-- Location -->
        <div class="input-group">
          <span class="input-group-text bg-white">
            <i class="fa-solid fa-location-dot text-muted"></i>
          </span>
          <select style="padding: 20px" class="form-select border-start-0">
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
          <input style="padding: 20px" type="text" class="form-control border-start-0" placeholder="Search for 'Kitchen cleaning'">
        </div>

      </div>
      </div>
      </section>
<!-- ================= SERVICE CATEGORIES ================= -->


<section class="py-4 bg-light mb-5">
  <div class="container">

    <div class="row text-center g-3">

      <div class="col-6 col-md-3 col-lg-2">
        <button class="service-box p-3 bg-white rounded shadow-sm border-0 w-100" data-bs-toggle="modal" data-bs-target="#categoriesModal" data-service="Salon Services" style="cursor: pointer;">
          <img src="{{ asset('frontend/images/services/premium-service.png') }}" alt="">
          <h6 class="mb-0">Salon Services</h6>
        </button>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <button class="service-box p-3 bg-white rounded shadow-sm border-0 w-100" data-bs-toggle="modal" data-bs-target="#categoriesModal" data-service="Appliance Repair" style="cursor: pointer;">
          <img src="{{ asset('frontend/images/services/microwave-oven.png') }}" alt="">
          <h6 class="mb-0">Appliance Repair</h6>
        </button>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <button class="service-box p-3 bg-white rounded shadow-sm border-0 w-100" data-bs-toggle="modal" data-bs-target="#categoriesModal" data-service="Home Cleaning" style="cursor: pointer;">
          <img src="{{ asset('frontend/images/services/house-cleaning.png') }}" alt="">  
          <h6 class="mb-0">Home Cleaning</h6>
        </button>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <button class="service-box p-3 bg-white rounded shadow-sm border-0 w-100" data-bs-toggle="modal" data-bs-target="#categoriesModal" data-service="Pest Control" style="cursor: pointer;">
          <img src="{{ asset('frontend/images/services/bug-spray.png') }}" alt="">
          <h6 class="mb-0">Pest Control</h6>
        </button>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <button class="service-box p-3 bg-white rounded shadow-sm border-0 w-100" data-bs-toggle="modal" data-bs-target="#categoriesModal" data-service="Plumbing" style="cursor: pointer;">
          <img src="{{ asset('frontend/images/services/water-heater.png') }}" alt="">
          <h6 class="mb-0">Plumbing</h6>
        </button>
      </div>

      <div class="col-6 col-md-3 col-lg-2"> 
        <button class="service-box p-3 bg-white rounded shadow-sm border-0 w-100" data-bs-toggle="modal" data-bs-target="#categoriesModal" data-service="Painting" style="cursor: pointer;">
          <img src="{{ asset('frontend/images/services/house-painting.png') }}" alt="">
          <h6 class="mb-0">Painting</h6>
        </button>
      </div>

    </div>

  </div>
</section>

<!-- ================= PROMO SLIDER ================= -->
<section class="py-4 mb-5">
  <div class="container">
    <div id="promoSlider" class="splide">
      <div class="splide__track">
        <ul class="splide__list">

          <!-- Slide 1 -->
          <li class="splide__slide">
            <div class="promo-card" style="background-image:url('https://images.unsplash.com/photo-1562259949-e8e7689d7828');">
              <div class="promo-content">
                <h4>Home painting & waterproofing</h4>
                <p>Pay after 100% satisfaction</p>
                <button class="btn btn-dark btn-sm">Book now</button>
              </div>
            </div>
          </li>

          <!-- Slide 2 -->
          <li class="splide__slide">
            <div class="promo-card green" style="background-image:url('https://images.unsplash.com/photo-1581578731548-c64695cc6952');">
              <div class="promo-content text-white">
                <h4>Shine your bathroom deserves</h4>
                <button class="btn btn-light btn-sm">Book now</button>
              </div>
            </div>
          </li>

          <!-- Slide 3 -->
          <li class="splide__slide">
            <div class="promo-card pink" style="background-image:url('https://images.unsplash.com/photo-1598514982586-df7e0cdd87b0');">
              <div class="promo-content text-white">
                <span class="badge bg-light text-dark mb-2">25% OFF</span>
                <h4>Valentine’s Special Packages</h4>
                <p>Curated for the season of love</p>
                <button class="btn btn-light btn-sm">Book now</button>
              </div>
            </div>
          </li>
          <li class="splide__slide">
            <div class="promo-card pink" style="background-image:url('https://images.unsplash.com/photo-1598514982586-df7e0cdd87b0');">
              <div class="promo-content text-white">
                <span class="badge bg-light text-dark mb-2">25% OFF</span>
                <h4>Valentine’s Special Packages</h4>
                <p>Curated for the season of love</p>
                <button class="btn btn-light btn-sm">Book now</button>
              </div>
            </div>
          </li>
          <li class="splide__slide">
            <div class="promo-card pink" style="background-image:url('https://images.unsplash.com/photo-1598514982586-df7e0cdd87b0');">
              <div class="promo-content text-white">
                <span class="badge bg-light text-dark mb-2">25% OFF</span>
                <h4>Valentine’s Special Packages</h4>
                <p>Curated for the season of love</p>
                <button class="btn btn-light btn-sm">Book now</button>
              </div>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
</section>


<!-- ================= MOST BOOKED SERVICES ================= -->
<section class="py-4 bg-light">
  <div class="container">
    <h5 class="mb-4">Most Booked Services</h5>

    <div class="row g-4">

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" class="card-img-top">
          <div class="card-body text-center">
            <h6>Bathroom Cleaning</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="card-img-top">
          <div class="card-body text-center">
            <h6>Kitchen Cleaning</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://plus.unsplash.com/premium_photo-1682126012378-859ca7a9f4cf?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YWMlMjByZXBhaXJ8ZW58MHx8MHx8fDA%3D" class="card-img-top">
          <div class="card-body text-center">
            <h6>AC Repair</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8RWxlY3RyaWNpYW58ZW58MHx8MHx8fDA%3D" class="card-img-top">
          <div class="card-body text-center">
            <h6>Electrician</h6>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ================= SALON PROMO BANNER ================= -->
<section class="py-5">
  <div class="container">
    <div class="p-5 text-white rounded"
         style="background: url('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9') center/cover;">
      <div class="col-md-6">
        <h2>Get Professional Salon Services at Home</h2>
        <a href="#" class="btn btn-danger mt-3">Book Now</a>
      </div>
    </div>
  </div>
</section>


<!-- ================= CLEANING & PEST SERVICES ================= -->
<section class="py-4 bg-light">
  <div class="container">
    <h5 class="mb-4">Cleaning & Pest Services</h5>

    <div class="row g-4">

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" class="card-img-top">
          <div class="card-body text-center">
            <h6>Full House Cleaning</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://plus.unsplash.com/premium_photo-1682126104327-ef7d5f260cf7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cGVzdCUyMGNvbnRyb2x8ZW58MHx8MHx8fDA%3D" class="card-img-top">
          <div class="card-body text-center">
            <h6>Pest Control</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1600585152220-90363fe7e115" class="card-img-top">
          <div class="card-body text-center">
            <h6>Sofa Cleaning</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1686178827149-6d55c72d81df?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZGVlcCUyMGNsZWFuaW5nfGVufDB8fDB8fHww" class="card-img-top">
          <div class="card-body text-center">
            <h6>Deep Cleaning</h6>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ================= BANNER 1: TWO COLUMN LAYOUT ================= -->
<section class="py-5 mb-5">
  <div class="container">
    <div class="row g-4">
      <!-- Left Column -->
      <div class="col-md-6">
        <div class="p-5 text-white rounded-4 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; flex-direction: column; justify-content: center;">
          <h3 class="fw-bold mb-3">Premium Home Repairs</h3>
          <p class="mb-4">Expert technicians for all your home repair needs. Fast, reliable, and affordable.</p>
          <div>
            <span class="badge bg-light text-primary mb-3">20% OFF</span>
          </div>
          <a href="#" class="btn btn-light btn-lg rounded-3">Book Service</a>
        </div>
      </div>
      <!-- Right Column -->
      <div class="col-md-6">
        <div class="rounded-4 h-100 overflow-hidden shadow-lg">
          <img src="https://images.unsplash.com/photo-1562259929-b4e1fd3aef09?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aG9tZSUyMHJlcGFpcnxlbnwwfHwwfHx8MA%3D%3D" alt="Home Repairs" class="w-100 h-100" style="object-fit: cover;">
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ================= BANNER 2: GRID CARDS LAYOUT ================= -->
<section class="py-5 mb-5 bg-light">
  <div class="container">
    <h4 class="fw-bold mb-5 text-center">Exclusive Offers</h4>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          <div style="background-image: url('https://plus.unsplash.com/premium_photo-1661603771539-faa0e3ed7ca6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8U3BhJTIwJTI2JTIwTWFzc2FnZXxlbnwwfHwwfHx8MA%3D%3D'); background-size: cover; background-position: center; height: 180px; position: relative;">
            <div class="position-absolute top-0 end-0 p-3">
              <span class="badge bg-warning text-dark fs-6">50% OFF</span>
            </div>
          </div>
          <div class="card-body p-4">
            <h6 class="fw-bold mb-2">Spa & Massage</h6>
            <p class="text-muted small mb-3">Relax with our premium spa services at home</p>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-3">Explore</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          <div style="background-image: url('https://images.unsplash.com/photo-1759772238012-9d5ad59ae637?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8QUMlMjAlMjYlMjBDb29saW5nfGVufDB8fDB8fHww'); background-size: cover; background-position: center; height: 180px; position: relative;">
            <div class="position-absolute top-0 end-0 p-3">
              <span class="badge bg-success text-white fs-6">Extra Saving</span>
            </div>
          </div>
          <div class="card-body p-4">
            <h6 class="fw-bold mb-2">AC & Cooling</h6>
            <p class="text-muted small mb-3">Professional AC repair, cleaning & maintenance</p>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-3">Explore</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          <div style="background-image: url('https://plus.unsplash.com/premium_photo-1678766819153-b3f7307c5127?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8RWxlY3RyaWNhbCUyMFdvcmt8ZW58MHx8MHx8fDA%3D'); background-size: cover; background-position: center; height: 180px; position: relative;">
            <div class="position-absolute top-0 end-0 p-3">
              <span class="badge bg-info text-white fs-6">Limited Time</span>
            </div>
          </div>
          <div class="card-body p-4">
            <h6 class="fw-bold mb-2">Electrical Work</h6>
            <p class="text-muted small mb-3">Certified electricians for safe & quick fixes</p>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-3">Explore</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= TRUST & SAFETY FEATURES ================= -->
<section class="py-5 mb-5">
  <div class="container">
    <h4 class="fw-bold mb-5 text-center">Your Safety, Our Priority</h4>
    <div class="row g-4">
      <!-- Feature 1: Job Verification -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
          <div class="mb-4">
            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex justify-content-center align-items-center" style="width:80px;height:80px;">
              <i class="fa-solid fa-check-double fa-2x text-primary"></i>
            </div>
          </div>
          <h6 class="fw-bold mb-2">Job Verification</h6>
          <p class="text-muted small mb-0">Every service professional is thoroughly verified and background checked to ensure quality and safety in your home.</p>
        </div>
      </div>

      <!-- Feature 2: OTP to Start Service -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
          <div class="mb-4">
            <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex justify-content-center align-items-center" style="width:80px;height:80px;">
              <i class="fa-solid fa-lock fa-2x text-success"></i>
            </div>
          </div>
          <h6 class="fw-bold mb-2">OTP to Start Service</h6>
          <p class="text-muted small mb-0">Service begins only after a secure OTP verification. You remain in complete control of when the work starts.</p>
        </div>
      </div>

      <!-- Feature 3: OTP to End Service -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
          <div class="mb-4">
            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex justify-content-center align-items-center" style="width:80px;height:80px;">
              <i class="fa-solid fa-shield-halved fa-2x text-danger"></i>
            </div>
          </div>
          <h6 class="fw-bold mb-2">OTP to End Service</h6>
          <p class="text-muted small mb-0">Service concludes only with your OTP confirmation. Complete transparency and security throughout the process.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection