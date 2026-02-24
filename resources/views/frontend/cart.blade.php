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
</style>
<div class="container py-5">
<div class="row">

    <!-- LEFT SECTION -->
    <div class="col-lg-6">

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
            <button class="primary-btn" data-bs-toggle="modal" data-bs-target="#savedAddressModal">
    Select an address
</button>
        </div>

        <!-- Payment -->
        <div class="cart-card">
            <div class="section-title">Cash on Service</div>
            <p class="text-muted small">(Pay after service via UPI, cash, card, or other payment methods.)</p>
            <button class="confirm-btn">Confirm & Book Now</button>
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
    <div class="col-lg-6">

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
                <span>₹3,999</span>
            </div>

            <div class="summary-row">
                <span>Visiting Charges</span>
                <span>₹0</span>
            </div>

            <hr>

            <div class="summary-row summary-total">
                <span>Total Estimated</span>
                <span>₹3,999</span>
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
        <button class="proceed-btn" id="proceedBtn" disabled data-bs-toggle="modal" data-bs-target="#selectSlotModal" data-bs-dismiss="modal">Proceed</button>
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
        <button type="button" class="btn btn-primary rounded-2" id="proceedCheckoutBtn" onclick="proceedToCheckout()" disabled>
          Proceed to checkout
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


<script>
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
}

function enableProceed(){
    let btn = document.getElementById("proceedBtn");
    btn.disabled = false;
    btn.classList.add("enabled");
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
    
    if (selectedDate && selectedTime && selectedAddressData.tag) {
        proceedBtn.disabled = false;
        proceedBtn.classList.add('enabled');
        
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
    } else {
        proceedBtn.disabled = true;
        proceedBtn.classList.remove('enabled');
    }
}

// Proceed to checkout
function proceedToCheckout() {
    const selectedDate = document.querySelector('.date-btn.active').getAttribute('data-date');
    const selectedTime = document.querySelector('.time-btn.active').getAttribute('data-time');
    
    alert('Proceeding to Checkout\nAddress: ' + selectedAddressData.fullAddress + '\nDate: ' + selectedDate + '\nTime: ' + selectedTime);
    // You can submit form or redirect to payment page here
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
</script>
@endsection