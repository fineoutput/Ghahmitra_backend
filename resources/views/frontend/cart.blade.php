@extends('frontend.common.app')
@section('title', 'Services')
@section('content')
    <style>
        .cart-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .primary-btn {
            background: #4a7ff3;
            color: #fff;
            border-radius: 8px;
            padding: 12px;
            font-weight: 500;
            border: none;
            width: 100%;
        }

        .primary-btn:hover {
            background: #3b6fe0;
        }

        .confirm-btn {
            background: #e3e6ea;
            color: #999;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            border: none;
            width: 100%;
        }

        .qty-box {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 110px;
        }

        .qty-box button {
            border: none;
            background: #f1f1f1;
            padding: 6px 12px;
        }

        .qty-box span {
            flex: 1;
            text-align: center;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            gap: 10px;
        }

        .summary-row.align-items-center {
            align-items: center;
        }

        .summary-total {
            font-weight: 600;
            font-size: 15px;
        }

        .note-box ul {
            padding-left: 18px;
            margin-bottom: 0;
        }

        .note-box li {
            font-size: 14px;
            margin-bottom: 8px;
        }

        /* Address Modal Styling */
        .address-modal {
            border-radius: 14px;
            padding: 10px;
        }

        .add-new {
            color: #3b6fe0;
            font-weight: 500;
            cursor: pointer;
        }

        .address-option {
            display: flex;
            gap: 10px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 10px;
            cursor: pointer;
        }

        .proceed-btn {
            width: 100%;
            background: #e3e6ea;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            color: #999;
        }

        .proceed-btn.enabled {
            background: #4a7ff3;
            color: #fff;
        }

        /* Add Address Modal */
        .add-address-modal {
            border-radius: 16px;
            overflow: hidden;
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



        .map-placeholder {
            font-size: 20px;
            color: #999;
        }

        .tag-btn {
            border: 1px solid #ddd;
            background: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .tag-btn.active {
            border: 2px solid #4a7ff3;
            color: #4a7ff3;
            font-weight: 500;
        }

        .save-btn {
            background: #e3e6ea;
            color: #999;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .confirm-btn.enabled {
            background: #4a7ff3;
            color: #fff;
            cursor: pointer;
        }

        .confirm-btn:disabled {
            background: #e3e6ea;
            color: #999;
            cursor: not-allowed;
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

    <style>
        .slot-box {
            cursor: pointer;
            border-radius: 8px;
            padding: 8px 14px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
            background: #fff;
            transition: 0.2s;
        }

        .slot-box:hover {
            border-color: #0d6efd;
        }

        .slot-box.active {
            background: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
        }

        .tag-btn {
            border: 2px solid #ccc;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When radio is checked */
        .tag-btn input:checked+* {
            border-color: #0d6efd;
        }

        /* OR better (recommended) */
        .tag-btn input:checked {
            display: none;
        }

        .tag-btn input:checked+span {
            border-color: #0d6efd;
        }

        .tag-btn input:checked {
            display: none;
        }

        .tag-btn:has(input:checked) {
            border: 2px solid #0d6efd;
            background-color: #e7f1ff;
        }
    </style>

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
                        <div>{{ Auth::guard('customer')->user()->mobile_no ?? 'No mobile number provided' }}</div>
                    </div>
                </div>


                <div class="modal-footer border-0 justify-content-between" style="padding: 20px">
                    {{-- <button type="button" class="btn btn-secondary rounded-2" data-bs-dismiss="modal">Back</button> --}}
                    @php
                        $allSelected = collect($cart_items)->every(function ($item) {
                            return !empty($item->availability_id) && !empty($item->slot_id);
                        });
                    @endphp
                    <p><b>Add Your Address</b></p>
                    <button type="button" class="btn btn-primary rounded-2"
                        onclick="{{ $allSelected ? 'openAddressAfterSlot()' : 'alert(\'Select all cart items slot first\')' }}">
                        Select address
                    </button>

                </div>



                <!-- Payment -->


                <!-- Service Process -->
                {{-- <div class="cart-card">
                    <div class="section-title">Service Process</div>
                    <p class="text-muted">
                        Our service begins with an expert inspection to understand your needs, followed by a transparent
                        cost estimation.
                        Once approved, we schedule the service at your convenience.
                    </p>
                    <a href="#" class="text-primary">Read full process</a>
                </div> --}}

            </div>


            <!-- RIGHT SECTION -->
            <div class="col-lg-6 mobile-step mobile-step-2">

                <!-- Product -->
                @if ($cart_items)

                    @foreach ($cart_items as $item)
                        @if ($item->service)
                            <div class="cart-card d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold">{{ $item->service->name ?? 'Service not found' }}</div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="qty-box" data-service-id="{{ $item->service->id }}"
                                        data-category-id="{{ $item->service->services_se_id }}">
                                        <button onclick="changeQty(-1,this)">-</button>
                                        <span class="qty">{{ $item->quantity }}</span>
                                        <button onclick="changeQty(1,this)">+</button>
                                    </div>

                                    {{-- <div id="cartMessage"></div> --}}
                                    <div class="fw-semibold">₹{{ $item->service->price * $item->quantity }}</div>
                                    <form action="{{ route('removecart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_id" value="{{ $item->id }}">

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            X
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="cart-card  d-flex justify-content-between align-items-center">
                                @if ($item->availability && $item->slot)
                                    <div class="mt-2 small text-success">
                                        Selected:
                                        {{ \Carbon\Carbon::parse($item->availability->day)->format('D, d M') }}
                                        |
                                        {{ $item->slot->start_time }} - {{ $item->slot->end_time }}
                                    </div>
                                @endif
                                <a class="" data-bs-toggle="modal"
                                    data-bs-target="#selectSlotModal-{{ $item->id }}">
                                    <i class="fas fa-edit">
                                        {{ $item->slot_id ? ':' : ':' }}</i>
                                </a>
                            </div>
                            <div class="cart-card">
                                <div class="section-title">Address</div>

                                @if (!$item->slot_id)
                                    <button class="primary-btn" data-bs-toggle="modal"
                                        data-bs-target="#selectSlotModal-{{ $item->id }}">
                                        Select date & time
                                    </button>
                                @endif

                            </div>
                            <hr>

                            <div class="modal fade" id="selectSlotModal-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('selectslot') }}" method="POST">
                                        @csrf

                                        <div class="modal-content slot-modal">

                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fw-semibold">
                                                    When should the professional arrive?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                {{-- <div class="alert alert-info small rounded-2 mb-4">
                                            Service will take approx. 2 hrs & 10 mins
                                        </div> --}}

                                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                                <input type="hidden" name="availability_id"
                                                    id="availabilityInput-{{ $item->id }}">
                                                <input type="hidden" name="slot_id" id="slotInput-{{ $item->id }}">


                                                <div class="mb-4">

                                                    <label class="fw-semibold mb-3 d-block">
                                                        Select a date
                                                    </label>

                                                    <div class="row g-2">

                                                        @foreach ($item->service->availability as $availability)
                                                            @php
                                                                $availabilityDate = \Carbon\Carbon::parse(
                                                                    $availability->day,
                                                                );
                                                            @endphp

                                                            @if ($availabilityDate->isToday() || $availabilityDate->isFuture())
                                                                <div class="col-auto">

                                                                    <div class="date-box card 
                text-center shadow-sm border-0 
                {{ $item->availability_id == $availability->id ? 'active' : '' }}"
                                                                        data-id="{{ $availability->id }}">

                                                                        <div class="card-body p-2">

                                                                            <div class="fw-semibold text-primary">
                                                                                {{ $availabilityDate->format('D') }}
                                                                            </div>

                                                                            <div class="small text-muted">
                                                                                {{ $availabilityDate->format('d M') }}
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>

                                                </div>

                                                <div class="mb-4">

                                                    <label class="fw-semibold mb-3 d-block">
                                                        Select start time of service
                                                    </label>

                                                    <div id="slotContainer-{{ $item->id }}" class="row g-2"></div>

                                                </div>

                                            </div>

                                            <div class="modal-footer border-0">

                                                <button type="button" class="btn btn-secondary rounded-2"
                                                    data-bs-dismiss="modal">
                                                    Back
                                                </button>

                                                <button type="submit" class="btn btn-primary rounded-2">
                                                    Update
                                                </button>

                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="cart-card" id="bookingDetailsCard" style="">
                <div class="section-title">📍 Booking Details</div>
                <div class="summary-row align-items-center">
                    <div>
                        <span><strong>Selected Address:</strong></span><br>
                        <span id="displaySelectedAddress" class="small text-muted">-</span>
                    </div>
                    <button class="btn btn-sm btn-outline-primary rounded-2" onclick="editAddress()"
                        style="white-space: nowrap;">Edit</button>
                </div>
                {{-- <div class="summary-row align-items-center">
                    <div>
                        <span><strong>Selected Date & Time:</strong></span><br>
                        <span id="displaySelectedDateTime" class="small text-muted">-</span>
                    </div>
                    <button class="btn btn-sm btn-outline-primary rounded-2" onclick="editSlot()"
                        style="white-space: nowrap;">Edit</button>
                </div> --}}
            </div>
            <!-- Payment Summary -->
            <div class="cart-card">
                <div class="section-title">Payment summary</div>

                <div class="summary-row">
                    <span>Item Total</span>
                    <span id="itemTotalAmount">₹{{ number_format($cart_total, 2) }}</span>
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
                    <span id="totalEstimatedAmount">₹{{ number_format($cart_total, 2) }}</span>
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


            <!-- Notes -->
            {{-- <div class="cart-card note-box">
                <div class="section-title">✨ Notes:</div>
                <ul>
                    <li>The provided cost is an approximate estimate.</li>
                    <li>Final estimation will be provided after inspection.</li>
                    <li>No advance payment required at the time of booking.</li>
                </ul>
            </div> --}}

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

                            <div class="cart-card">
                    <div class="section-title">Cash on Service</div>
                    <p class="text-muted small">(Pay after service via UPI, cash, card, or other payment methods.)</p>
                    <button class="confirm-btn">
                        <a href="{{ route('request_detail') }}">Confirm & Book
                            Now</a>
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

                    <div class="add-new mb-3" data-bs-toggle="modal" data-bs-target="#addAddressModal"
                        data-bs-dismiss="modal">
                        + Add another address
                    </div>

                    @foreach ($CustomerAddresses as $addresses)
                        <div class="address-option mt-2">

                            <input type="radio" name="address" value="{{ $addresses->id }}"
                                id="address{{ $addresses->id }}" onchange="selectAddress(this.value)">

                            <label for="address{{ $addresses->id }}">
                                <strong>{{ ucfirst($addresses->type) }}</strong>

                                <div class="small text-muted">
                                    {{ $addresses->address_line1 ?? '' }},
                                    {{ $addresses->city->city_name ?? '' }},
                                    {{ $addresses->pincode }}
                                </div>

                            </label>

                        </div>
                    @endforeach


                </div>

                <button type="button" class="proceed-btn" id="proceedBtn" onclick="goToRequestDetail()">
                    Done
                </button>

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
                    {{-- <div class="alert alert-info small rounded-2 mb-4">
                        Service will take approx. 2 hrs & 10 mins
                    </div> --}}

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
                    <button type="button" class="btn btn-primary rounded-2" id="proceedCheckoutBtn"
                        onclick="openAddressAfterSlot()">
                        Select address
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ADD ADDRESS MODAL -->
    {{-- <div class="modal fade" id="addAddressModal" tabindex="-1">
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
</div> --}}


    <div class="modal fade" id="addAddressModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content add-address-modal">

                <form action="{{ route('customer-address.store') }}" method="POST">
                    @csrf

                    <div class="modal-header border-0">
                        <button class="btn btn-outline-primary btn-sm" type="button">Change</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-0">
                        <div class="row g-0">

                            <!-- LEFT MAP -->
                            <div class="col-lg-6 map-section">
                                <div class="map-placeholder">
                                    📍 MAP VIEW
                                </div>

                                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                            </div>

                            <!-- RIGHT FORM -->
                            <div class="col-lg-6 p-4">

                                <h6 class="fw-semibold">Add Delivery Address</h6>
                                <div class="small text-muted mb-3">
                                    Enter your complete delivery details
                                </div>

                                <hr>

                                <!-- NAME -->
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control mb-1 @error('name') is-invalid @enderror"
                                    placeholder="Full Name *">

                                @error('name')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- MOBILE -->
                                <input type="text" name="mobile_no" value="{{ old('mobile_no') }}"
                                    class="form-control mb-1 @error('mobile_no') is-invalid @enderror"
                                    placeholder="Mobile Number *">

                                @error('mobile_no')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- ADDRESS LINE 1 -->
                                <input type="text" name="address_line1" value="{{ old('address_line1') }}"
                                    class="form-control mb-1 @error('address_line1') is-invalid @enderror"
                                    placeholder="House / Flat Number *">

                                @error('address_line1')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- ADDRESS LINE 2 -->
                                <input type="text" name="address_line2" value="{{ old('address_line2') }}"
                                    class="form-control mb-1 @error('address_line2') is-invalid @enderror"
                                    placeholder="Address Line 2">

                                @error('address_line2')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- LANDMARK -->
                                <input type="text" name="landmark" value="{{ old('landmark') }}"
                                    class="form-control mb-1 @error('landmark') is-invalid @enderror"
                                    placeholder="Landmark (Optional)">

                                @error('landmark')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- PINCODE -->
                                {{-- <input type="text" name="pincode" value="{{ old('pincode') }}"
                                    class="form-control mb-1 @error('pincode') is-invalid @enderror"
                                    placeholder="Pincode">

                                @error('pincode')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror --}}


                                <!-- STATE -->
                                <select name="city_id" id="city_id"
                                    class="form-select mb-1 @error('city_id') is-invalid @enderror">

                                    <option value="">Select City</option>

                                    @foreach ($ManualCity as $ManualCity)
                                        <option value="{{ $ManualCity->id }}"
                                            {{ old('city_id') == $ManualCity->id ? 'selected' : '' }}>
                                            {{ $ManualCity->city_name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('city_id')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- CITY -->
                                <select name="pincode" id="pincode"
                                    class="form-select mb-1 @error('pincode') is-invalid @enderror">

                                    <option value="">Select pincode</option>

                                </select>

                                @error('pincode')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror


                                <!-- TYPE -->
                                <div class="mb-2 fw-semibold mt-3">Save as</div>

                                <div class="d-flex gap-2 mb-4">

                                    <label class="tag-btn" onclick="selectTag(this)">
                                        <input type="radio" name="type" value="home" hidden
                                            {{ old('type', 'home') == 'home' ? 'checked' : '' }}>
                                        Home
                                    </label>

                                    <label class="tag-btn" onclick="selectTag(this)">
                                        <input type="radio" name="type" value="office" hidden
                                            {{ old('type') == 'office' ? 'checked' : '' }}>
                                        Office
                                    </label>

                                    <label class="tag-btn" onclick="selectTag(this)">
                                        <input type="radio" name="type" value="other" hidden
                                            {{ old('type') == 'other' ? 'checked' : '' }}>
                                        Other
                                    </label>

                                </div>

                                <!-- SUBMIT -->
                                <button type="submit" class="btn btn-success save-btn w-100">
                                    Save and proceed
                                </button>

                            </div>
                        </div>
                    </div>

                </form>

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
                        <p class="text-muted mb-0">Your service booking has been confirmed. Our professional will arrive
                            soon.</p>
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
                    <button type="button" class="btn btn-secondary rounded-2 flex-grow-1"
                        data-bs-dismiss="modal">Back</button>
                    <a href="{{ route('customer.my_requests') }}"><button type="button"
                            class="btn btn-primary rounded-2 flex-grow-1">View Booking</button></a>
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
                        <input type="text" id="promoCodeInput" class="form-control"
                            placeholder="Enter code (e.g. WELCOME50)">
                    </div>
                    <div class="small text-muted">
                        Example: <span class="fw-semibold">WELCOME50</span> – flat ₹200 off on this booking.
                    </div>
                </div>

                <div class="modal-footer border-0 d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary rounded-2 flex-grow-1"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-2 flex-grow-1"
                        onclick="applyPromoCode()">Apply</button>
                </div>

            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let addressId = localStorage.getItem("selected_address_id");

  if (addressId) {

        // Use Laravel route name
        let url = "{{ route('get_address', ['id' => ':id']) }}".replace(':id', addressId);

        fetch(url)
            .then(res => res.json())
            .then(response => {
                if (response.status) {
                    let a = response.data;

                    let fullAddress = `
                        ${a.name} (${a.mobile_no})<br>
                        ${a.address_line1}, ${a.address_line2 ?? ''}<br>
                        ${a.landmark ?? ''}<br>
                        Pincode: ${a.pincode}
                    `;

                    document.getElementById("displaySelectedAddress").innerHTML = fullAddress;
                }
            });
    }
});
    </script>


    <style>
        .slot-box {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            position: relative;
            background: #fff;
        }

        .slot-box.active {
            background: #0d6efd;
            color: #fff;
        }

        .slot-box.unavailable {
            background: #f5f5f5;
            color: #999;
            cursor: not-allowed;
        }
    </style>


    {{-- <script>

    function selectTag(el) {
        document.querySelectorAll('.tag-btn').forEach(btn => btn.classList.remove('active'));
        el.classList.add('active');

        // select radio inside clicked label
        el.querySelector('input').checked = true;
    }

        let selectedSlot = "{{ isset($item) ? $item->slot_id : '' }}";

        document.querySelectorAll('[id^="selectSlotModal-"]').forEach(modal => {
    let itemId = modal.id.split('-')[1];

    let selectedSlot = modal.dataset.selectedSlot || '';

    // Date boxes in this modal
    modal.querySelectorAll('.date-box').forEach(box => {
        box.addEventListener('click', function(){

            modal.querySelectorAll('.date-box').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            let availability_id = this.dataset.id;

            document.getElementById('availabilityInput-' + itemId).value = availability_id;

            let slotContainer = document.getElementById('slotContainer-' + itemId);

            slotContainer.innerHTML = "Loading...";

            fetch("{{ url('get-slots') }}/"+availability_id)
            .then(res=>res.json())
            .then(data=>{

                slotContainer.innerHTML = '';

   data.data.forEach(slot => {

    let col = document.createElement('div');
    col.classList.add('col-auto');

    let slotBox = document.createElement('div');
    slotBox.classList.add('slot-box');
    slotBox.dataset.id = slot.id;
    slotBox.innerText = slot.start_time + " - " + slot.end_time;

    // ❌ UNAVAILABLE SLOT
    if(!slot.is_available){

        slotBox.classList.add('unavailable');

        // / show karne ke liye
        slotBox.innerHTML = `
            <div style="position: relative;">
                ${slot.start_time} - ${slot.end_time}
                <span style="
                    position:absolute;
                    top:0;
                    left:0;
                    width:100%;
                    height:100%;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    color:red;
                    font-weight:bold;
                ">/</span>
            </div>
        `;

        // click disable
        slotBox.style.pointerEvents = 'none';
    }

    // ✅ selected slot
    if(selectedSlot == slot.id && slot.is_available){
        slotBox.classList.add('active');
        document.getElementById('slotInput-' + itemId).value = slot.id;
    }

    // click event
    slotBox.onclick = function(){

        if(!slot.is_available) return; // extra safety

        slotContainer.querySelectorAll('.slot-box').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('slotInput-' + itemId).value = slot.id;
    };

    col.appendChild(slotBox);
    slotContainer.appendChild(col);

    });

                });

            });
        });

    });
</script> --}}
<style>
.date-box {
    cursor: pointer;
    transition: 0.2s;
}

.date-box.active {
    background-color: #8fb3e9; /* blue background */
    color: white;
    border-radius: 0.25rem;
}
</style>

    <script>
        function selectTag(el) {
            document.querySelectorAll('.tag-btn').forEach(btn => btn.classList.remove('active'));
            el.classList.add('active');

            // select radio inside clicked label
            el.querySelector('input').checked = true;
        }

        // Loop through all modals
      document.querySelectorAll('[id^="selectSlotModal-"]').forEach(modal => {

    let itemId = modal.id.split('-')[1];
    let selectedSlot = modal.dataset.selectedSlot || '';

    // Date boxes in this modal
    modal.querySelectorAll('.date-box').forEach(box => {
        box.addEventListener('click', function() {

            // 1️⃣ Remove previous active class from all date-boxes
            modal.querySelectorAll('.date-box').forEach(b => b.classList.remove('active'));

            // 2️⃣ Add active to clicked date-box
            this.classList.add('active');

            // 3️⃣ Set hidden input value
            let availability_id = this.dataset.id;
            document.getElementById('availabilityInput-' + itemId).value = availability_id;

            // 4️⃣ Load slots for this date
            let slotContainer = document.getElementById('slotContainer-' + itemId);
            slotContainer.innerHTML = "Loading...";

            fetch("{{ url('get-slots') }}/" + availability_id)
                .then(res => res.json())
                .then(data => {
                    slotContainer.innerHTML = '';
                    let now = new Date();

                    data.data.forEach(slot => {
                        let col = document.createElement('div');
                        col.classList.add('col-auto');

                        let slotBox = document.createElement('div');
                        slotBox.classList.add('slot-box');
                        slotBox.dataset.id = slot.id;

                        // Check if slot is past
                        let slotStart = new Date();
                        let [hours, minutes] = slot.start_time.split(':');
                        slotStart.setHours(parseInt(hours), parseInt(minutes), 0, 0);
                        let isPast = slotStart < now;

                        slotBox.innerText = slot.start_time + " - " + slot.end_time;

                        // Unavailable or past slots
                        if (!slot.is_available || isPast) {
                            slotBox.classList.add('unavailable');
                            slotBox.innerHTML = `
                                <div style="position: relative;">
                                    ${slot.start_time} - ${slot.end_time}
                                    <span style="
                                        position:absolute;
                                        top:0;
                                        left:0;
                                        width:100%;
                                        height:100%;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        font-size:20px;
                                        color:red;
                                        font-weight:bold;
                                    ">/</span>
                                </div>
                            `;
                            slotBox.style.pointerEvents = 'none';
                        }

                        // Pre-select if it matches selectedSlot and is available & future
                        if (selectedSlot == slot.id && slot.is_available && !isPast) {
                            slotBox.classList.add('active');
                            document.getElementById('slotInput-' + itemId).value = slot.id;
                        }

                        // Click event for selectable slots
                        slotBox.onclick = function() {
                            if (!slot.is_available || isPast) return;

                            slotContainer.querySelectorAll('.slot-box').forEach(b => b.classList.remove('active'));
                            this.classList.add('active');
                            document.getElementById('slotInput-' + itemId).value = slot.id;
                        };

                        col.appendChild(slotBox);
                        slotContainer.appendChild(col);
                    });
                });
        });
    });

});
    </script>


    <script>
        function selectAddress(addressId) {

            localStorage.setItem('selected_address_id', addressId);

        }

        function goToRequestDetail() {

            let addressId = localStorage.getItem('selected_address_id');

            if (!addressId) {
                alert("Please select address");
                return;
            }

            // Get selected radio
            let selectedRadio = document.querySelector('input[name="address"]:checked');

            if (selectedRadio) {
                let label = selectedRadio.closest('.address-option').querySelector('label');

                selectedAddressData = {
                    tag: label.querySelector('strong').innerText,
                    fullAddress: label.querySelector('.small').innerText
                };

                // Show booking details UI
                document.getElementById('bookingDetailsCard').style.display = 'block';
                // document.getElementById('displaySelectedAddress').textContent =
                //     selectedAddressData.tag + ' - ' + selectedAddressData.fullAddress;

                // Enable confirm button if slot also selected
                checkIfComplete();
            }

            // ✅ ONLY close modal
            let modal = bootstrap.Modal.getInstance(document.getElementById('savedAddressModal'));
            modal.hide();
        }
    </script>


    <script>
        function selectTag(el) {
            document.querySelectorAll('.tag-btn').forEach(btn => btn.classList.remove('active'));
            el.classList.add('active');
        }

        $('#city_id').change(function() {

            var city_id = $(this).val();
            var url = "{{ route('customer.cart_state') }}";

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    city_id: city_id
                },

                success: function(data) {

                    $('#pincode').html('<option value="">Select pincode</option>');

                    $.each(data, function(key, value) {

                        $('#pincode').append(
                            '<option value="' + value.trim() + '">' + value.trim() +
                            '</option>'
                        );

                    });

                }
            });

        });
    </script>


    <script>
        function changeQty(value, btn) {

            let box = btn.closest('.qty-box');
            let qtyElement = box.querySelector('.qty');

            let service_id = box.dataset.serviceId;
            let category_id = box.dataset.categoryId;

            let current = parseInt(qtyElement.innerText);

            current += value;

            if (current < 1) {
                current = 1;
            }

            qtyElement.innerText = current;

            fetch("{{ route('updatecart') }}", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    body: JSON.stringify({
                        service_id: service_id,
                        category_id: category_id,
                        quantity: current
                    })

                })
                .then(response => response.json())
                .then(data => {

                    if (data.status == 200) {
                        location.reload(); // page refresh
                    }

                })
                .catch(error => {

                    console.log(error);
                    alert("Something went wrong");

                });

        }
    </script>


    <script>
        const BASE_PRICE_PER_UNIT = 3999;
        let promoDiscount = 0;

        // Store selected address
        let selectedAddressData = {
            tag: '',
            fullAddress: ''
        };

        // function selectAddress(id, tag, address) {
        //     selectedAddressData = {
        //         tag: tag,
        //         fullAddress: address
        //     };
        // }

        // function changeQty(value){
        //     let qty = document.getElementById("qty");
        //     let current = parseInt(qty.innerText);
        //     current += value;
        //     if(current < 1) current = 1;
        //     qty.innerText = current;
        //     updateTotals();
        // }

        function enableProceed() {
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

        function selectTag(el) {
            document.querySelectorAll(".tag-btn").forEach(btn => {
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

                const dayName = date.toLocaleDateString('en-US', {
                    weekday: 'short'
                });
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
                document.getElementById('selectedAddressText').textContent = selectedAddressData.tag + ' - ' +
                    selectedAddressData.fullAddress;

                // Show booking details above notes
                const bookingDetailsCard = document.getElementById('bookingDetailsCard');
                bookingDetailsCard.style.display = 'block';

                const dayNum = selectedDate.querySelectorAll('div')[1].textContent;
                const dayName = selectedDate.querySelector('div').textContent;
                const selectedTime_val = selectedTime.getAttribute('data-time');

                document.getElementById('displaySelectedAddress').textContent = selectedAddressData.tag + ' - ' +
                    selectedAddressData.fullAddress;
                document.getElementById('displaySelectedDateTime').textContent = dayName + ' ' + dayNum + ' at ' +
                    selectedTime_val;

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
            // if (!selectedDate || !selectedTime) {
            //     alert('Please select a date and time first.');
            //     return;
            // }

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
                document.getElementById('selectedAddressText').textContent = selectedAddressData.tag + ' - ' +
                    selectedAddressData.fullAddress;
            }
        });

        // Confirm and Book function with animation
        function confirmAndBook() {

            const selectedDate = document.querySelector('.date-btn.active');
            const selectedTime = document.querySelector('.time-btn.active');
            let addressId = localStorage.getItem('selected_address_id');

            if (!selectedDate || !selectedTime || !addressId) {
                alert('Please select address and time slot first');
                return;
            }

            // Optional: show animation first
            const confirmationModal = new bootstrap.Modal(document.getElementById('bookingConfirmationModal'));
            confirmationModal.show();

            // ✅ Redirect after 2 sec (or directly if you want)
            setTimeout(() => {
                window.location.href = "{{ route('request_detail') }}";
            }, 2000);
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

        document.addEventListener('DOMContentLoaded', function() {
            updateTotals();

            const mobileContinueBtn = document.getElementById('mobileContinueBtn');
            if (mobileContinueBtn) {
                mobileContinueBtn.addEventListener('click', function() {
                    if (!mobileContinueBtn.disabled) {
                        // On mobile second tab, treat this as final action
                        confirmAndBook();
                    }
                });
            }
        });
    </script>
@endsection
