@extends('frontend.common.app')
@section('title','Services')
@section('content')
<!-- ================= SERVICE PAGE ================= -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">

      <!-- ================= LEFT: SERVICE SELECTOR ================= -->
      <div class="col-lg-3">
        <div class="card border-light-custom shadow-sm rounded-4 p-4">
          
          <!-- Service Header -->
          <div class="mb-4">
            <h5 class="fw-bold mb-2">Spa for Women</h5>
            <div class="d-flex gap-2 align-items-center">
              <span class="badge bg-primary">4.83</span>
              <small class="text-muted">(3.4 M bookings)</small>
            </div>
          </div>

          <hr>

          <!-- Select a Service -->
          <label class="form-label fw-semibold mb-3">Select a service</label>

          <!-- Service Options Grid -->
          <div class="row g-2 mb-4">
            <div class="col-6">
              <button class="service-option btn border-2 rounded-3 p-3 text-center w-100" style="cursor: pointer;">
                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">💰</div>
                <small class="fw-semibold d-block">Super saver packs</small>
                <small class="text-success fw-bold">25% OFF</small>
              </button>
            </div>
            <div class="col-6">
              <button class="service-option btn border-2 rounded-3 p-3 text-center w-100" style="cursor: pointer;">
                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">💆</div>
                <small class="fw-semibold d-block">Stress relief</small>
              </button>
            </div>
            <div class="col-6">
              <button class="service-option btn border-2 rounded-3 p-3 text-center w-100" style="cursor: pointer;">
                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🧴</div>
                <small class="fw-semibold d-block">Pain relief</small>
              </button>
            </div>
            <div class="col-6">
              <button class="service-option btn border-2 rounded-3 p-3 text-center w-100" style="cursor: pointer;">
                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🧖</div>
                <small class="fw-semibold d-block">Skin care irtuals</small>
              </button>
            </div>
            <div class="col-6">
              <button class="service-option btn border-2 rounded-3 p-3 text-center w-100" style="cursor: pointer;">
                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">👣</div>
                <small class="fw-semibold d-block">Foot facial</small>
              </button>
            </div>
            <div class="col-6">
              <button class="service-option btn border-2 rounded-3 p-3 text-center w-100" style="cursor: pointer;">
                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">➕</div>
                <small class="fw-semibold d-block">Add-on</small>
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- ================= MIDDLE: SERVICE LISTINGS ================= -->
      <div class="col-lg-5">

        <!-- Service Card 1 -->
        <div class="card border-light-custom shadow-sm rounded-4 p-3 mb-4">
          <div class="row g-3 align-items-center">
            
            <!-- Image -->
            <div class="col-5">
              <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8U3dlZGlzaCUyME1hc3NhZ2V8ZW58MHx8MHx8fDA%3D" alt="Massage" class="img-fluid rounded-3 h-100" style="object-fit: cover;">
            </div>

            <!-- Details -->
            <div class="col-7">
              <div class="mb-2">
                <span class="badge bg-success">25% OFF</span>
              </div>
              <h6 class="fw-bold mb-1">Pack of 4</h6>
              <div class="mb-2">
                <span class="fw-bold text-dark">₹1,099</span>
                <span class="text-muted text-decoration-line-through ms-2">₹1,449</span>
                <small class="d-block text-muted mt-1">per massage*</small>
              </div>
              <small class="badge bg-light text-dark mb-2">Full body</small>
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (1666 reviews)</small>
              </div>
              <small class="d-block text-muted mb-2">*Valid for 5 months</small>
              <small class="d-block text-success mb-3">⏱ Starts at ₹1099/session</small>
              <small class="text-muted d-block mb-3">This massage pack can be redeemed between Monday to Saturday only</small>
              <button class="btn btn-outline-primary btn-sm">Add</button>
              <small class="text-muted ms-2">2 options</small>
            </div>

          </div>
        </div>

        <!-- Service Card 2 -->
        <div class="card border-light-custom shadow-sm rounded-4 p-3 mb-4">
          <div class="row g-3 align-items-center">
            
            <!-- Image -->
            <div class="col-5">
              <img src="https://images.unsplash.com/photo-1590080876-d98be0cd32db?w=400&h=300&fit=crop" alt="Swedish Massage" class="img-fluid rounded-3 h-100" style="object-fit: cover;">
            </div>

            <!-- Details -->
            <div class="col-7">
              <div class="mb-2">
                <span class="badge bg-success">25% OFF</span>
              </div>
              <h6 class="fw-bold mb-1">Pack of 4</h6>
              <div class="mb-2">
                <span class="fw-bold text-dark">₹999</span>
                <span class="text-muted text-decoration-line-through ms-2">₹1,299</span>
                <small class="d-block text-muted mt-1">per massage*</small>
              </div>
              <small class="badge bg-light text-dark mb-2">Full body</small>
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              <small class="d-block text-muted mb-2">*Valid for 6 months</small>
              <small class="d-block text-success mb-3">⏱ Starts at ₹599/session</small>
              <small class="text-muted d-block mb-3">This massage pack can be redeemed between Monday to Saturday only</small>
              <button class="btn btn-outline-primary btn-sm">Add</button>
              <small class="text-muted ms-2">2 options</small>
            </div>

          </div>
        </div>

        <!-- Load More -->
        <div class="text-center">
          <button class="btn btn-outline-dark rounded-3">Load More Services</button>
        </div>

      </div>

      <!-- ================= RIGHT: CART & OFFERS ================= -->
      <div class="col-lg-4">

        <!-- Cart Card -->
        <div class="card border-light-custom shadow-sm rounded-4 p-4 mb-4">
          <div class="text-center mb-4">
            <div style="font-size: 3rem;">🛒</div>
            <p class="text-muted mb-0">No items in your cart</p>
          </div>
        </div>

        <!-- Coupon Offer -->
        <div class="card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
          <div class="text-white">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div>
                <h6 class="fw-bold mb-1">Get ₹50 coupon</h6>
                <small>After first service delivery</small>
              </div>
              <div style="font-size: 2rem;">✅</div>
            </div>
            <a href="#" class="text-white text-decoration-none" style="font-size: 0.85rem;">View More Offers ▼</a>
          </div>
        </div>

        <!-- UC Promise -->
        <div class="card border-light-custom shadow-sm rounded-4 p-4">
          <h6 class="fw-bold mb-3">UC Promise</h6>
          <div class="d-flex gap-3 align-items-start mb-3">
            <div style="font-size: 1.5rem;">✓</div>
            <div>
              <small class="fw-semibold d-block">4.5+ Rated Therapists</small>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start mb-3">
            <div style="font-size: 1.5rem;">✓</div>
            <div>
              <small class="fw-semibold d-block">Relaxation Assured</small>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div style="font-size: 1.5rem;">✓</div>
            <div>
              <small class="fw-semibold d-block">Specialized Premium Oils</small>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

@endsection