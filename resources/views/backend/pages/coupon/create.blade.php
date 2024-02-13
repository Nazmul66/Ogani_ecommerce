@extends('backend.layout.template')

@section('page-titles')
    <title>Create Coupon | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Create Coupon</li>
                        </div>

                        <a href="{{ route('coupon.manage') }}">
                            <button class="btn btn-dark ">Manage Coupon</button>
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
                <h5 class="card-header">Add Coupon</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('coupon.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="coupon_code" class="col-form-label">Coupon Code</label>
                            <input id="coupon_code" type="text" name="coupon_code" class="form-control" required autocomplete="off" placeholder="Coupon Code">
                        </div>

                        <div class="form-group">
                            <label for="coupon_type">Coupon Type</label>
                            <select class="form-control" id="coupon_type" name="coupon_type">
                                <option value="" selected disabled>Select the coupon type</option>
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coupon_amount" class="col-form-label">Coupon Amount</label>
                            <input id="coupon_amount" type="text" name="coupon_amount" class="form-control" required autocomplete="off" placeholder="Coupon Amount">
                        </div>

                        <div class="form-group">
                            <label for="valid_date" class="col-form-label">Coupon Date</label>
                            <input id="valid_date" type="date" name="valid_date" class="form-control" required autocomplete="off" placeholder="Coupon Date">
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