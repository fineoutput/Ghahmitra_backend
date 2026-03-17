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

                <h5 class="service-name">#{{$value->id}}</h5>
                
                <div class="order-date">
                    📅 {{ $value->created_at->format('d M Y') }}
                </div>
                
                {{-- <div class="status-pill">
                    <span class="icon">🧰</span>
                    Not Yet Connected
                </div> --}}
                {{-- <span class="badge-closed">CLOSED</span> --}}


            </div>
{{-- <div class="order-image">
    <img src="{{ asset($value->orderItems->first()->service->image[0] ?? '') }}" alt="">
</div> --}}
        </div>

        <div class="order-bottom">
          {{-- <a href="{{ route('request_detail') }}">
            <button class="view-btn">
                View Details →
            </button>
            </a> --}}

            <a href="{{ route('orderdetail', $value->id) }}">
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