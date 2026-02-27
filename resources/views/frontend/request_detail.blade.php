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

                <!-- Service status & OTP info (read-only) -->
                <div class="mt-3 p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="small text-muted">Start OTP</div>
                        <div class="fw-semibold" id="startOtpDisplay">123456</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="small text-muted">Current status</div>
                        <span class="badge bg-success" id="serviceStatusBadge">Service ongoing</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">End OTP</div>
                        <div class="fw-semibold" id="endOtpDisplay">—</div>
                    </div>
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

            <!-- Serviceman Details -->
<div class="card-box">
    <h6 class="fw-semibold mb-3">Assigned Professional</h6>

    <div class="d-flex align-items-center gap-3 mb-3">
        <img src="https://randomuser.me/api/portraits/men/32.jpg"
             class="rounded-circle"
             width="70"
             height="70"
             style="object-fit:cover;">
        <div>
            <div class="fw-semibold">Ramesh Sharma</div>
            <div class="small text-muted">Senior Electrician</div>
            <div class="small text-warning">⭐ 4.8 (128 reviews)</div>
        </div>
    </div>

    <div class="detail-row">
        📞 <a href="tel:9461937396" class="text-decoration-none">9461937396</a>
    </div>

    <div class="detail-row">
        🧰 Experience: 7+ Years
    </div>

    <div class="detail-row">
        ✔ Verified Professional
    </div>

    <div class="mt-3">
        <button class="btn btn-outline-primary w-100 rounded-3">
            Contact Professional
        </button>
    </div>
</div>

        </div>

    </div>

</div>
</div>

<!-- Inline Review Section (shown after end OTP is available) -->
<div class="container mb-5">
  <div class="card-box mt-3" id="reviewSection" style="display:none;">
    <h5 class="section-title">Rate your service</h5>
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

<script>
  let selectedRating = 0;

  // Functions you can call when OTPs are received from backend
  function setStartOtp(code) {
    const el = document.getElementById('startOtpDisplay');
    if (el) el.textContent = code;
    const status = document.getElementById('serviceStatusBadge');
    if (status) {
      status.textContent = 'Service ongoing';
      status.classList.remove('bg-secondary', 'bg-danger');
      status.classList.add('bg-success');
    }
  }

  function setEndOtp(code) {
    const el = document.getElementById('endOtpDisplay');
    if (el) el.textContent = code;
    const status = document.getElementById('serviceStatusBadge');
    if (status) {
      status.textContent = 'Service completed';
      status.classList.remove('bg-success');
      status.classList.add('bg-secondary');
    }
    const reviewSection = document.getElementById('reviewSection');
    if (reviewSection) {
      reviewSection.style.display = 'block';
      initRatingStars();
    }
  }

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

  function submitReview(){
    if (!selectedRating){
      alert('Please select a star rating.');
      return;
    }

    const commentEl = document.getElementById('reviewComment');
    const comment = commentEl ? commentEl.value.trim() : '';

    console.log('Review submitted', { rating: selectedRating, comment });
    alert('Thank you for your feedback!');
  }
</script>
@endsection