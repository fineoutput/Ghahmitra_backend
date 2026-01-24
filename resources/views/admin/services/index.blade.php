@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Services</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a></li>
            <li class="breadcrumb-item active">View Services</li>
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
                  <h4 class="mt-0 header-title">View Services List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('services.create')}}" role="button" style="margin-left: 20px;"> Add Services</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                 <table id="userTable" class="table  table-hover">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Services as $key => $Services)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $Services->name }}</td>
                        <td>{!! $Services->description !!}</td>
                        <td>
                            <img src="{{asset($Services->image)}}" width="100" height="100" alt="">
                        </td>
                        <td>{{ $Services->created_at }}</td>
                        <td>
                            <form action="{{ route('services.updateStatus', $Services->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="{{ $Services->status == 1 ? 0 : 1 }}">

                                <button type="submit"
                                    class="btn {{ $Services->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $Services->status == 1 ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                            <a href="{{ route('services.edit', $Services->id) }}" class="btn btn-primary mt-2">Edit</a>
                            <form action="{{ route('services.destroy', $Services->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2"
                                    onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>

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