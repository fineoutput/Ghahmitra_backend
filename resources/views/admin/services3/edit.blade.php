@extends('admin.base_template')

@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ isset($interest) ? 'Edit' : 'Add' }} {{ $tital }}</h4>
                    <ol class="breadcrumb" style="display:none">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{$tital}}</a></li>
                        <li class="breadcrumb-item active">{{ isset($interest) ? 'Edit' : 'Add' }} {{$tital}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <!-- Show success and error messages -->
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <h4 class="mt-0 header-title">{{ isset($interest) ? 'Edit' : 'Add' }} {{$tital}} Form</h4>

                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                         <form action="{{ route('services3.update', $thservices->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group row">

        {{-- Services --}}
        <div class="col-sm-6 mt-3">
            <label>Services <span style="color:red">*</span></label>
            <select name="services_id" id="services_id" class="form-control" required>
                <option selected disabled value="">Select Services</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $thservices->services_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
            @error('services_id') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- ServicesSe --}}
        <div class="col-sm-6 mt-3">
            <label>Services Subcategory <span style="color:red">*</span></label>
            <select name="services_se_id" id="services_se_id" class="form-control" required>
                <option selected disabled value="">Select Subcategory</option>
                @foreach ($servicesSe as $se)
                    <option value="{{ $se->id }}" {{ $thservices->services_se_id == $se->id ? 'selected' : '' }}>
                        {{ $se->name }}
                    </option>
                @endforeach
            </select>
            @error('services_se_id') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- Name --}}
        <div class="col-sm-6 mt-3">
            <label>Name <span style="color:red">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $thservices->name) }}" required>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- Price --}}
        <div class="col-sm-6 mt-3">
            <label>Price <span style="color:red">*</span></label>
            <input type="number" class="form-control" name="price" value="{{ old('price', $thservices->price) }}" required>
            @error('price') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- MRP --}}
        <div class="col-sm-6 mt-3">
            <label>MRP <span style="color:red">*</span></label>
            <input type="number" class="form-control" name="mrp" value="{{ old('mrp', $thservices->mrp) }}" required>
            @error('mrp') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- Commission Percentage --}}
        <div class="col-sm-6 mt-3">
            <label>Commission (%) <span style="color:red">*</span></label>
            <input type="number" class="form-control" name="commission_percentage" value="{{ old('commission_percentage', $thservices->commission_percentage) }}" required>
            @error('commission_percentage') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- Description --}}
        <div class="col-sm-12 mt-3">
            <label>Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $thservices->description) }}</textarea>
            @error('description') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        {{-- Images --}}
        <div class="col-sm-12 mt-3">
            <label>Images</label>
            <input type="file" class="form-control" name="images[]" multiple>
            @error('images') <div style="color:red">{{ $message }}</div> @enderror

@php
    $images = is_array($thservices->image) ? $thservices->image : json_decode($thservices->image, true);
@endphp

@if($images)
    @foreach($images as $img)
        <div style="display:inline-block; position:relative; margin-right:10px;">
            <img src="{{ asset($img) }}" height="60">
            <a href="{{ route('services3.deleteImage', [$thservices->id, basename($img)]) }}"
               onclick="return confirm('Are you sure?')"
               style="position:absolute; top:0; right:0; color:red; font-weight:bold;">&times;</a>
        </div>
    @endforeach
@endif



        </div>

    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-danger">Update</button>
    </div>
</form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
            { name: 'insert', items: ['Link', 'Unlink'] },
            { name: 'styles', items: ['Format', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        height: 200
    });

    // Initialize CKEditor for long description
    
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#services_id').change(function() {
            let serviceId = $(this).val();
            $('#services_se_id').html('<option>Loading...</option>');

            $.ajax({
                url: "{{ route('get.services_se') }}",
                type: 'GET',
                data: { service_id: serviceId },
                success: function(data) {
                    let options = '<option selected disabled value="">Select Subcategory</option>';
                    $.each(data, function(key, value) {
                        options += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $('#services_se_id').html(options);
                },
                error: function() {
                    $('#services_se_id').html('<option value="">No Subcategory Found</option>');
                }
            });
        });
    });
</script>


@endsection
