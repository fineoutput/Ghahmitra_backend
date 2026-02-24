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

.map-section{
    background:#f2f4f7;
    min-height:450px;
    display:flex;
    align-items:center;
    justify-content:center;
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
          <input type="radio" name="address" id="officeAddress" onchange="enableProceed()">
          <label for="officeAddress">
            <strong>OFFICE</strong>
            <div class="small text-muted">
              Sukhdeopura Nohara, Jaipur, 302022
            </div>
          </label>
        </div>

      </div>

      <div class="modal-footer border-0">
        <button class="proceed-btn" id="proceedBtn" disabled>Proceed</button>
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
function changeQty(value){
    let qty = document.getElementById("qty");
    let current = parseInt(qty.innerText);
    current += value;
    if(current < 1) current = 1;
    qty.innerText = current;
}
</script>

<script>
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
</script>
@endsection