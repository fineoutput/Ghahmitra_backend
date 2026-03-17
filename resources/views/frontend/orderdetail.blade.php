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
          <p><strong>Order ID:</strong> #12345</p>
          <p><strong>Customer Name:</strong> John Doe</p>
          <p><strong>Email:</strong> john@example.com</p>
        </div>
        <div class="col-md-6">
          <p><strong>Order Date:</strong> 17 Mar 2026</p>
          <p><strong>Status:</strong> <span class="badge bg-success">Delivered</span></p>
          <p><strong>Payment:</strong> COD</p>
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
              <th>Image</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Product Name 1</td>
              <td>
                <img src="https://via.placeholder.com/60" class="img-fluid rounded" width="60">
              </td>
              <td>₹500</td>
              <td>2</td>
              <td>₹1000</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Product Name 2</td>
              <td>
                <img src="https://via.placeholder.com/60" class="img-fluid rounded" width="60">
              </td>
              <td>₹300</td>
              <td>1</td>
              <td>₹300</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer Total -->
    <div class="card-footer text-end">
      <h5 class="mb-1">Subtotal: ₹1300</h5>
      <h6 class="mb-1 text-success">Discount: -₹100</h6>
      <h4 class="fw-bold">Grand Total: ₹1200</h4>
    </div>
  </div>

</div>


@endsection