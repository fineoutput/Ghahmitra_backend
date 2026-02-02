@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Service Partner</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Service Partner</a></li>
            <li class="breadcrumb-item active">View Service Partner</li>
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
                  <h4 class="mt-0 header-title">View Service Partner List</h4>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ServicePartner as $key => $Services)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $Services->name }}</td>
                        <td>{{ $Services->email }}</td>
                        <td>{{ $Services->phone }}</td>
                        <td>{{ $Services->address }}</td>
                        <td>{{ $Services->created_at }}</td>
                        <td>
                          @php
                            $statusButtons = [];

                            switch($Services->status) {
                                case 0: // Inactive
                                    $statusButtons = [
                                        1 => ['label' => 'Approved', 'class' => 'btn-success'],
                                        2 => ['label' => 'Reject', 'class' => 'btn-danger'],
                                    ];
                                    break;

                                case 1: // Active
                                    $statusButtons = [
                                        2 => ['label' => 'Inactive', 'class' => 'btn-danger'],
                                    ];
                                    break;

                                case 2: // Rejected
                                    $statusButtons = [
                                        1 => ['label' => 'Active', 'class' => 'btn-success'],
                                    ];
                                    break;
                            }
                        @endphp

                        @foreach($statusButtons as $value => $button)
                            <form action="{{ route('service-partner.updateStatus', $Services->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $value }}">
                                <button type="submit" class="btn {{ $button['class'] }}">
                                    {{ $button['label'] }}
                                </button>
                            </form>
                        @endforeach
                            <br>
                            <a href="{{ route('service-partner-document.index', $Services->id) }}" class="btn btn-primary mt-2">Partner Document</a>
                            <br>
                            <a href="{{ route('partnerservice.index', $Services->id) }}" class="btn btn-primary mt-2">Partner Services</a>
                          
                        </td>
                        <td>
                          <form action="{{ route('partner.rank', $Services->id) }}" method="POST"
                            style="display:flex; gap:5px; align-items:center;">
                            @csrf
                            @method('PATCH')

                            <select name="rank" class="form-select form-select-sm" style="width:120px;">
                                <option value="1" {{ $Services->rank == 1 ? 'selected' : '' }}>Beginner</option>
                                <option value="2" {{ $Services->rank == 2 ? 'selected' : '' }}>Intermediate</option>
                                <option value="3" {{ $Services->rank == 3 ? 'selected' : '' }}>Expert</option>
                            </select>

                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
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