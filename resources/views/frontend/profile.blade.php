@extends('frontend.common.app')
@section('title','Profile')
@section('content')
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">My Profile</h4>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <form action="{{ route('customer.update_profile') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted fw-semibold">Session Phone Number</label>
                            <input type="text" class="form-control mb-1 bg-light" value="{{ $customer->mobile_no ?? '' }}" readonly disabled>
                            <small class="text-muted"><i class="fa-solid fa-info-circle me-1"></i> Phone number cannot be changed.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control mb-1" value="{{ old('name', $customer->name ?? '') }}" placeholder="Enter your full name" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control mb-1" value="{{ old('email', $customer->email ?? '') }}" placeholder="Enter email address (Optional)">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-3">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
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