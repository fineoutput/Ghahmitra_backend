@extends('frontend.common.app')
@section('title','My Requests')
@section('content')
<style>
    .order-details-wrapper{
    padding:30px 0;
}

.card-box {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 5px 18px rgb(0 0 0 / 17%);
    margin-bottom: 20px;
}

.section-title{
    font-weight:600;
    margin-bottom:20px;
}

.icon-circle{
    width:48px;
    height:48px;
    border-radius:50%;
    background:#fff7e6;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.request-id{
    font-size:14px;
    color:#4f6ef7;
}

.service-item{
    font-size:14px;
    margin-bottom:8px;
}

.price{
    color:#4f6ef7;
}

.alert-cancel{
    background:#f8e9e9;
    border-radius:12px;
    padding:15px;
    font-size:14px;
    color:#7a3c3c;
    position:relative;
    margin-bottom:20px;
}

.close-x{
    position:absolute;
    right:15px;
    top:12px;
    cursor:pointer;
}

.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:12px;
    font-size:14px;
}

.detail-row{
    font-size:14px;
    margin-bottom:12px;
    color:#555;
}

.dot{
    margin:0 6px;
}

.action-container{
    display:flex;
    gap:10px;
    margin-top:20px;
}

.action-btn{
    flex:1;
    padding:12px 16px;
    border-radius:8px;
    border:none;
    font-weight:600;
    cursor:pointer;
    transition:all 0.3s;
    font-size:14px;
}

.action-btn.start{
    background:#4a7ff3;
    color:#fff;
}

.action-btn.start:hover{
    background:#3b6fe0;
}

.action-btn.end{
    background:#ff6b6b;
    color:#fff;
}

.action-btn.end:hover{
    background:#e63946;
}

.otp-modal-content{
    text-align:center;
}

.otp-inputs{
    display:flex;
    gap:8px;
    justify-content:center;
    margin:20px 0;
}

.otp-box{
    width:50px;
    height:50px;
    font-size:24px;
    text-align:center;
    border:2px solid #ddd;
    border-radius:8px;
}

.otp-box:focus{
    border-color:#4a7ff3;
    outline:none;
}

.otp-timer{
    font-size:12px;
    color:#999;
    margin-top:12px;
}

.otp-resend{
    color:#4a7ff3;
    cursor:pointer;
    font-weight:600;
    text-decoration:none;
}

/* Review & rating */
.rating-stars{
    display:flex;
    justify-content:center;
    gap:8px;
    font-size:28px;
    margin:16px 0;
}

.rating-stars .star{
    cursor:pointer;
    color:#ddd;
    transition:color 0.2s, transform 0.2s;
}

.rating-stars .star.selected,
.rating-stars .star.hovered{
    color:#ffc107;
    transform:scale(1.05);
}

.review-textarea{
    resize:vertical;
    min-height:80px;
}

.action-btn.end:disabled{
    background:#f3b4b4;
    cursor:not-allowed;
    opacity:0.7;
}

</style>
<div class="container">


<div class="order-details-wrapper">

    <div class="row g-4">

        <!-- LEFT COLUMN -->
        <div class="col-lg-7">

            <!-- Service Request -->
            <div class="card-box">
                <h5 class="section-title">Service Request</h5>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="icon-circle">🎟</div>
                    <div>
                        <div class="request-id">Request #8192693</div>
                        <div class="fw-semibold">Electricians</div>
                    </div>
                </div>

                <div class="service-item d-flex justify-content-between">
                    <div>1. Socket & Switchboard Repair/Installation</div>
                    <div class="price">Starts at ₹249</div>
                </div>

                <hr>

                <div class="service-item d-flex justify-content-between">
                    <div>2. Fan Installation & Repair</div>
                    <div class="price">Starts at ₹249</div>
                </div>

                <!-- Service Action Buttons -->
                <div class="action-container">
                    <button class="action-btn start" id="startServiceBtn" onclick="sendOtpForStartService()">
                        <i class="fa-solid fa-play me-2"></i> Start Service
                    </button>
                    <button class="action-btn end" id="endServiceBtn" onclick="sendOtpForEndService()" disabled>
                        <i class="fa-solid fa-stop me-2"></i> End Service
                    </button>
                </div>
            </div>

            <!-- Cancel Message -->
            <div class="alert-cancel">
                Your booking has been cancelled. We hope to have the opportunity to serve you again in the future.
                <span class="close-x">✕</span>
            </div>

            <!-- Note -->
            <div class="card-box">
                <p class="mb-0 text-muted">
                    Note: A professional consultation is required for an accurate estimate. 
                    Our team will review your project details and provide a customized quote tailored to your needs.
                </p>
            </div>

            <!-- Payment Summary -->
            <div class="card-box">
                <h5 class="section-title">Payment Summary</h5>

                <div class="summary-row">
                    <span>Item total</span>
                    <span>₹747</span>
                </div>

                <div class="summary-row">
                    <span>Visiting Charges</span>
                    <span>₹0</span>
                </div>

                <hr>

                <div class="summary-row fw-semibold">
                    <span>Total</span>
                    <span>₹747</span>
                </div>

                <hr>

                <div class="summary-row">
                    <span>Pay After Consultation</span>
                    <span>₹747</span>
                </div>
            </div>

        </div>


        <!-- RIGHT COLUMN -->
        <div class="col-lg-5">

            <!-- Download App -->
            <div class="card-box">
                <h6 class="fw-semibold">Download the Grah Mitra App !</h6>
                <p class="small text-muted">
                    Track your bookings, book appointments, and manage projects all in one place.
                </p>

                <div class="d-flex gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" height="40">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" height="40">
                </div>
            </div>

            <!-- Booking Details -->
            <div class="card-box">
                <h6 class="fw-semibold mb-3">Booking Details</h6>

                <div class="detail-row">
                    📞 9461937396 <span class="dot">•</span> raj
                </div>

                <div class="detail-row">
                    📍 Sukhdeopura Nohara, Jaipur, 302022
                </div>

                <div class="detail-row">
                    📅 Feb 23, 2026, 04:26 PM
                </div>
            </div>

        </div>

    </div>

