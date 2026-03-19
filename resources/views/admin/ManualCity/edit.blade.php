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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $tital }}</a></li>
                            <li class="breadcrumb-item active">{{ isset($interest) ? 'Edit' : 'Add' }} {{ $tital }}
                            </li>
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

                                <h4 class="mt-0 header-title">{{ isset($interest) ? 'Edit' : 'Add' }} {{ $tital }}
                                    Form</h4>

                                <hr style="margin-bottom: 50px;background-color: darkgrey;">
                                <form action="{{ route('city.update', $ManualCity->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>City Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="city_name"
                                                value="{{ old('city_name', $ManualCity->city_name) }}" required>
                                            @error('city_name')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label>PinCode <span style="color:red">*</span></label>
                                            <select name="pincode[]" class="form-control" id="pieces" multiple>
                                                @php
                                                    // Exploding the stored string into an array
                                                    $selectedBlocks = old(
                                                        'pincode',
                                                        explode(',', $ManualCity->pincode),
                                                    );
                                                @endphp

                                                @foreach ($selectedBlocks as $block)
                                                    <option value="{{ $block }}"
                                                        {{ in_array($block, $selectedBlocks) ? 'selected' : '' }}>
                                                        {{ $block }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pincode')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-danger">
                                            Update
                                        </button>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>

    <script>
        // Initialize Select2 for the 'pieces' select element
        $('#pieces').select2({
            tags: true, // Enable the ability to add custom tags
            placeholder: "Select", // Placeholder text
            allowClear: true // Option to clear selections
        });

        // Show the selected value(s) when the button is clicked
        $('#show').on('click', function(e) {
            var selectedValues = $('#pieces').val(); // Get selected values
            if (selectedValues.length > 0) {
                // Show selected values in a formatted way
                alert("Selected values: \n" + selectedValues.join(
                "\n")); // Display each selected value on a new line
            } else {
                alert("No values selected.");
            }
        });
    </script>
@endsection
