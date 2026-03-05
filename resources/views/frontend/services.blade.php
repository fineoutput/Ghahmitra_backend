@extends('frontend.common.app')
@section('title','Services')
@section('content')
<style>
  .services-left { max-height: calc(100vh - 140px); overflow-y: auto; padding-right: 12px; }
  .services-right { position: sticky; top: 20px; align-self: flex-start; }
  .qty-counter { gap: 8px; }
  .cart-item { border-bottom: 1px solid #eef0f3; padding-bottom: 12px; margin-bottom: 12px; }
  .cart-item .item-title {
    font-size: 0.80rem;
}
  .cart-summary { font-weight: 600; }
</style>

<!-- ================= SERVICE PAGE ================= -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">

      <!-- ================= LEFT: SERVICE SELECTOR ================= -->
      <div class="col-lg-3">
        <div class="services-left mb-5">
        <div class="card border-light-custom shadow-sm rounded-4">
          <h5 class="fw-bold mb-4">What service do you need ?</h5>
          
          <div class="row g-3">
            <!-- Waxing -->
            @foreach ($services as $service)
               <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">{{ $service->name }}</p>
              </div>
            </div>
            @endforeach
    
          </div>
        </div>
      </div>>
      </div>

      <!-- ================= SERVICE CATEGORIES SECTION ================= -->
      

      <!-- ================= MIDDLE: SERVICE LISTINGS ================= -->
      <div class="col-lg-6 services-left">
        
        <!-- Service Card 1 -->
        @foreach ($services_details as $service_detail)
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <a style="text-decoration: none; color: #666;" class="open-reviews-modal">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (1666 reviews)</small>
              </a>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹{{ number_format($service_detail->price, 2) }}</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">{!! $service_detail->description !!}</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                @if(!empty($service_detail->image[0]))
                  <img src="{{ asset($service_detail->image[0]) }}" 
                      alt="{{ $service_detail->name }}"
                      class="img-fluid rounded-3"
                      style="height: 180px; width: 100%; object-fit: cover;">
              @endif
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal{{ $service_detail->id }}" 
                data-service-name="{{ $service_detail->name }}" 
                data-service-price="{{ $service_detail->price }}" 
                data-service-original="{{ $service_detail->mrp }}"
                data-service-rating="4.82"
                data-service-reviews="4.82">Add</button>
            </div>

          </div>
        </div>


        {{-- MODEL CODE --}}
        <div class="modal fade" id="packageModal{{ $service_detail->id }}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 p-4">
      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="mb-4">
        <!-- Splide slider inside modal -->
        <div id="serviceModalSplide" class="splide">
          <div class="splide__track">
            <ul class="splide__list">
               @if(!empty($service_detail->image) && is_array($service_detail->image))
        @foreach($service_detail->image as $img)
            <li class="splide__slide">
                <img src="{{ asset($img) }}"
                     alt="{{ $service_detail->name }}"
                     class="w-100 rounded-3"
                     style="height:300px; object-fit:cover;">
            </li>
        @endforeach
    @else
        {{-- Fallback image --}}
        <li class="splide__slide">
            <img src="https://via.placeholder.com/800x300?text=No+Image"
                 class="w-100 rounded-3">
        </li>
    @endif
            </ul>
          </div>
        </div>
      </div>
      <!-- Service Header -->
      <div class="mb-4 pb-3 border-bottom">
        <div class="row align-items-center">
          <div class="col-auto">
            {{-- <div style="font-size: 3rem;">💆</div> --}}
          </div>
          <div class="col">
            <h5 class="fw-bold mb-1" id="modalServiceName">Service Name</h5>
            <div class="d-flex gap-3 align-items-center">
              <div class="d-flex align-items-center">
                <span class="badge bg-primary me-2" id="modalServiceRating">4.82</span>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 open-reviews-modal">
                  <span class="me-1">★</span>
                  <span id="modalServiceRatingText">4.82</span>
                  <span class="text-muted ms-1">(<span id="modalServiceReviews">1666</span> reviews)</span>
                </button>
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
          <li class="mb-2"><small><strong>✓</strong> {!! $service_detail->description_2 !!}</small></li>
        </ul>
      </div>

      <!-- Terms -->
      <div class="mb-4 p-3 bg-light rounded-3">
        <h6 class="fw-bold mb-2">Terms & Conditions</h6>
        <small class="text-muted d-block mb-2">• {!! $service_detail->description_3 !!}</small>
      </div>

      <!-- Action Buttons -->
      <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary rounded-3 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary rounded-3 flex-grow-1" onclick="addToCart()">Done</button>
      </div>
    </div>
  </div>
</div>
        @endforeach
       

        <!-- Load More -->
        <div class="text-center">
          <button class="btn btn-outline-dark rounded-3">Load More Services</button>
        </div>

      </div>

      <!-- ================= RIGHT: CART & OFFERS ================= -->
      <div class="col-lg-3 services-right">

        <!-- Cart Card (pre-populated with one item) -->
        <div class="card border-light-custom shadow-sm rounded-4 p-4 mb-4">
          <div class="mb-3">
            <span class="ms-2 fw-bold">Your Cart</span>
            <div style="font-size: 1.8rem; display:inline-block;">🛒</div>
          </div>

          <div class="cart-item d-flex justify-content-between align-items-start">
            <div class="me-3">
              <div class="item-title">3 BHK Deep Furnished Apartment Full Home Cleaning</div>
              <div class="text-muted small">Starts at ₹5,199</div>
            </div>
            <div class="text-end">
              <div class="mb-2">
                <div class="qty-counter d-inline-flex align-items-center">
                  <button type="button" class="btn btn-sm btn-outline-primary qty-decrease" data-target="cart">-</button>
                  <span class="qty-number mx-2">1</span>
                  <button type="button" class="btn btn-sm btn-primary qty-increase" data-target="cart">+</button>
                </div>
              </div>
              <div class="fw-bold">₹5,199</div>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="cart-summary">₹<span >5199</span></div>
            <a href="{{ route('cart') }}" class="btn btn-primary">View Cart</a>
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
          <h6 class="fw-bold mb-3">Why Grah Mitra?</h6>
          <div class="d-flex gap-3 align-items-start mb-3">
            <div style="font-size: 1.5rem;">✓</div>
            <div>
              <small class="fw-semibold d-block">Verified & Vetted professionals</small>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start mb-3">
            <div style="font-size: 1.5rem;">✓</div>
            <div>
              <small class="fw-semibold d-block">Matched to your Needs.</small>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-start">
            <div style="font-size: 1.5rem;">✓</div>
            <div>
              <small class="fw-semibold d-block">Customer support at every step.</small>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Splide CSS for modal slider -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

<!-- ================= PACKAGE DETAILS MODAL ================= -->


<!-- ================= REVIEWS MODAL ================= -->
<div class="modal fade" id="reviewsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 p-4">
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="mb-3">
        <div class="d-flex align-items-center mb-1">
          <span style="font-size: 1.6rem;" class="me-2">★</span>
          <span class="fw-bold" style="font-size: 1.6rem;" id="reviewsModalRating">4.82</span>
        </div>
        <small class="text-muted"><span id="reviewsModalCount">246K</span> reviews</small>
      </div>

      <!-- Filters tabs -->
      <div class="mb-2 fw-semibold">Filters</div>
      <ul class="nav nav-tabs small mb-3" id="reviewsFilterTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="rating-tab" data-bs-toggle="tab" data-bs-target="#ratingTabPane" type="button" role="tab">
            Rating
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="sort-tab" data-bs-toggle="tab" data-bs-target="#sortTabPane" type="button" role="tab">
            Sort By
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#servicesTabPane" type="button" role="tab">
            Services
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#othersTabPane" type="button" role="tab">
            Others
          </button>
        </li>
      </ul>

      <div class="tab-content mb-3" id="reviewsFilterTabsContent">
        <!-- Rating filter -->
        <div class="tab-pane fade show active" id="ratingTabPane" role="tabpanel" aria-labelledby="rating-tab">
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="" id="rating5">
            <label class="form-check-label" for="rating5">5 Star</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="" id="rating4">
            <label class="form-check-label" for="rating4">4 Star</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="" id="rating3">
            <label class="form-check-label" for="rating3">3 Star</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="" id="rating2">
            <label class="form-check-label" for="rating2">2 Star</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="rating1">
            <label class="form-check-label" for="rating1">1 Star</label>
          </div>
        </div>

        <!-- Sort By filter -->
        <div class="tab-pane fade" id="sortTabPane" role="tabpanel" aria-labelledby="sort-tab">
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="sortByOptions" id="sortRecent" checked>
            <label class="form-check-label" for="sortRecent">Recent</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sortByOptions" id="sortDetailed">
            <label class="form-check-label" for="sortDetailed">Most detailed</label>
          </div>
        </div>

        <!-- Services placeholder -->
        <div class="tab-pane fade" id="servicesTabPane" role="tabpanel" aria-labelledby="services-tab">
          <small class="text-muted">Filter reviews by specific services (coming soon).</small>
        </div>

        <!-- Others placeholder -->
        <div class="tab-pane fade" id="othersTabPane" role="tabpanel" aria-labelledby="others-tab">
          <small class="text-muted">Additional filters (coming soon).</small>
        </div>
      </div>

      <!-- Rating distribution + sample reviews -->
      <div class="mb-3">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mb-3 gap-3">
          <div>
            <div class="d-flex align-items-center mb-1">
              <span class="me-2" style="font-size: 1.4rem;">★</span>
              <span class="fw-bold" style="font-size: 1.4rem;">4.82</span>
            </div>
            <small class="text-muted">170K reviews</small>
          </div>
          <div class="flex-grow-1 w-100">
            <div class="d-flex align-items-center mb-1">
              <small class="me-2">5</small>
              <div class="progress flex-grow-1 me-2" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 90%;"></div>
              </div>
              <small class="text-muted">155K</small>
            </div>
            <div class="d-flex align-items-center mb-1">
              <small class="me-2">4</small>
              <div class="progress flex-grow-1 me-2" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 4%;"></div>
              </div>
              <small class="text-muted">6K</small>
            </div>
            <div class="d-flex align-items-center mb-1">
              <small class="me-2">3</small>
              <div class="progress flex-grow-1 me-2" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 2%;"></div>
              </div>
              <small class="text-muted">3K</small>
            </div>
            <div class="d-flex align-items-center mb-1">
              <small class="me-2">2</small>
              <div class="progress flex-grow-1 me-2" style="height: 6px;">
                <div class="progress-bar bg-warning" style="width: 1%;"></div>
              </div>
              <small class="text-muted">1K</small>
            </div>
            <div class="d-flex align-items-center">
              <small class="me-2">1</small>
              <div class="progress flex-grow-1 me-2" style="height: 6px;">
                <div class="progress-bar bg-danger" style="width: 1%;"></div>
              </div>
              <small class="text-muted">2K</small>
            </div>
          </div>
        </div>

        <h6 class="fw-bold mb-3">All reviews</h6>

        <div class="border rounded-3 p-3 mb-3">
          <div class="d-flex justify-content-between align-items-start mb-1">
            <div>
              <div class="fw-semibold">Debtanu Maji</div>
              <small class="text-muted">Feb 23, 2026 • For 60 mins, Winter Add‑on</small>
            </div>
            <span class="badge bg-success rounded-pill" style="min-width: 32px;">5</span>
          </div>
          <small class="text-muted d-block">
            Very good massage. I had pain in my shoulder and back which is relieved now. She listened to where I had pain and then massaged accordingly as well. Good work from her.
          </small>
        </div>

        <div class="border rounded-3 p-3 mb-1">
          <div class="d-flex justify-content-between align-items-start mb-1">
            <div>
              <div class="fw-semibold">Atraye Panchanan</div>
              <small class="text-muted">Feb 23, 2026 • For 90 mins</small>
            </div>
            <span class="badge bg-success rounded-pill" style="min-width: 32px;">5</span>
          </div>
          <small class="text-muted d-block">
            Riya has given a wonderful service. I am feeling very relaxed and my pain knots are almost opened up. She is very well trained and knows the pressure points very well.
          </small>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-3">
        <button type="button" class="btn btn-link text-decoration-none px-0">Reset</button>
        <button type="button" class="btn btn-primary rounded-3 px-4">Apply</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<script>
  // Initialize Splide slider & modal behaviors
  document.addEventListener('DOMContentLoaded', function () {
    const splideEl = document.getElementById('serviceModalSplide');
    if (splideEl) {
      new Splide('#serviceModalSplide', {
        type: 'loop',
        perPage: 1,
        arrows: true,
        pagination: true,
      }).mount();
    }

    // Open reviews modal when user clicks on review-only button
    document.addEventListener('click', function (e) {
      const trigger = e.target.closest('.open-reviews-modal');
      if (trigger) {
        const pkgEl = document.getElementById('packageModal');
        const reviewsEl = document.getElementById('reviewsModal');
        if (pkgEl) {
          const pkgInstance = bootstrap.Modal.getInstance(pkgEl);
          if (pkgInstance) {
            pkgInstance.hide();
          }
        }
        if (reviewsEl) {
          const reviewsInstance = new bootstrap.Modal(reviewsEl);
          reviewsInstance.show();
        }
      }
    });

    // Open detail modal when user clicks "Show more"
    document.addEventListener('click', function (e) {
      const link = e.target.closest('.open-details-modal');
      if (link) {
        e.preventDefault();
        const card = link.closest('.service-card');
        if (!card) return;
        const addBtn = card.querySelector('.add-to-cart-btn');
        if (!addBtn) return;
        openPackageModalFromButton(addBtn);
      }
    });
  });

  // Initialize packageModal instance once
  let packageModalInstance = null;
  function getPackageModal() {
    if (!packageModalInstance) {
      packageModalInstance = new bootstrap.Modal(document.getElementById('packageModal'));
    }
    return packageModalInstance;
  }

  function populatePackageModalFromButton(btn) {
    const serviceName = btn.getAttribute('data-service-name');
    const servicePrice = btn.getAttribute('data-service-price');
    const serviceRating = btn.getAttribute('data-service-rating');
    const serviceReviews = btn.getAttribute('data-service-reviews');

    // Update modal content
    document.getElementById('modalServiceName').textContent = serviceName;
    document.getElementById('modalServiceRating').textContent = serviceRating;
    const ratingTextEl = document.getElementById('modalServiceRatingText');
    if (ratingTextEl) ratingTextEl.textContent = serviceRating;
    document.getElementById('modalServiceReviews').textContent = serviceReviews;

    // Generate package options
    const packages = packageData[serviceName] || packageData['Pack of 4'];
    const container = document.getElementById('packageOptionsContainer');
    container.innerHTML = '';

    packages.forEach(pkg => {
      const col = document.createElement('div');
      col.className = 'col-6 col-md-4';
      col.innerHTML = `
        <div class="card border-2 rounded-3 p-3 text-left package-option" style="cursor: pointer; transition: all 0.3s;">
          <h6 class="fw-semibold mb-2">${pkg.duration}</h6>
          <div class="mb-2">
            <span class="fs-5 fw-bold text-primary">₹${pkg.price}</span>
            <small class="text-muted text-decoration-line-through ms-2">₹${pkg.original}</small>
          </div>
          <button class="btn btn-sm btn-primary package-select-btn rounded-2" style='width:40%'>Add</button>
        </div>
      `;
      container.appendChild(col);
    });
  }

  function openPackageModalFromButton(btn) {
    populatePackageModalFromButton(btn);
    getPackageModal().show();
  }

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

  // Handle Add button click: only populate, Bootstrap handles opening via data attributes
  document.addEventListener('click', function(e) {
    if (e.target.closest('.add-to-cart-btn')) {
      const btn = e.target.closest('.add-to-cart-btn');
      populatePackageModalFromButton(btn);
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
    getPackageModal().hide();
  }

  // Clean up backdrop when modal is hidden
  document.getElementById('packageModal').addEventListener('hidden.bs.modal', function () {
    // Remove any lingering backdrops
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
  });
  
  // Note: clicking the service card itself no longer opens the details modal.

  // Add hover effect to service cards
  document.addEventListener('mouseover', function(e) {
    if (e.target.closest('.service-card')) {
      e.target.closest('.service-card').style.boxShadow = '0 8px 20px rgba(0,0,0,0.12)';
      e.target.closest('.service-card').style.transform = 'translateY(-4px)';
    }
  });

  document.addEventListener('mouseout', function(e) {
    if (e.target.closest('.service-card')) {
      e.target.closest('.service-card').style.boxShadow = '';
      e.target.closest('.service-card').style.transform = '';
    }
  });

  // Replace Add buttons with quantity counters
  function replaceWithCounter(btn, initialCount = 1) {
    const originalBtn = btn.cloneNode(true);
    const container = document.createElement('div');
    container.className = 'qty-counter d-inline-flex align-items-center';
    container.style.gap = '6px';

    const dec = document.createElement('button');
    dec.type = 'button';
    dec.className = 'btn btn-sm btn-outline-primary qty-decrease';
    dec.textContent = '-';

    const num = document.createElement('span');
    num.className = 'qty-number';
    num.textContent = initialCount;

    const inc = document.createElement('button');
    inc.type = 'button';
    inc.className = 'btn btn-sm btn-primary qty-increase';
    inc.textContent = '+';

    container.appendChild(dec);
    container.appendChild(num);
    container.appendChild(inc);

    btn.replaceWith(container);

    dec.addEventListener('click', function () {
      let n = parseInt(num.textContent, 10);
      n--;
      if (n < 1) {
        container.replaceWith(originalBtn);
      } else {
        num.textContent = n;
      }
    });

    inc.addEventListener('click', function () {
      let n = parseInt(num.textContent, 10);
      n++;
      num.textContent = n;
    });
  }

  // Delegate clicks: transform package selection buttons to counters on click
  document.addEventListener('click', function (e) {
    const selectBtn = e.target.closest('.package-select-btn');
    if (selectBtn) {
      // if already a counter child, ignore
      if (selectBtn.closest('.qty-counter')) return;
      // replace package select button with counter
      replaceWithCounter(selectBtn, 1);
    }
  });

  // Cart helpers: update subtotal and wire cart qty buttons
  function updateCartSubtotal() {
    let subtotal = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
      const priceText = item.querySelector('.fw-bold')?.textContent || '';
      const price = parseInt(priceText.replace(/[^0-9]/g, ''), 10) || 0;
      const qty = parseInt(item.querySelector('.qty-number')?.textContent || '0', 10) || 0;
      subtotal += price * qty;
    });
    document.getElementById('cartSubtotal').textContent = subtotal.toLocaleString('en-IN');
  }

  // wire existing cart counter buttons
  document.addEventListener('click', function (e) {
    const inc = e.target.closest('.qty-increase');
    const dec = e.target.closest('.qty-decrease');
    if (inc) {
      const container = inc.closest('.qty-counter');
      const num = container.querySelector('.qty-number');
      let n = parseInt(num.textContent, 10) || 0;
      n++;
      num.textContent = n;
      updateCartSubtotal();
    }
    if (dec) {
      const container = dec.closest('.qty-counter');
      const num = container.querySelector('.qty-number');
      let n = parseInt(num.textContent, 10) || 0;
      n--;
      const parent = dec.closest('.cart-item');
      if (n < 1) {
        // replace cart item counter with Add button inside the cart-item
        const addBtn = document.createElement('button');
        addBtn.type = 'button';
        addBtn.className = 'btn btn-outline-primary btn-sm add-to-cart-btn';
        addBtn.textContent = 'Add';
        // attach attributes so it opens modal if needed later
        addBtn.setAttribute('data-bs-toggle', 'modal');
        addBtn.setAttribute('data-bs-target', '#packageModal');
        parent.querySelector('.qty-counter').replaceWith(addBtn);
        updateCartSubtotal();
        return;
      }
      num.textContent = n;
      updateCartSubtotal();
    }
  });

  // initial subtotal calc
  updateCartSubtotal();
</script>

@endsection