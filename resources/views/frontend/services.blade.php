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
            <a href="{{url('services-detailes',$service->id)}}">

              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">{{ $service->name }}</p>
              </div>
              </a>
            </div>
            @endforeach
    
          </div>
        </div>
      </div>
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
              {{-- <h6 class="fw-bold mb-2">Pack of 4</h6> --}}
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <a style="text-decoration: none; color: #666;" data-bs-target="#reviewsModal{{ $service_detail->id }}" data-bs-toggle="modal" class="open-reviews-modal">
                <span class="text-warning">★</span>
               @php
                  $averageRating = $service_detail->feedback->avg('star') ?? 0;
                  $reviewCount = $service_detail->feedback->count() ?? 0;
              @endphp

              <small>
                  <strong>{{ number_format($averageRating, 2) }}</strong> 
                  ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
              </small>
                {{-- <small><strong>4.82</strong> (1666 reviews)</small> --}}
              </a>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹{{ number_format($service_detail->price, 2) }}</span>
                </div>
                {{-- <div class="text-muted">•</div> --}}
                {{-- <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div> --}}
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">{!! $service_detail->description !!}</li>
              </ul>
              
              <!-- Show More Link -->
              {{-- <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a> --}}
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
        <div id="serviceModalSplide{{ $service_detail->id }}" class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              @php
                  // Check if it's string (JSON) or already array
                  if (is_string($service_detail->image)) {
                      $images = json_decode($service_detail->image, true) ?? [];
                  } elseif (is_array($service_detail->image)) {
                      $images = $service_detail->image;
                  } else {
                      $images = [];
                  }
              @endphp

              @if(!empty($images))
                  @foreach($images as $img)
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
            <h5 class="fw-bold mb-1" id="modalServiceName">{{$service_detail->name ?? ''}}</h5>
              @php
                  $averageRating = $service_detail->feedback->avg('star') ?? 0;
                  $reviewCount = $service_detail->feedback->count() ?? 0;
              @endphp
            <div class="d-flex gap-3 align-items-center">
              <div class="d-flex align-items-center">
                <span class="badge bg-primary me-2" id="">{{ number_format($averageRating, 2) }}</span>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 open-reviews-modal" data-bs-toggle="modal" data-bs-target="#reviewsModal{{ $service_detail->id }}">
                  <span class="me-1">★</span>
                 

              <small>
                  <strong>{{ number_format($averageRating, 2) }}</strong> 
                  ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
              </small>
                </button>
              </div>
              <small class="text-success">✓ Verified</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Package Options -->
      {{-- <div class="mb-4">
        <h6 class="fw-bold mb-3">Select Duration</h6>
        <div class="row g-3" id="packageOptionsContainer">
          <!-- Package options will be populated here -->
        </div>
      </div> --}}

      <!-- Additional Details -->
      <div class="mb-4 p-3 bg-light rounded-3">
        {{-- <h6 class="fw-bold mb-3">What's Included</h6> --}}
        {{-- <ul class="list-unstyled">
          <li class="mb-2"><small><strong>✓</strong> </small></li>
        </ul> --}}
        <p>{!! $service_detail->description_2 !!}</p>
      </div>

      <!-- Terms -->
      <div class="mb-4 p-3 bg-light rounded-3">
        {{-- <h6 class="fw-bold mb-2">Terms & Conditions</h6> --}}
        {{-- <small class="text-muted d-block mb-2">• </small> --}}
        {!! $service_detail->description_3 !!}
      </div>

      <!-- Action Buttons -->
      <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary rounded-3 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
        @php
          $inCart = collect($cart_items)->where('service_id', $service_detail->id)->first();
          $hasAvailability = !empty($service_detail->availability) && count($service_detail->availability) > 0;
          @endphp


          @if(!$hasAvailability)

              <button 
                  type="button" 
                  class="btn btn-secondary rounded-3 flex-grow-1" disabled>
                  Service not available
              </button>

          @elseif($inCart)

              <button 
                  type="button" 
                  class="btn btn-success rounded-3 flex-grow-1" disabled>
                  Already in Cart
              </button>

          @else

              <button 
                  type="button" 
                  class="btn btn-primary rounded-3 flex-grow-1 addToCartBtn"
                  data-service-id="{{ $service_detail->id }}"
                  data-category-id="{{ $service_detail->services_se_id }}"
                  onclick="addToCart(this)">
                  Done
              </button>

          @endif
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reviewsModal{{ $service_detail->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 p-4">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

            <!-- Dynamic Header -->
            <div class="mb-3">
                <div class="d-flex align-items-center mb-1">
                    <span style="font-size: 1.6rem;" class="me-2">★</span>
                    <span class="fw-bold" style="font-size: 1.6rem;" id="reviewsModalRating">{{ number_format($averageRating, 2) }}</span>
                </div>
                <small class="text-muted"><span id="reviewsModalCount">{{ number_format($reviewCount) }}</span> reviews</small>
            </div>

            <!-- Filters tabs (Services & Others removed as per your instruction) -->
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
            </ul>

            <div class="tab-content mb-3" id="reviewsFilterTabsContent">
                <!-- Rating filter (unchanged) -->
                <div class="tab-pane fade show active" id="ratingTabPane" role="tabpanel" aria-labelledby="rating-tab">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="5" id="rating5">
                        <label class="form-check-label" for="rating5">5 Star</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="4" id="rating4">
                        <label class="form-check-label" for="rating4">4 Star</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="3" id="rating3">
                        <label class="form-check-label" for="rating3">3 Star</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="2" id="rating2">
                        <label class="form-check-label" for="rating2">2 Star</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="rating1">
                        <label class="form-check-label" for="rating1">1 Star</label>
                    </div>
                </div>

                <!-- Sort By filter (unchanged) -->
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
            </div>

            <!-- Rating distribution + dynamic reviews (design exactly same, only dynamic data) -->
            @php
                $starCounts = $service_detail->feedback->countBy('star');
                $fiveStar = $starCounts[5] ?? 0;
                $fourStar = $starCounts[4] ?? 0;
                $threeStar = $starCounts[3] ?? 0;
                $twoStar = $starCounts[2] ?? 0;
                $oneStar = $starCounts[1] ?? 0;

                $fivePercent = $reviewCount > 0 ? round(($fiveStar / $reviewCount) * 100) : 0;
                $fourPercent = $reviewCount > 0 ? round(($fourStar / $reviewCount) * 100) : 0;
                $threePercent = $reviewCount > 0 ? round(($threeStar / $reviewCount) * 100) : 0;
                $twoPercent = $reviewCount > 0 ? round(($twoStar / $reviewCount) * 100) : 0;
                $onePercent = $reviewCount > 0 ? round(($oneStar / $reviewCount) * 100) : 0;
            @endphp

            <div class="mb-3">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mb-3 gap-3">
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <span class="me-2" style="font-size: 1.4rem;">★</span>
                            <span class="fw-bold" style="font-size: 1.4rem;">{{ number_format($averageRating, 2) }}</span>
                        </div>
                        <small class="text-muted">{{ number_format($reviewCount) }} reviews</small>
                    </div>
                    <div class="flex-grow-1 w-100">
                        <!-- 5 Star -->
                        <div class="d-flex align-items-center mb-1">
                            <small class="me-2">5</small>
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ $fivePercent }}%;"></div>
                            </div>
                            <small class="text-muted">{{ number_format($fiveStar) }}</small>
                        </div>
                        <!-- 4 Star -->
                        <div class="d-flex align-items-center mb-1">
                            <small class="me-2">4</small>
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ $fourPercent }}%;"></div>
                            </div>
                            <small class="text-muted">{{ number_format($fourStar) }}</small>
                        </div>
                        <!-- 3 Star -->
                        <div class="d-flex align-items-center mb-1">
                            <small class="me-2">3</small>
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ $threePercent }}%;"></div>
                            </div>
                            <small class="text-muted">{{ number_format($threeStar) }}</small>
                        </div>
                        <!-- 2 Star -->
                        <div class="d-flex align-items-center mb-1">
                            <small class="me-2">2</small>
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: {{ $twoPercent }}%;"></div>
                            </div>
                            <small class="text-muted">{{ number_format($twoStar) }}</small>
                        </div>
                        <!-- 1 Star -->
                        <div class="d-flex align-items-center">
                            <small class="me-2">1</small>
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-danger" style="width: {{ $onePercent }}%;"></div>
                            </div>
                            <small class="text-muted">{{ number_format($oneStar) }}</small>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">All reviews</h6>

                <!-- Dynamic Reviews Loop (only star + description as you mentioned, design 100% same) -->
                @foreach($service_detail->feedback as $feedback)
                    <div class="border rounded-3 p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div>
                                <div class="fw-semibold">{{ optional($feedback->customers)->name ?? 'Anonymous' }}</div>
                                <small class="text-muted">{{ $feedback->created_at ? $feedback->created_at->format('M d, Y') : 'Recent' }} • For the service</small>
                            </div>
                            <span class="badge bg-success rounded-pill" style="min-width: 32px;">{{ $feedback->star }}</span>
                        </div>
                        <small class="text-muted d-block">
                            {{ $feedback->description }}
                        </small>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-3">
                <button type="button" class="btn btn-link text-decoration-none px-0">Reset</button>
                <button type="button" class="btn btn-primary rounded-3 px-4">Apply</button>
            </div>
        </div>
    </div>
