@extends('frontend.common.app')
@section('title','Services')
@section('content')
<style>

.cart-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
    margin-bottom:20px;
}

.section-title{
    font-weight:600;
    font-size:16px;
    margin-bottom:15px;
}

.primary-btn{
    background:#4a7ff3;
    color:#fff;
    border-radius:8px;
    padding:12px;
    font-weight:500;
    border:none;
    width:100%;
}

.primary-btn:hover{
    background:#3b6fe0;
}

.confirm-btn{
    background:#e3e6ea;
    color:#999;
    border-radius:8px;
    padding:12px;
    font-weight:600;
    border:none;
    width:100%;
}

.qty-box{
    display:flex;
    align-items:center;
    border:1px solid #ddd;
    border-radius:8px;
    overflow:hidden;
    width:110px;
}

.qty-box button{
    border:none;
    background:#f1f1f1;
    padding:6px 12px;
}

.qty-box span{
    flex:1;
    text-align:center;
}

.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
    gap: 10px;
}

.summary-row.align-items-center {
    align-items: center;
}

.summary-total{
    font-weight:600;
    font-size:15px;
}

.note-box ul{
    padding-left:18px;
    margin-bottom:0;
}

.note-box li{
    font-size:14px;
    margin-bottom:8px;
}

/* Address Modal Styling */
.address-modal{
    border-radius:14px;
    padding:10px;
}

.add-new{
    color:#3b6fe0;
    font-weight:500;
    cursor:pointer;
}

.address-option{
    display:flex;
    gap:10px;
    padding:15px;
    border:1px solid #eee;
    border-radius:10px;
    cursor:pointer;
}

.proceed-btn{
    width:100%;
    background:#e3e6ea;
    border:none;
    padding:12px;
    border-radius:8px;
    font-weight:600;
    color:#999;
}

.proceed-btn.enabled{
    background:#4a7ff3;
    color:#fff;
}

/* Add Address Modal */
.add-address-modal{
    border-radius:16px;
    overflow:hidden;
}

/* Slot Selection Modal */
.slot-modal .modal-content {
    border-radius: 16px;
}

.date-selector {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    overflow-x: auto;
}

.date-btn {
    padding: 12px 20px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    white-space: nowrap;
    min-width: 80px;
    transition: all 0.3s;
}

.date-btn.active {
    background: #667eea;
    color: #fff;
    border-color: #667eea;
}

.time-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.time-btn {
    padding: 10px 15px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 0.9rem;
}

.time-btn:hover {
    border-color: #667eea;
}

.time-btn.active {
    background: #667eea;
    color: #fff;
    border-color: #667eea;
}

.selected-info {
    background: #f5f7fb;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.selected-info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.selected-info-row:last-child {
    margin-bottom: 0;
}



.map-placeholder{
    font-size:20px;
    color:#999;
}

.tag-btn{
    border:1px solid #ddd;
    background:#fff;
    padding:8px 18px;
    border-radius:8px;
    cursor:pointer;
}

.tag-btn.active{
    border:2px solid #4a7ff3;
    color:#4a7ff3;
    font-weight:500;
}

.save-btn{
    background:#e3e6ea;
    color:#999;
    border:none;
    padding:12px;
    border-radius:8px;
    font-weight:600;
}

.confirm-btn.enabled{
    background:#4a7ff3;
    color:#fff;
    cursor:pointer;
}

.confirm-btn:disabled{
    background:#e3e6ea;
    color:#999;
    cursor:not-allowed;
}

/* Confirmation Animation Styles */
.booking-confirmation-modal .modal-content {
    border-radius: 16px;
    text-align: center;
}

.booking-confirmation-modal .modal-body {
    padding: 40px 30px;
}

.confirmation-animation {
    position: relative;
    margin: 30px auto;
    width: 120px;
    height: 120px;
}

.checkmark {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #4a7ff3;
    margin: 0 auto 20px;
    animation: scaleIn 0.6s ease-out forwards;
}

