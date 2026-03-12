@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Customers</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Customers</a></li>
            <li class="breadcrumb-item active">View Customers</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- end row -->
    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card m-b-20">
            <div class="card-body">
              <!-- show success and error messages -->
             
        @if($message = Session::get('success'))
            <div id="success-alert" class="alert alert-success slide-alert">
                {{ $message }}
            </div>

            <style>
                .slide-alert {
                    transition: all 0.6s ease;
                }
                .slide-down {
                    opacity: 0;
                    transform: translateY(40px); /* niche slide */
                }
            </style>

            <script>
                setTimeout(function () {
                    let alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.classList.add('slide-down');
                        setTimeout(() => alert.remove(), 600);
                    }
                }, 3000); // 3 seconds
            </script>
        @endif
              <!-- End show success and error messages -->
              <div class="row">
                <div class="col-md-10">
                  <h4 class="mt-0 header-title">View Customers List</h4>
                </div>
                
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                 <table id="userTable" class="table  table-hover">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Order Id</th>
                    <th>Order Number</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone</th>
                    <th>Sub Total</th>
                    <th>Tax</th>
                    <th>Grand Total</th>
                    <th>Payment Method</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Order as $key => $Order)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>#{{ $Order->id }}</td>
                        <td>{{ $Order->order_number }}</td>
                        <td>{{ $Order->customer->name ?? 'No Data Found' }}</td>
                        <td>{{ $Order->customer->email ?? 'No Data Found' }}</td>
                        <td>{{ $Order->customer->mobile_no ?? 'No Data Found' }}</td>
                        <td>{{ $Order->subtotal ?? 'No Data Found' }}</td>
                        <td>{{ $Order->tax ?? 'No Data Found' }}</td>
                        <td>{{ $Order->grand_total ?? 'No Data Found' }}</td>
                        <td>{{ $Order->payment_method ?? 'No Data Found' }}</td>
                        <td>{{ $Order->address->address_line1 ?? '' }},{{ $Order->address->address_line2 ?? '' }},{{ $Order->address->landmark ?? '' }},{{ $Order->address->cities->city_name ?? '' }},{{ $Order->address->state->state_name ?? '' }},{{ $Order->address->pincode ?? '' }}</td>
                        <td>{{ $Order->created_at }}</td>
                        <td>
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                  Actions
                              </button>

                              <ul class="dropdown-menu">

                                  {{-- Accept Order --}}
                                  @if($Order->order_status == 1)
                                  <li>
                                      <form action="{{ route('order.updateStatus', $Order->id) }}" method="POST">
                                          @csrf
                                          @method('PATCH')
                                          <input type="hidden" name="order_status" value="2">

                                          <button type="submit" class="dropdown-item text-success">
                                              Accept
                                          </button>
                                      </form>
                                  </li>
                                  <li>
                                      <form action="{{ route('order.updateStatus', $Order->id) }}" method="POST">
                                          @csrf
                                          @method('PATCH')
                                          <input type="hidden" name="order_status" value="4">

                                          <button type="submit" class="dropdown-item text-danger">
                                              Reject
                                          </button>
                                      </form>
                                  </li>
                                  @elseif ($Order->order_status == 2)
                                <li>
                                      <form action="{{ route('order.updateStatus', $Order->id) }}" method="POST">
                                          @csrf
                                          @method('PATCH')
                                          <input type="hidden" name="order_status" value="3">

                                          <button type="submit" class="dropdown-item text-success">
                                              Complete
                                          </button>
                                      </form>
                                  </li>
                                  <li>
                                      <form action="{{ route('order.updateStatus', $Order->id) }}" method="POST">
                                          @csrf
                                          @method('PATCH')
                                          <input type="hidden" name="order_status" value="4">

                                          <button type="submit" class="dropdown-item text-danger">
                                              Reject
                                          </button>
                                      </form>
                                  </li>
                                  @else

                                  @endif

                                  {{-- Order Summary --}}
                                  <li>
                                      <a class="dropdown-item" href="{{ route('order.itemsindex', $Order->id) }}">
                                          Order Summary
                                      </a>
                                  </li>

                              </ul>
                          </div>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
    <!-- end page content-->
  </div> <!-- container-fluid -->
</div> <!-- content -->

@endsection