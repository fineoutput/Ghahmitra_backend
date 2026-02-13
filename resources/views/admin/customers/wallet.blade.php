@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Wallet</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Wallet</a></li>
            <li class="breadcrumb-item active">View Wallet</li>
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
                <div class="col-md-8">
                  <h4 class="mt-0 header-title">View Wallet List</h4>
                </div>
                <div class="col-md-4">
                   <h2 class="text-success">₹{{$Wallet->balance ?? 0}}</h2>
                </div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                 <table id="userTable" class="table  table-hover">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Wallet_id</th>
                    <th>Transaction Id</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Opening Balance</th>
                    <th>Closing Balance</th>
                    <th>Transaction For</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Ip Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($WalletTransactions as $key => $customer)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $customer->wallet_id }}</td>
                        <td>{{ $customer->transaction_id }}</td>
                        <td>{{ $customer->type }}</td>
                        <td>{{ $customer->amount }}</td>
                        <td>{{ $customer->opening_balance }}</td>
                        <td>{{ $customer->closing_balance }}</td>
                        <td>{{ $customer->transaction_for }}</td>
                        <td>{{ $customer->description }}</td>
                        <td>{{ $customer->status }}</td>
                        <td>{{ $customer->payment_method }}</td>
                        <td>{{ $customer->ip_address }}</td>
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