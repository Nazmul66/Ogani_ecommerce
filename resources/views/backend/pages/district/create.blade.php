@extends('backend.layout.template')

@section('page-titles')
    <title>Add District | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb justify-content-between align-items-center">
                        <div class="d-flex">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add District</li>
                        </div>

                        <a href="{{ route('district.manage') }}">
                            <button class="btn btn-dark">Manage District</button>
                        </a>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end pageheader  -->

    <!-- body content start here -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Add District</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('district.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="input-select">Country Name</label>
                            <select class="form-control" id="input-select" name="country_id">
                                <option value="" selected disabled>Select the country </option>
                                @foreach ( $countries as $country )
                                     <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-select">Division Name*</label>
                            <select class="form-control" id="input-select" name="division_id">
                                <option value="" selected disabled>Select the division name</option>
                                @foreach ( $divisions as $division )
                                     <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="division_name" class="col-form-label">District Name*</label>
                            <input id="division_name" type="text" name="district_name" value="{{ old('district_name') }}" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="shipping_cost" class="col-form-label">Shipping Cost</label>
                            <input id="shipping_cost" type="text" name="shipping_cost" value="{{ old('shipping_cost') }}" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="status">
                                <option value="" selected disabled>Select the status name</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection