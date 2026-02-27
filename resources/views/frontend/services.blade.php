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
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1661431392914-e3fc8ff0e51a?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8V2F4aW5nfGVufDB8fDB8fHww" alt="Waxing" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Waxing</p>
              </div>
            </div>

            <!-- Premium Waxing -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1675898142438-a18bc5f683d7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8UHJlbWl1bSUyMFdheGluZ3xlbnwwfHwwfHx8MA%3D%3D" alt="Premium Waxing" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Premium waxing</p>
              </div>
            </div>

            <!-- Facial -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1732576711143-c4e619fe7ac6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8S29yZWFuJTIwRmFjaWFsfGVufDB8fDB8fHww" alt="Facial" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Facial</p>
              </div>
            </div>

            <!-- Korean Facial -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1732576711152-590d19fe767d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8S29yZWFuJTIwRmFjaWFsfGVufDB8fDB8fHww" alt="Korean Facial" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Korean Facial</p>
              </div>
            </div>

            <!-- Clean Up -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1661776092454-c950768cd4e4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Q2xlYW4lMjBVcCUyMGZhY2V8ZW58MHx8MHx8fDA%3D" alt="Clean Up" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Clean Up</p>
              </div>
            </div>

            <!-- Mani Pedi -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1661497566854-7a75d3e98996?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8TWFuaWN1cmV8ZW58MHx8MHx8fDA%3D" alt="Mani Pedi" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Mani Pedi</p>
              </div>
            </div>

            <!-- Body Scrub -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1677849925842-92267d6b4293?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Qm9keSUyMFNjcnVifGVufDB8fDB8fHww" alt="Body Scrub" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Body Scrub</p>
              </div>
            </div>

            <!-- Treatment -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1661680271644-00e5bdf97627?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZmFjaWFsJTIwVHJlYXRtZW50fGVufDB8fDB8fHww" alt="Treatment" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Treatment</p>
              </div>
            </div>

            <!-- Detan & Bleach -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1661589976754-f1a669f19e68?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8QmxlYWNofGVufDB8fDB8fHww" alt="Detan & Bleach" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Detan & Bleach</p>
              </div>
            </div>

            <!-- Threading & Face Wax -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://images.unsplash.com/photo-1519415387722-a1c3bbef716c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8VGhyZWFkaW5nfGVufDB8fDB8fHww" alt="Threading & Face Wax" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Threading & Face Wax</p>
              </div>
            </div>

            <!-- Hair Colour Application -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1661668935701-2429eb4da878?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8SGFpciUyMENvbG91cnxlbnwwfHwwfHx8MA%3D%3D" alt="Hair Colour Application" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Hair Colour Application</p>
              </div>
            </div>

            <!-- Massage -->
            <div class="col-6 col-sm-6">
              <div class="text-center p-3 rounded-3 border border-light-custom" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <img src="https://plus.unsplash.com/premium_photo-1677849925842-92267d6b4293?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Qm9keSUyMFNjcnVifGVufDB8fDB8fHww" alt="Massage" class="img-fluid rounded-2 mb-2" style="height: 50px; object-fit: cover;">
                <p class="mb-0 fw-semibold small">Massage</p>
              </div>
            </div>
          </div>
        </div>
      </div>>
      </div>

      <!-- ================= SERVICE CATEGORIES SECTION ================= -->
      

      <!-- ================= MIDDLE: SERVICE LISTINGS ================= -->
      <div class="col-lg-6 services-left">
        
        <!-- Service Card 1 -->
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
                  <span class="fw-bold text-dark">₹1,099</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Full body Swedish massage including head, neck & shoulders</li>
                <li class="mb-2">Relaxation and stress relief from professional therapists</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8U3dlZGlzaCUyME1hc3NhZ2V8ZW58MHx8MHx8fDA%3D" alt="Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4" 
                data-service-price="1099" 
                data-service-original="1449"
                data-service-rating="4.82"
                data-service-reviews="1666">Add</button>
            </div>

          </div>
        </div>

        <!-- Service Card 2 -->
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <a style="text-decoration: none; color: #666;" class="open-reviews-modal">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </a>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <a style="text-decoration: none; color: #666;" class="open-reviews-modal">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </a>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <a style="text-decoration: none; color: #666;" class="open-reviews-modal">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </a>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <a style="text-decoration: none; color: #666;" class="open-reviews-modal">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </a>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-md-4 order-2 order-md-1 mt-3 mt-md-0">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold open-details-modal">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="order-1 order-md-2 text-center text-md-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>
        <div class="card service-card border-light-custom shadow-sm rounded-4 p-4 mb-4" style="cursor:pointer; transition:all 0.3s;">
          <div class="d-flex justify-content-between align-items-flex-start">
            
            <!-- Left: Details Section -->
            <div class="flex-grow-1 pe-4">
              <!-- Service Title -->
              <h6 class="fw-bold mb-2">Pack of 4 (Swedish Massage)</h6>
              
              <!-- Rating -->
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">★</span>
                <small><strong>4.82</strong> (2441 reviews)</small>
              </div>
              
              <!-- Price & Duration -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <div>
                  <small class="text-muted d-block">Starts at</small>
                  <span class="fw-bold text-dark">₹999</span>
                </div>
                <div class="text-muted">•</div>
                <div>
                  <small class="text-muted d-block">Duration</small>
                  <span class="fw-bold text-dark">60 mins</span>
                </div>
              </div>
              
              <!-- Description Bullet Points -->
              <ul class="small mb-3 ps-3" style="list-style: disc; color: #666;">
                <li class="mb-2">Professional Swedish massage for complete body relaxation</li>
                <li class="mb-2">Valid for 6 months with flexible booking options</li>
              </ul>
              
              <!-- Show More Link -->
              <a href="#" class="text-primary text-decoration-none small fw-semibold">Show more ▼</a>
            </div>
            
            <!-- Right: Image & Button Section -->
            <div class="text-end" style="min-width: 150px;">
              <!-- Image -->
              <div class="mb-3">
                <img src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Swedish Massage" class="img-fluid rounded-3" style="height: 120px; width: 100%; object-fit: cover;">
              </div>
              
              <!-- Add Button -->
              <button class="btn btn-primary btn-sm add-to-cart-btn w-100" data-bs-toggle="modal" data-bs-target="#packageModal" 
                data-service-name="Pack of 4 (Swedish Massage)" 
                data-service-price="999" 
                data-service-original="1299"
                data-service-rating="4.82"
                data-service-reviews="2441">Add</button>
            </div>

          </div>
        </div>

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
<div class="modal fade" id="packageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 p-4">
      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="mb-4">
        <!-- Splide slider inside modal -->
        <div id="serviceModalSplide" class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              <li class="splide__slide">
                <img class="w-100 rounded-3" src="https://images.unsplash.com/photo-1598901986949-f593ff2a31a6?w=800&auto=format&fit=crop&q=80&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFN3ZWRpc2glMjBNYXNzYWdlfGVufDB8fDB8fHww" alt="Massage Image 1">
              </li>
              <li class="splide__slide">
                <img class="w-100 rounded-3" src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&auto=format&fit=crop&q=80&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8U3dlZGlzaCUyME1hc3NhZ2V8ZW58MHx8MHx8fDA%3D" alt="Massage Image 2">
              </li>
              <li class="splide__slide">
                <img class="w-100 rounded-3" src="https://images.unsplash.com/photo-1598901986903-99a9afbb60fc?w=800&auto=format&fit=crop&q=80&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8U3dlZGlzaCUyME1hc3NhZ2V8ZW58MHx8MHx8fDA%3D" alt="Massage Image 3">
              </li>
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