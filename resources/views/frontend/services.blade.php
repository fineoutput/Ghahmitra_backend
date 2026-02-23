@extends('frontend.common.app')
@section('title','Services')
@section('content')
<!-- ================= SERVICE PAGE ================= -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">

      <!-- ================= LEFT: SERVICE SELECTOR ================= -->
      {{-- <div class="col-lg-3">
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
      </div> --}}

      <!-- ================= MIDDLE: SERVICE LISTINGS ================= -->
      <div class="col-lg-8">

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
              <button class="btn btn-outline-primary btn-sm add-to-cart-btn" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4" 
                data-service-price="1099" 
                data-service-original="1449"
                data-service-rating="4.82"
                data-service-reviews="1666">Add</button>
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
              <button class="btn btn-outline-primary btn-sm add-to-cart-btn" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
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

<!-- ================= PACKAGE DETAILS MODAL ================= -->
<div class="modal fade" id="packageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 p-4">
      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      
      <!-- Service Header -->
      <div class="mb-4 pb-3 border-bottom">
        <div class="row align-items-center">
          <div class="col-auto">
            <div style="font-size: 3rem;">💆</div>
          </div>
          <div class="col">
            <h5 class="fw-bold mb-1" id="modalServiceName">Service Name</h5>
            <div class="d-flex gap-3">
              <div>
                <span class="badge bg-primary" id="modalServiceRating">4.82</span>
                <small class="text-muted ms-2">(<span id="modalServiceReviews">1666</span> reviews)</small>
              </div>
              <small class="text-success">✓ Verified</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Package Options -->
      <div class="mb-4">
        <h6 class="fw-bold mb-3">Select Duration</h6>
        <div class="row g-3" id="packageOptionsContainer">
          <!-- Package options will be populated here -->
        </div>
      </div>

      <!-- Additional Details -->
      <div class="mb-4 p-3 bg-light rounded-3">
        <h6 class="fw-bold mb-3">What's Included</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><small><strong>✓</strong> Professional therapist</small></li>
          <li class="mb-2"><small><strong>✓</strong> Premium quality oils</small></li>
          <li class="mb-2"><small><strong>✓</strong> Fully hygienic environment</small></li>
          <li class="mb-2"><small><strong>✓</strong> Stress relief guaranteed</small></li>
        </ul>
      </div>

      <!-- Terms -->
      <div class="mb-4 p-3 bg-light rounded-3">
        <h6 class="fw-bold mb-2">Terms & Conditions</h6>
        <small class="text-muted d-block mb-2">• Valid for 5-6 months from purchase</small>
        <small class="text-muted d-block mb-2">• Can be redeemed Monday to Saturday</small>
        <small class="text-muted d-block">• Non-transferable and non-refundable</small>
      </div>

      <!-- Action Buttons -->
      <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary rounded-3 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary rounded-3 flex-grow-1" onclick="addToCart()">Done</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Package data for different services
  const packageData = {
    'Pack of 4': [
      { duration: '45 mins', price: 499, original: 649 },
      { duration: '1 hour', price: 549, original: 749 },
      { duration: '1.5 hours', price: 649, original: 899 },
      { duration: '2 hours', price: 699, original: 999 }
    ],
    'Pack of 4 (Swedish Massage)': [
      { duration: '45 mins', price: 399, original: 549 },
      { duration: '1 hour', price: 449, original: 599 },
      { duration: '1.5 hours', price: 549, original: 749 },
      { duration: '2 hours', price: 599, original: 799 }
    ]
  };

  // Handle Add button click
  document.addEventListener('click', function(e) {
    if (e.target.closest('.add-to-cart-btn')) {
      const btn = e.target.closest('.add-to-cart-btn');
      const serviceName = btn.getAttribute('data-service-name');
      const servicePrice = btn.getAttribute('data-service-price');
      const serviceRating = btn.getAttribute('data-service-rating');
      const serviceReviews = btn.getAttribute('data-service-reviews');

      // Update modal content
      document.getElementById('modalServiceName').textContent = serviceName;
      document.getElementById('modalServiceRating').textContent = serviceRating;
      document.getElementById('modalServiceReviews').textContent = serviceReviews;

      // Generate package options
      const packages = packageData[serviceName] || packageData['Pack of 4'];
      const container = document.getElementById('packageOptionsContainer');
      container.innerHTML = '';

      packages.forEach(pkg => {
        const col = document.createElement('div');
        col.className = 'col-md-6';
        col.innerHTML = `
          <div class="card border-2 rounded-3 p-3 text-center package-option" style="cursor: pointer; transition: all 0.3s;">
            <h6 class="fw-semibold mb-2">${pkg.duration}</h6>
            <div class="mb-2">
              <span class="fs-5 fw-bold text-primary">₹${pkg.price}</span>
              <small class="text-muted text-decoration-line-through ms-2">₹${pkg.original}</small>
            </div>
            <button class="btn btn-sm btn-primary rounded-2 w-100">Add</button>
          </div>
        `;
        container.appendChild(col);
      });
    }
  });

  // Add hover effect
  document.addEventListener('mouseover', function(e) {
    if (e.target.closest('.package-option')) {
      e.target.closest('.package-option').style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
      e.target.closest('.package-option').style.borderColor = '#0d6efd';
    }
  });

  document.addEventListener('mouseout', function(e) {
    if (e.target.closest('.package-option')) {
      e.target.closest('.package-option').style.boxShadow = '';
      e.target.closest('.package-option').style.borderColor = '';
    }
  });

  // Add to cart function
  function addToCart() {
    alert('Service added to cart!');
    const modal = bootstrap.Modal.getInstance(document.getElementById('packageModal'));
    modal.hide();
  }
</script>

@endsection