</div>
</div>

<!-- Start Service OTP Modal -->
<div class="modal fade" id="startServiceOtpModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 p-4">
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      
      <div class="otp-modal-content">
        <h4 class="fw-bold mb-2">Verify OTP to Start Service</h4>
        <p class="text-muted small mb-4">Enter the 6-digit OTP sent to your phone</p>
        
        <div class="otp-inputs" id="startServiceOtpInputs">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
        </div>

        <div class="otp-timer">
          Resend OTP in <span id="startServiceTimer">30</span>s | <a href="#" class="otp-resend" onclick="resendOtpStartService(event)">Resend Now</a>
        </div>

        <button class="btn btn-primary w-100 mt-4 rounded-3" onclick="verifyOtpStartService()">Verify & Start Service</button>
      </div>
    </div>
  </div>
</div>

<!-- End Service OTP + Review Modal -->
<div class="modal fade" id="endServiceOtpModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 p-4">
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      
      <!-- Step 1: Verify OTP to end service -->
      <div class="otp-modal-content" id="endOtpStep">
        <h4 class="fw-bold mb-2">Verify OTP to End Service</h4>
        <p class="text-muted small mb-4">Enter the 6-digit OTP sent to your phone</p>
        
        <div class="otp-inputs" id="endServiceOtpInputs">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
          <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
        </div>

        <div class="otp-timer">
          Resend OTP in <span id="endServiceTimer">30</span>s | <a href="#" class="otp-resend" onclick="resendOtpEndService(event)">Resend Now</a>
        </div>

        <button class="btn btn-danger w-100 mt-4 rounded-3" onclick="verifyOtpEndService()">Verify & End Service</button>
      </div>

      <!-- Step 2: Review and rating -->
      <div class="otp-modal-content d-none" id="reviewStep">
        <h4 class="fw-bold mb-2">Rate your service</h4>
        <p class="text-muted small mb-3">How was your experience with the professional?</p>

        <div class="rating-stars" id="ratingStars">
          <span class="star" data-value="1">★</span>
          <span class="star" data-value="2">★</span>
          <span class="star" data-value="3">★</span>
          <span class="star" data-value="4">★</span>
          <span class="star" data-value="5">★</span>
        </div>

        <textarea class="form-control review-textarea mb-3" id="reviewComment" placeholder="Share your feedback (optional)"></textarea>

        <button class="btn btn-primary w-100 rounded-3" onclick="submitReview()">Submit review</button>
      </div>
    </div>
  </div>
</div>

