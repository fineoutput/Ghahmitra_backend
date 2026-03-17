@extends('frontend.common.app')
@section('title','My Requests')
@section('content')

<div class="container py-5">

  <!-- Order Summary Card -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">Order Summary</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <p><strong>Order ID:</strong> #{{ $order->id }}</p>
          <p><strong>Customer Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
          <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

          <p>
            <strong>Status:</strong> 
            <span class="badge bg-success">
              {{ $order->status ?? 'Pending' }}
            </span>
          </p>

          <p><strong>Payment:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Table -->
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Order Items</h5>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Product</th>
              {{-- <th>Image</th> --}}
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody>
            @php $subtotal = 0; @endphp

            @foreach($order->orderItems as $index => $item)
              @php
                $price = $item->price ?? 0;
                $qty = $item->quantity ?? 1;
                $total = $price * $qty;
                $subtotal += $total;
              @endphp

              <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $item->service->name ?? 'N/A' }}</td>

                {{-- <td>
                  <img 
                    src="{{ asset($item->service->image[0] ?? 'default.png') }}" 
                    class="img-fluid rounded" 
                    width="60"
                  >
                </td> --}}

                <td>₹{{ $price }}</td>
                <td>{{ $qty }}</td>
                <td>₹{{ $total }}</td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer Total -->
    @php
      $discount = $order->discount ?? 0;
      $grandTotal = $subtotal - $discount;
    @endphp

    <div class="card-footer text-end">
      <h5 class="mb-1">Subtotal: ₹{{ $subtotal }}</h5>
      <h6 class="mb-1 text-success">Discount: -₹{{ $discount }}</h6>
      <h4 class="fw-bold">Grand Total: ₹{{ $grandTotal }}</h4>
    </div>
  </div>

</div>

@endsection