.checkmark::after {
    content: '✓';
    color: white;
    font-size: 60px;
    font-weight: bold;
    animation: checkmarkDraw 0.8s ease-out 0.3s forwards;
    opacity: 0;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes checkmarkDraw {
    to {
        opacity: 1;
    }
}

.confirmation-text {
    animation: slideUp 0.6s ease-out 0.5s forwards;
    opacity: 0;
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.booking-details-confirmation {
    background: #f5f7fb;
    padding: 20px;
    border-radius: 12px;
    text-align: left;
    margin-top: 20px;
    animation: slideUp 0.6s ease-out 0.7s forwards;
    opacity: 0;
}

.booking-details-confirmation .detail-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 14px;
}

.booking-details-confirmation .detail-row:last-child {
    margin-bottom: 0;
}

.booking-details-confirmation strong {
    color: #333;
}

/* Mobile two-step flow */
.mobile-stepper {
    display: none;
    align-items: center;
    justify-content: space-between;
}

.mobile-stepper .step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
}

.mobile-stepper .step-circle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 2px solid #d0d4e4;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    background: #fff;
    color: #6c757d;
}

.mobile-stepper .step-circle.active {
    border-color: #4a7ff3;
    background: #4a7ff3;
    color: #fff;
}

.mobile-stepper .step-circle.completed {
    border-color: #28a745;
    background: #28a745;
    color: #fff;
}

.mobile-stepper .step-label {
    font-size: 0.75rem;
    margin-top: 4px;
    color: #6c757d;
    white-space: nowrap;
}

.mobile-step {
    /* will be overridden per breakpoint */
}

@media (max-width: 767.98px) {
    .mobile-stepper {
        display: flex;
        margin-bottom: 16px;
    }

    .mobile-step-1 {
        display: block;
    }

    .mobile-step-2 {
        display: none;
    }

    .mobile-step-1.mobile-step-hidden {
        display: none;
    }

    .mobile-step-2.mobile-step-active {
        display: block;
    }
}

@media (min-width: 768px) {
    .mobile-step-1,
    .mobile-step-2 {
        display: block !important;
    }
}
</style>
<div class="container py-5">

<div class="mobile-stepper d-md-none">
    <div class="step-item" id="stepIndicator1">
        <div class="step-circle active">1</div>
        <div class="step-label">Address & slot</div>
    </div>
    <div class="flex-grow-1 mx-2" style="border-top:1px dashed #d0d4e4;"></div>
    <div class="step-item" id="stepIndicator2">
        <div class="step-circle">2</div>
        <div class="step-label">Review & pay</div>
    </div>
</div>