<script>
  // OTP timers & service state
  let startServiceTimerInterval;
  let endServiceTimerInterval;
  let serviceInProgress = false;
  let selectedRating = 0;

  // Send OTP for Start Service
  function sendOtpForStartService(){
    if (serviceInProgress) {
      alert('Service is already in progress.');
      return;
    }
    console.log('Sending OTP for Start Service...');
    alert('OTP sent to your registered phone number');
    
    // Show modal
    var modal = new bootstrap.Modal(document.getElementById('startServiceOtpModal'));
    modal.show();
    
    // Start timer
    startOtpTimer('startServiceTimer', 30);
    
    // Setup OTP input navigation
    setupOtpInputNavigation('startServiceOtpInputs');
  }

  // Send OTP for End Service
  function sendOtpForEndService(){
    if (!serviceInProgress) {
      alert('Please start the service first.');
      return;
    }
    console.log('Sending OTP for End Service...');
    alert('OTP sent to your registered phone number');
    
    // Show modal
    var modal = new bootstrap.Modal(document.getElementById('endServiceOtpModal'));
    modal.show();
    
    // Start timer
    startOtpTimer('endServiceTimer', 30);
    
    // Setup OTP input navigation
    setupOtpInputNavigation('endServiceOtpInputs');
  }

  // Start OTP countdown timer
  function startOtpTimer(elementId, duration){
    let remaining = duration;
    clearInterval(startServiceTimerInterval);
    clearInterval(endServiceTimerInterval);
    
    const timerElement = document.getElementById(elementId);
    const updateTimer = () => {
      timerElement.innerText = remaining;
      if(remaining <= 0){
        clearInterval(startServiceTimerInterval);
        clearInterval(endServiceTimerInterval);
        timerElement.innerText = '00';
      }
      remaining--;
    };
    
    const intervalId = setInterval(updateTimer, 1000);
    if(elementId.includes('startService')) startServiceTimerInterval = intervalId;
    else endServiceTimerInterval = intervalId;
  }

  // Setup OTP input navigation
  function setupOtpInputNavigation(containerId){
    const container = document.getElementById(containerId);
    const inputs = container.querySelectorAll('.otp-box');
    
    inputs.forEach((input, index) => {
      input.addEventListener('input', function(e){
        if(e.target.value.length === 1 && index < inputs.length - 1){
          inputs[index + 1].focus();
        }
      });
      
      input.addEventListener('keydown', function(e){
        if(e.key === 'Backspace' && e.target.value === '' && index > 0){
          inputs[index - 1].focus();
        }
      });
    });
  }

  // Verify OTP for Start Service
  function verifyOtpStartService(){
    const container = document.getElementById('startServiceOtpInputs');
    const otp = Array.from(container.querySelectorAll('.otp-box')).map(input => input.value).join('');
    
    if(otp.length !== 6){
      alert('Please enter all 6 digits of OTP');
      return;
    }
    
    console.log('Verifying OTP for Start Service: ' + otp);
    alert('Service started successfully!');
    serviceInProgress = true;

    // Update buttons
    const startBtn = document.getElementById('startServiceBtn');
    const endBtn = document.getElementById('endServiceBtn');
    if (startBtn) {
      startBtn.disabled = true;
      startBtn.textContent = 'Service in progress';
    }
    if (endBtn) {
      endBtn.disabled = false;
    }
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('startServiceOtpModal')).hide();
    
    // You can make an API call here to start the service
  }

  // Verify OTP for End Service
  function verifyOtpEndService(){
    const container = document.getElementById('endServiceOtpInputs');
    const otp = Array.from(container.querySelectorAll('.otp-box')).map(input => input.value).join('');
    
    if(otp.length !== 6){
      alert('Please enter all 6 digits of OTP');
      return;
    }
    
    console.log('Verifying OTP for End Service: ' + otp);
    alert('Service ended successfully!');
    serviceInProgress = false;

    // Reset buttons
    const startBtn = document.getElementById('startServiceBtn');
    const endBtn = document.getElementById('endServiceBtn');
    if (startBtn) {
      startBtn.disabled = true;
    }
    if (endBtn) {
      endBtn.disabled = true;
    }

    // Move to review step inside the same modal
    const otpStep = document.getElementById('endOtpStep');
    const reviewStep = document.getElementById('reviewStep');
    if (otpStep && reviewStep) {
      otpStep.classList.add('d-none');
      reviewStep.classList.remove('d-none');
      initRatingStars();
    }

    // You can make an API call here to end the service before showing review
  }

  // Resend OTP for Start Service
  function resendOtpStartService(e){
    e.preventDefault();
    console.log('Resending OTP for Start Service...');
    alert('OTP resent to your phone');
    startOtpTimer('startServiceTimer', 30);
  }

  // Resend OTP for End Service
  function resendOtpEndService(e){
    e.preventDefault();
    console.log('Resending OTP for End Service...');
    alert('OTP resent to your phone');
    startOtpTimer('endServiceTimer', 30);
  }

  // Init rating stars interaction
  function initRatingStars(){
    const starsContainer = document.getElementById('ratingStars');
    if (!starsContainer) return;

    const stars = starsContainer.querySelectorAll('.star');
    stars.forEach(star => {
      const value = parseInt(star.getAttribute('data-value'), 10);

      star.onclick = function(){
        selectedRating = value;
        updateStarStyles(stars);
      };

      star.onmouseenter = function(){
        updateStarStyles(stars, value);
      };

      star.onmouseleave = function(){
        updateStarStyles(stars);
      };
    });
  }

  function updateStarStyles(stars, hoverValue = 0){
    stars.forEach(star => {
      const val = parseInt(star.getAttribute('data-value'), 10);
      star.classList.toggle('selected', val <= selectedRating);
      star.classList.toggle('hovered', hoverValue && val <= hoverValue);
      if (!hoverValue) {
        star.classList.remove('hovered');
      }
    });
  }

  // Submit review after service end
  function submitReview(){
    if (!selectedRating){
      alert('Please select a star rating.');
      return;
    }

    const commentEl = document.getElementById('reviewComment');
    const comment = commentEl ? commentEl.value.trim() : '';

    console.log('Review submitted', { rating: selectedRating, comment });
    alert('Thank you for your feedback!');

    // Close modal and optionally reset steps
    const modalEl = document.getElementById('endServiceOtpModal');
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) modalInstance.hide();
  }
</script>
@endsection