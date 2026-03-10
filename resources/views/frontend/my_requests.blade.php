@extends('frontend.common.app')
@section('title','My Requests')
@section('content')
<section class="py-5">
  <div class="container">
   

    
<div class="my-orders-section">

    <h2 class="orders-title">My Orders</h2>

    @foreach ($orders as $value)
    <div class="order-card">

        <div class="order-top">
            <div class="order-left">

                <h5 class="service-name">Electricians</h5>
                
                <div class="order-date">
                    📅 Feb 23, 2026
                </div>
                
                <div class="status-pill">
                    <span class="icon">🧰</span>
                    Not Yet Connected
                </div>
                <span class="badge-closed">CLOSED</span>


            </div>

            <div class="order-image">
                <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" alt="">
            </div>
        </div>

        <div class="order-bottom">
          <a href="{{ route('request_detail') }}">
            <button class="view-btn">
                View Details →
            </button>
            </a>
        </div>

    </div>
    @endforeach

</div>
  </div>

</section>
@endsection