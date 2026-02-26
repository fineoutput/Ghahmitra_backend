@extends('frontend.common.app')
@section('title','Profile')
@section('content')
<section class="py-5">
  <div class="container">
    <h4 class="mb-4">Profile</h4>
    <div class="card p-4">
      <p><strong>Name:</strong> {{ auth()->user()->name ?? 'Raj' }}</p>
      <p><strong>Phone:</strong> {{ auth()->user()->phone ?? '9461937396' }}</p>
      <p class="text-muted">Edit profile details here.</p>
    </div>
  </div>
</section>

<section class="mobile_options d-lg-none ">
  <div class="container">
    <div class="d-flex flex-column gap-2 mt-3">
            <a href="{{ route('my_requests') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-solid fa-list me-2"></i> My requests
            </a>
            <a href="{{ route('profile') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-regular fa-user me-2"></i> Profile
            </a>
            {{-- <a href="{{ route('payment-history') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-regular fa-credit-card me-2"></i> Payment History
            </a> --}}
            <a href="{{ route('wallet') }}" class="btn btn-light text-start rounded-3 py-3">
              <i class="fa-solid fa-coins me-2"></i> Wallet
            </a>
          </div>
  </div>
</section>
@endsection