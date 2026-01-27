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
                         <form action="{{ isset($Banner) ? route('Banner.update', $Banner->id) : route('Banner.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($Banner)
                                @method('PUT')
                            @endisset

                            <div class="col-sm-12 mt-3">
                                <label>Title <span style="color:red">*</span></label>
                                 <input type="text" name="title" class="form-control"
                                value="{{ old('title', $Banner->title ?? '') }}" required>
                                @error('title') <div style="color:red">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-sm-12 mt-3">
                                <label>Type <span style="color:red">*</span></label>
                                <select class="form-control" name="type">
                                   <option value="banner"
                                        {{ old('type', $Banner->type ?? '') == 'banner' ? 'selected' : '' }}>
                                        Banner
                                    </option>

                                    <option value="offer"
                                        {{ old('type', $Banner->type ?? '') == 'offer' ? 'selected' : '' }}>
                                        Offer
                                    </option>
                                </select>
                                @error('type')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 mt-3">
                                <label>Image {{ isset($Banner) ? '' : '*' }}</label>
                                 <input type="file" name="image" class="form-control" {{ isset($Banner) ? '' : 'required' }}>
                                @error('image') <div style="color:red">{{ $message }}</div> @enderror
                            </div>

                            @if(isset($Banner) && $Banner->image)
                                <img src="{{ asset($Banner->image) }}" height="60" class="mt-2">
                            @endif


                            <button type="submit" class="btn btn-danger mt-3">
                                {{ isset($Banner) ? 'Update' : 'Submit' }}
                            </button>
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
@endsection