</div>

        @endforeach
       

        <!-- Load More -->
        {{-- <div class="text-center">
          <button class="btn btn-outline-dark rounded-3">Load More Services</button>
        </div> --}}

      </div>

      <!-- ================= RIGHT: CART & OFFERS ================= -->
      <div class="col-lg-3 services-right">

        <!-- Cart Card (pre-populated with one item) -->
        {{-- <div class="card border-light-custom shadow-sm rounded-4 p-4 mb-4">
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
        </div> --}}

        <!-- Coupon Offer -->
        {{-- <div class="card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
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
        </div> --}}

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

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>



<script>
function addToCart(button) {
    let service_id = button.dataset.serviceId;
    let category_id = button.dataset.categoryId;

    fetch("{{ route('addtocart') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            service_id: service_id,
            category_id: category_id,
            availability_id: null,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {

        // Remove old toast if exists
        let oldToast = document.getElementById('ajax-toast');
        if(oldToast) oldToast.remove();

        // Determine toast color
        let bgColor = 'bg-success'; // default success
        if(data.status === 401 || data.status === 400) bgColor = 'bg-danger';
        else if(data.status === 200) bgColor = 'bg-info';

        // Create toast container
        let toastDiv = document.createElement('div');
        toastDiv.id = 'ajax-toast';
        toastDiv.className = `toast align-items-center text-white ${bgColor} border-0`;
        toastDiv.role = 'alert';
        toastDiv.ariaLive = 'assertive';
        toastDiv.ariaAtomic = 'true';
        toastDiv.style.position = 'fixed';
        toastDiv.style.top = '20px';
        toastDiv.style.right = '20px';
        toastDiv.style.zIndex = '9999';
        toastDiv.style.minWidth = '250px';

        // Toast content
        toastDiv.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${data.message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        document.body.appendChild(toastDiv);

        // Show bootstrap toast
        let bsToast = new bootstrap.Toast(toastDiv, { delay: 3000 });
        bsToast.show();

        // Close modal if open
        let modal = document.querySelector('.modal.show');
        if(modal){
            let modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        }

    })
    .catch(error => {
        console.log(error);

        // Show error toast
        let oldToast = document.getElementById('ajax-toast');
        if(oldToast) oldToast.remove();

        let toastDiv = document.createElement('div');
        toastDiv.className = 'toast align-items-center text-white bg-danger border-0';
        toastDiv.role = 'alert';
        toastDiv.ariaLive = 'assertive';
        toastDiv.ariaAtomic = 'true';
        toastDiv.style.position = 'fixed';
        toastDiv.style.top = '20px';
        toastDiv.style.right = '20px';
        toastDiv.style.zIndex = '9999';
        toastDiv.style.minWidth = '250px';

        toastDiv.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    Something went wrong
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        document.body.appendChild(toastDiv);
        let bsToast = new bootstrap.Toast(toastDiv, { delay: 3000 });
        bsToast.show();
    });

}
</script>
<style>
/* Slide-down animation */
.slide-alert.slide-down {
    opacity: 0;
    transform: translateY(40px);
}
</style>

<script>
  // Initialize Splide slider & modal behaviors
  document.addEventListener('DOMContentLoaded', function () {
   @foreach($services_details as $service_detail)
  const splideEl{{ $service_detail->id }} = document.getElementById('serviceModalSplide{{ $service_detail->id }}');
  if (splideEl{{ $service_detail->id }}) {
    new Splide('#serviceModalSplide{{ $service_detail->id }}', {
      type: 'loop',
      perPage: 1,
      arrows: true,
      pagination: true,
    }).mount();
  }
@endforeach

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