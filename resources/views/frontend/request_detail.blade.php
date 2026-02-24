@extends('frontend.common.app')
@section('title','My Requests')
@section('content')
<style>
    .order-details-wrapper{
    padding:30px 0;
}

.card-box{
    background:#fff;
    border-radius:14px;
    padding:20px;
    box-shadow:0 5px 18px rgba(0,0,0,0.05);
    margin-bottom:20px;
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
@endsection