<div class="row">

    <!-- LEFT SECTION -->
    <div class="col-lg-6 mobile-step mobile-step-1">

        <!-- Contact -->
        <div class="cart-card d-flex justify-content-between align-items-center">
            <div>
                <div class="section-title">Send details to</div>
                <div>9461937396</div>
            </div>
        </div>

        <!-- Address -->
        <div class="cart-card">
            <div class="section-title">Address</div>
            <button class="primary-btn" data-bs-toggle="modal" data-bs-target="#selectSlotModal">
                Select date & time
            </button>
        </div>

        <!-- Payment -->
        <div class="cart-card">
            <div class="section-title">Cash on Service</div>
            <p class="text-muted small">(Pay after service via UPI, cash, card, or other payment methods.)</p>
            <button class="confirm-btn" id="confirmBookBtn" disabled onclick="confirmAndBook()">Confirm & Book Now</button>
        </div>

        <!-- Service Process -->
        <div class="cart-card">
            <div class="section-title">Service Process</div>
            <p class="text-muted">
                Our service begins with an expert inspection to understand your needs, followed by a transparent cost estimation. 
                Once approved, we schedule the service at your convenience.
            </p>
            <a href="#" class="text-primary">Read full process</a>
        </div>

    </div>


    <!-- RIGHT SECTION -->
    <div class="col-lg-6 mobile-step mobile-step-2">

        <!-- Product -->
        <div class="cart-card d-flex justify-content-between align-items-center">
            <div>
                <div class="fw-semibold">10 x 20 Ft Nylon Bird Net</div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="qty-box">
                    <button onclick="changeQty(-1)">-</button>
                    <span id="qty">1</span>
                    <button onclick="changeQty(1)">+</button>
                </div>
                <div class="fw-semibold">₹3,999</div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="cart-card">
            <div class="section-title">Payment summary</div>

            <div class="summary-row">
                <span>Item Total</span>
                <span id="itemTotalAmount">₹3,999</span>
            </div>

            <div class="summary-row">
                <span>Visiting Charges</span>
                <span>₹0</span>
            </div>

            <div class="summary-row" id="promoRow" style="display:none;">
                <span>Promo discount</span>
                <span id="promoDiscountText" class="text-success">-₹0</span>
            </div>

            <hr>

            <div class="summary-row summary-total">
                <span>Total Estimated</span>
                <span id="totalEstimatedAmount">₹3,999</span>
            </div>

            <div class="summary-row mt-3">
                <span>Booking Amount (Now)</span>
                <span>₹0</span>
            </div>

            <div class="summary-row">
                <span>Pay After Service</span>
                <span>As per final bill</span>
            </div>
        </div>

        <!-- Selected Booking Details -->
        <div class="cart-card" id="bookingDetailsCard" style="display:none;">
            <div class="section-title">📍 Booking Details</div>
            <div class="summary-row align-items-center">
                <div>
                    <span><strong>Selected Address:</strong></span><br>
                    <span id="displaySelectedAddress" class="small text-muted">-</span>
                </div>
                <button class="btn btn-sm btn-outline-primary rounded-2" onclick="editAddress()" style="white-space: nowrap;">Edit</button>
            </div>
            <div class="summary-row align-items-center">
                <div>
                    <span><strong>Selected Date & Time:</strong></span><br>
                    <span id="displaySelectedDateTime" class="small text-muted">-</span>
                </div>
                <button class="btn btn-sm btn-outline-primary rounded-2" onclick="editSlot()" style="white-space: nowrap;">Edit</button>
            </div>
        </div>

        <!-- Notes -->
        <div class="cart-card note-box">
            <div class="section-title">✨ Notes:</div>
            <ul>
                <li>The provided cost is an approximate estimate.</li>
                <li>Final estimation will be provided after inspection.</li>
                <li>No advance payment required at the time of booking.</li>
            </ul>
        </div>

        <!-- Promo code trigger -->
        <div class="cart-card d-flex justify-content-between align-items-center">
            <div>
                <div class="section-title mb-1">Have a promo code?</div>
                <small class="text-muted">Apply a coupon to save on your booking.</small>
            </div>
            <button class="btn btn-outline-primary ms-3" data-bs-toggle="modal" data-bs-target="#promoCodeModal">
                Add promo code
            </button>
        </div>

        <!-- Mobile: continue to payment (second tab) -->
        <button class="primary-btn d-md-none mt-2" id="mobileContinueBtn" disabled>
            Continue to payment
        </button>

    </div>

</div>
</div>



