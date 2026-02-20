@extends('frontend.common.app')
@section('title','home')
@section('content')

<!-- ================= Title Section ================= -->
<section class="py-5 bg-light mb-4 text-center">
    <div class="container">
        <h1 class="fw-bold mb-3">Welcome to Grah Mitra</h1>
        <p class="lead fw-semibold mb-0">
            Your one-stop solution for all home services. 
            Book trusted professionals for cleaning, repairs, beauty, and more.
        </p>
    </div>
</section>

<!-- ================= SERVICE CATEGORIES ================= -->


<section class="py-4 bg-light">
  <div class="container">

    <div class="row text-center g-3">

      <div class="col-6 col-md-3 col-lg-2">
        <div class="service-box p-3 bg-white rounded shadow-sm">
          <img src="{{ asset('frontend/images/services/premium-service.png') }}" alt="">
          <h6 class="mb-0">Salon Services</h6>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <div class="service-box p-3 bg-white rounded shadow-sm">
          <img src="{{ asset('frontend/images/services/microwave-oven.png') }}" alt="">
          <h6 class="mb-0">Appliance Repair</h6>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <div class="service-box p-3 bg-white rounded shadow-sm">
          <img src="{{ asset('frontend/images/services/house-cleaning.png') }}" alt="">  
          <h6 class="mb-0">Home Cleaning</h6>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <div class="service-box p-3 bg-white rounded shadow-sm">
          <img src="{{ asset('frontend/images/services/bug-spray.png') }}" alt="">
          <h6 class="mb-0">Pest Control</h6>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <div class="service-box p-3 bg-white rounded shadow-sm">
          <img src="{{ asset('frontend/images/services/water-heater.png') }}" alt="">
          <h6 class="mb-0">Plumbing</h6>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2"> 
        <div class="service-box p-3 bg-white rounded shadow-sm">
          <img src="{{ asset('frontend/images/services/house-painting.png') }}" alt="">
          <h6 class="mb-0">Painting</h6>
        </div>
      </div>

    </div>

  </div>
</section>


<!-- ================= PROMO BANNERS ================= -->
<section class="py-4">
  <div class="container">
    <div class="row g-4">

      <div class="col-md-4">
        <div class="promo-card p-4 text-white rounded"
             style="background: linear-gradient(135deg,#3b5bdb,#5c7cfa);">
          <h5>Full House Cleaning</h5>
          <p>Starting at ₹1299</p>
          <a href="#" class="btn btn-light btn-sm">Book Now</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="promo-card p-4 text-white rounded"
             style="background: linear-gradient(135deg,#12b886,#38d9a9);">
          <h5>Plumbing Services</h5>
          <p>Starting at ₹299</p>
          <a href="#" class="btn btn-light btn-sm">Book Now</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="promo-card p-4 text-white rounded"
             style="background: linear-gradient(135deg,#7048e8,#9775fa);">
          <h5>Carpentry Services</h5>
          <p>Starting at ₹399</p>
          <a href="#" class="btn btn-light btn-sm">Book Now</a>
        </div>
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
          <img src="https://images.unsplash.com/photo-1581093458791-9d09c1b1e0c5" class="card-img-top">
          <div class="card-body text-center">
            <h6>AC Repair</h6>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm">
          <img src="https://images.unsplash.com/photo-1581091012184-5c4cfc3a5e10" class="card-img-top">
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
          <img src="https://images.unsplash.com/photo-1598514982586-df7e0cdd87b0" class="card-img-top">
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
          <img src="https://images.unsplash.com/photo-1581579186986-6b4c3a0f8e4f" class="card-img-top">
          <div class="card-body text-center">
            <h6>Deep Cleaning</h6>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


@endsection