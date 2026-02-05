@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Partner Services</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Partner Services</a></li>
            <li class="breadcrumb-item active">View Partner Services</li>
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
                  <h4 class="mt-0 header-title">View Partner Services List</h4>
                </div>
                {{-- <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('services.create')}}" role="button" style="margin-left: 20px;"> Add Services</a></div> --}}
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                 <table id="userTable" class="table  table-hover">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Partner</th>
                    <th>Service</th>
                    <th>Commission</th>
                    <th>Commission Price</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ServicePartner as $key => $Services)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $Services->partner->name }}</td>
                        <td>{{ $Services->service->name }}</td>
                        <td>
                            <form action="{{ route('service-partner.updateCommission', $Services->id) }}" method="POST" style="display:flex; gap:5px; align-items:center;">
                                @csrf
                                @method('PATCH')
                                
                                <input type="number" 
                                    name="commission_percentage" 
                                    value="{{ $Services->commission_percentage ?? 0 }}" 
                                    min="0" 
                                    max="100" 
                                    step="0.01" 
                                    class="form-control form-control-sm" 
                                    style="width:70px;">
                                    
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>
                            @php
                            $sp = (float) $Services->service->price;
                            $cp = (float) $Services->commission_percentage;
                            $commissioned_price = $sp *  ($cp / 100);
                            @endphp
                            {{ number_format($commissioned_price, 2) }}</td>
                        <td>{{ $Services->created_at }}</td>
                        <td>
                            <form action="{{ route('partnerservices.updateStatus', $Services->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="{{ $Services->status == 1 ? 0 : 1 }}">

                                <button type="submit"
                                    class="btn {{ $Services->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $Services->status == 1 ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
{{-- 
                            <a href="{{ route('service-partner-document.index', $Services->id) }}" class="btn btn-primary mt-2">Partner Document</a> --}}
                          
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