{{-- //////////////////Address Modal//////////////////// --}}
<!-- SAVED ADDRESS MODAL -->
<div class="modal fade" id="savedAddressModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content address-modal">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-semibold">Saved address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="add-new mb-3" data-bs-toggle="modal" data-bs-target="#addAddressModal" data-bs-dismiss="modal">
          + Add another address
        </div>

        <div class="address-option">
          <input type="radio" name="address" id="officeAddress" onchange="selectAddress('officeAddress', 'OFFICE', 'Sukhdeopura Nohara, Jaipur, 302022'); enableProceed()">
          <label for="officeAddress">
            <strong>OFFICE</strong>
            <div class="small text-muted">
              Sukhdeopura Nohara, Jaipur, 302022
            </div>
          </label>
        </div>

      </div>

      <div class="modal-footer border-0">
        <button class="proceed-btn" id="proceedBtn" disabled data-bs-dismiss="modal">Done</button>
      </div>

    </div>
  </div>
</div>



<!-- SELECT SLOT MODAL -->
<div class="modal fade" id="selectSlotModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content slot-modal">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-semibold">When should the professional arrive?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        
        <!-- Service Duration Info -->
        <div class="alert alert-info small rounded-2 mb-4">
          Service will take approx. 2 hrs & 10 mins
        </div>

        <!-- Date Selection -->
        <div class="mb-4">
          <label class="fw-semibold mb-3 d-block">Select a date</label>
          <div class="date-selector" id="dateSelector">
            <!-- Dates will be generated by JS -->
          </div>
        </div>

        <!-- Time Selection -->
        <div class="mb-4">
          <label class="fw-semibold mb-3 d-block">Select start time of service</label>
          <div class="time-grid" id="timeGrid">
            <!-- Times will be generated by JS -->
          </div>
        </div>

        <!-- Selected Info Display -->
        <div class="selected-info d-none" id="selectedInfo">
          <div class="selected-info-row">
            <strong>Selected Address:</strong>
            <span id="selectedAddressText">-</span>
          </div>
          <div class="selected-info-row">
            <strong>Selected Date:</strong>
            <span id="selectedDateText">-</span>
          </div>
          <div class="selected-info-row">
            <strong>Selected Time:</strong>
            <span id="selectedTimeText">-</span>
          </div>
        </div>

      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-2" data-bs-dismiss="modal">Back</button>
        <button type="button" class="btn btn-primary rounded-2" id="proceedCheckoutBtn" onclick="openAddressAfterSlot()" disabled>
          Select address
        </button>
      </div>

    </div>
  </div>
</div>

<!-- ADD ADDRESS MODAL -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content add-address-modal">

      <div class="modal-header border-0">
        <button class="btn btn-outline-primary btn-sm">Change</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-0">
        <div class="row g-0">

          <!-- LEFT MAP -->
          <div class="col-lg-6 map-section">
            <div class="map-placeholder">
              📍 MAP VIEW
            </div>
          </div>

          <!-- RIGHT FORM -->
          <div class="col-lg-6 p-4">

            <h6 class="fw-semibold">Sukhdeopura Nohara</h6>
            <div class="small text-muted mb-3">
              Sukhdeopura Nohara, Jaipur, 302022
            </div>

            <hr>

            <input type="text" class="form-control mb-3" placeholder="House/Flat Number *">
            <input type="text" class="form-control mb-4" placeholder="Landmark (Optional)">

            <div class="mb-2 fw-semibold">Save as</div>

            <div class="d-flex gap-2 mb-4">
              <button class="tag-btn active" onclick="selectTag(this)">Home</button>
              <button class="tag-btn" onclick="selectTag(this)">Office</button>
              <button class="tag-btn" onclick="selectTag(this)">Other</button>
            </div>

            <button class="save-btn w-100">Save and proceed</button>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>


<!-- BOOKING CONFIRMATION MODAL -->
<div class="modal fade" id="bookingConfirmationModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content booking-confirmation-modal">

      <div class="modal-body">
        
        <div class="confirmation-animation">
          <div class="checkmark"></div>
        </div>

        <div class="confirmation-text">
          <h4 class="fw-semibold mb-2">Booking Confirmed!</h4>
          <p class="text-muted mb-0">Your service booking has been confirmed. Our professional will arrive soon.</p>
        </div>

        <div class="booking-details-confirmation">
          <div class="detail-row">
            <strong>Address:</strong>
            <span id="confirmationAddress">-</span>
          </div>
          <div class="detail-row">
            <strong>Date & Time:</strong>
            <span id="confirmationDateTime">-</span>
          </div>
          <div class="detail-row">
            <strong>Service Duration:</strong>
            <span>2 hrs 10 mins</span>
          </div>
          <div class="detail-row">
            <strong>Total Amount:</strong>
            <span>₹3,999</span>
          </div>
        </div>

      </div>

      <div class="modal-footer border-0 d-flex gap-2">
        <button type="button" class="btn btn-secondary rounded-2 flex-grow-1" data-bs-dismiss="modal">Back</button>
        <a href="{{ route('my_requests') }}"><button type="button" class="btn btn-primary rounded-2 flex-grow-1">View Booking</button></a>
      </div>

    </div>
  </div>
</div>

<!-- PROMO CODE MODAL -->
<div class="modal fade" id="promoCodeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-semibold">Apply promo code</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="promoCodeInput" class="form-label small fw-semibold">Enter promo code</label>
          <input type="text" id="promoCodeInput" class="form-control" placeholder="Enter code (e.g. WELCOME50)">
        </div>
        <div class="small text-muted">
          Example: <span class="fw-semibold">WELCOME50</span> – flat ₹200 off on this booking.
        </div>
      </div>

      <div class="modal-footer border-0 d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary rounded-2 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary rounded-2 flex-grow-1" onclick="applyPromoCode()">Apply</button>
      </div>

    </div>
  </div>
</div>


<script>
const BASE_PRICE_PER_UNIT = 3999;
let promoDiscount = 0;

// Store selected address
let selectedAddressData = {
    tag: '',
    fullAddress: ''
};

function selectAddress(id, tag, address) {
    selectedAddressData = {
        tag: tag,
        fullAddress: address
    };
}

function changeQty(value){
    let qty = document.getElementById("qty");
    let current = parseInt(qty.innerText);
    current += value;
    if(current < 1) current = 1;
    qty.innerText = current;
    updateTotals();
}

function enableProceed(){
    let btn = document.getElementById("proceedBtn");
    btn.disabled = false;
    btn.classList.add("enabled");
    // Re-check completion after address selection
    checkIfComplete();
}

function updateTotals() {
    const qtyEl = document.getElementById('qty');
    const itemTotalEl = document.getElementById('itemTotalAmount');
    const totalEstimatedEl = document.getElementById('totalEstimatedAmount');
    const promoRow = document.getElementById('promoRow');
    const promoDiscountText = document.getElementById('promoDiscountText');

    if (!qtyEl || !itemTotalEl || !totalEstimatedEl) return;

    const qtyVal = parseInt(qtyEl.innerText) || 1;
    const gross = BASE_PRICE_PER_UNIT * qtyVal;
    const discount = Math.min(promoDiscount, gross);
    const net = gross - discount;

    itemTotalEl.textContent = `₹${gross.toLocaleString('en-IN')}`;
    totalEstimatedEl.textContent = `₹${net.toLocaleString('en-IN')}`;

    if (discount > 0 && promoRow && promoDiscountText) {
        promoRow.style.display = 'flex';
        promoDiscountText.textContent = `-₹${discount.toLocaleString('en-IN')}`;
    } else if (promoRow) {
        promoRow.style.display = 'none';
    }
}

function applyPromoCode() {
    const input = document.getElementById('promoCodeInput');
    if (!input) return;

    const code = input.value.trim().toUpperCase();

    if (!code) {
        alert('Please enter a promo code.');
        return;
    }

    // Simple demo logic: WELCOME50 gives flat ₹200 off
    if (code === 'WELCOME50') {
        promoDiscount = 200;
        updateTotals();
        const modalInstance = bootstrap.Modal.getInstance(document.getElementById('promoCodeModal'));
        if (modalInstance) modalInstance.hide();
        alert('Promo code applied successfully! ₹200 discount added.');
    } else {
        alert('Invalid promo code. Please try again.');
    }
}

function selectTag(el){
    document.querySelectorAll(".tag-btn").forEach(btn=>{
        btn.classList.remove("active");
    });
    el.classList.add("active");
}

// Generate dates for next 7 days
function generateDates() {
    const dateSelector = document.getElementById('dateSelector');
    dateSelector.innerHTML = '';
    
    for (let i = 0; i < 7; i++) {
        const date = new Date();
        date.setDate(date.getDate() + i);
        
        const dayName = date.toLocaleDateString('en-US', { weekday: 'short' });
        const dayNum = date.getDate();
        const dateStr = date.toISOString().split('T')[0];
        
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'date-btn';
        btn.innerHTML = `<div>${dayName}</div><div class="fw-semibold">${dayNum}</div>`;
        btn.setAttribute('data-date', dateStr);
        btn.addEventListener('click', function() {
            selectDate(this);
        });
        
        dateSelector.appendChild(btn);
    }
}

// Generate time slots
function generateTimeSlots() {
    const timeGrid = document.getElementById('timeGrid');
    timeGrid.innerHTML = '';
    
    const times = [
        '07:00 AM', '07:30 AM', '12:00 PM',
        '12:30 PM', '01:00 PM', '01:30 PM',
        '02:00 PM', '02:30 PM', '03:00 PM',
        '03:30 PM', '04:00 PM', '04:30 PM',
        '05:00 PM', '05:30 PM', '06:00 PM',
        '06:30 PM', '07:00 PM', '07:30 PM',
        '08:00 PM', '08:30 PM'
    ];
    
    times.forEach(time => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'time-btn';
        btn.textContent = time;
        btn.setAttribute('data-time', time);
        btn.addEventListener('click', function() {
            selectTime(this);
        });
        timeGrid.appendChild(btn);
    });
}

// Handle date selection
function selectDate(element) {
    document.querySelectorAll('.date-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    element.classList.add('active');
    
    const selectedDate = element.getAttribute('data-date');
    const dayName = element.querySelector('div').textContent;
    const dayNum = element.querySelectorAll('div')[1].textContent;
    
    document.getElementById('selectedDateText').textContent = `${dayName} ${dayNum}`;
    checkIfComplete();
}

// Handle time selection
function selectTime(element) {
    document.querySelectorAll('.time-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    element.classList.add('active');
    
    const selectedTime = element.getAttribute('data-time');
    document.getElementById('selectedTimeText').textContent = selectedTime;
    checkIfComplete();
}

// Check if all selections are complete
function checkIfComplete() {
    const selectedDate = document.querySelector('.date-btn.active');
    const selectedTime = document.querySelector('.time-btn.active');
    const proceedBtn = document.getElementById('proceedCheckoutBtn');
    const confirmBtn = document.getElementById('confirmBookBtn');
    const mobileContinueBtn = document.getElementById('mobileContinueBtn');

    // Enable "Select address" button as soon as slot is chosen
    if (proceedBtn) {
        if (selectedDate && selectedTime) {
            proceedBtn.disabled = false;
            proceedBtn.classList.add('enabled');
        } else {
            proceedBtn.disabled = true;
            proceedBtn.classList.remove('enabled');
        }
    }

    // Enable confirm/continue only when slot + address both selected
    if (selectedDate && selectedTime && selectedAddressData.tag) {
        if (confirmBtn) {
            confirmBtn.disabled = false;
            confirmBtn.classList.add('enabled');
        }

        // Show selected info in modal
        document.getElementById('selectedInfo').classList.remove('d-none');
        document.getElementById('selectedAddressText').textContent = selectedAddressData.tag + ' - ' + selectedAddressData.fullAddress;
        
        // Show booking details above notes
        const bookingDetailsCard = document.getElementById('bookingDetailsCard');
        bookingDetailsCard.style.display = 'block';
        
        const dayNum = selectedDate.querySelectorAll('div')[1].textContent;
        const dayName = selectedDate.querySelector('div').textContent;
        const selectedTime_val = selectedTime.getAttribute('data-time');
        
        document.getElementById('displaySelectedAddress').textContent = selectedAddressData.tag + ' - ' + selectedAddressData.fullAddress;
        document.getElementById('displaySelectedDateTime').textContent = dayName + ' ' + dayNum + ' at ' + selectedTime_val;

        if (mobileContinueBtn) {
            mobileContinueBtn.disabled = false;
        }

        // On small screens, automatically move to step 2 once everything is ready
        if (window.innerWidth < 768) {
            goToMobileStep2();
        }
    } else {
        if (confirmBtn) {
            confirmBtn.disabled = true;
            confirmBtn.classList.remove('enabled');
        }

        if (mobileContinueBtn) {
            mobileContinueBtn.disabled = true;
        }
    }
}

// After selecting slot, open address selection modal
function openAddressAfterSlot() {
    // Ensure a slot is actually selected
    const selectedDate = document.querySelector('.date-btn.active');
    const selectedTime = document.querySelector('.time-btn.active');
    if (!selectedDate || !selectedTime) {
        alert('Please select a date and time first.');
        return;
    }

    const slotModalEl = document.getElementById('selectSlotModal');
    if (slotModalEl) {
        const slotModal = bootstrap.Modal.getInstance(slotModalEl);
        if (slotModal) {
            slotModal.hide();
        }
    }

    const addressModalEl = document.getElementById('savedAddressModal');
    if (addressModalEl) {
        const addressModal = new bootstrap.Modal(addressModalEl);
        addressModal.show();
    }
}

// Edit address
function editAddress() {
    // Close slot modal and open address modal
    const slotModal = bootstrap.Modal.getInstance(document.getElementById('selectSlotModal'));
    if (slotModal) slotModal.hide();
    
    const addressModal = new bootstrap.Modal(document.getElementById('savedAddressModal'));
    addressModal.show();
}

// Edit slot
function editSlot() {
    const slotModal = new bootstrap.Modal(document.getElementById('selectSlotModal'));
    slotModal.show();
}

// Initialize when modal is shown
document.getElementById('selectSlotModal').addEventListener('shown.bs.modal', function() {
    generateDates();
    generateTimeSlots();
    
    // Show selected address info
    if (selectedAddressData.tag) {
        document.getElementById('selectedInfo').classList.remove('d-none');
        document.getElementById('selectedAddressText').textContent = selectedAddressData.tag + ' - ' + selectedAddressData.fullAddress;
    }
});

// Confirm and Book function with animation
function confirmAndBook() {
    const selectedDate = document.querySelector('.date-btn.active');
    const selectedTime = document.querySelector('.time-btn.active');
    
    // Only proceed if all selections are made
    if (!selectedDate || !selectedTime || !selectedAddressData.tag) {
        alert('Please select address and time slot first');
        return;
    }
    
    // Get the booking details
    const dayNum = selectedDate.querySelectorAll('div')[1].textContent;
    const dayName = selectedDate.querySelector('div').textContent;
    const selectedTime_val = selectedTime.getAttribute('data-time');
    
    // Populate confirmation modal
    document.getElementById('confirmationAddress').textContent = selectedAddressData.tag + ' - ' + selectedAddressData.fullAddress;
    document.getElementById('confirmationDateTime').textContent = dayName + ' ' + dayNum + ' at ' + selectedTime_val;
    
    // Show confirmation modal with animation
    const confirmationModal = new bootstrap.Modal(document.getElementById('bookingConfirmationModal'));
    confirmationModal.show();
}

// Mobile two-step flow helpers
function goToMobileStep2() {
    const step1 = document.querySelector('.mobile-step-1');
    const step2 = document.querySelector('.mobile-step-2');
    const stepCircle1 = document.querySelector('#stepIndicator1 .step-circle');
    const stepCircle2 = document.querySelector('#stepIndicator2 .step-circle');

    if (step1 && step2) {
        step1.classList.add('mobile-step-hidden');
        step2.classList.add('mobile-step-active');
    }

    if (stepCircle1 && stepCircle2) {
        stepCircle1.classList.remove('active');
        stepCircle1.classList.add('completed');
        stepCircle2.classList.add('active');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateTotals();

    const mobileContinueBtn = document.getElementById('mobileContinueBtn');
    if (mobileContinueBtn) {
        mobileContinueBtn.addEventListener('click', function () {
            if (!mobileContinueBtn.disabled) {
                // On mobile second tab, treat this as final action
                confirmAndBook();
            }
        });
    }
});
</script>
@endsection