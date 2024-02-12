@extends('backend.layout.template')

@section('page-titles')
    <title>Update Coupon | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Coupon</li>
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
                <h5 class="card-header">Update Coupon</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('coupon.update', $coupon->id ) }}">

                        @csrf

                        <div class="form-group">
                            <label for="coupon_code" class="col-form-label">Coupon Code</label>
                            <input id="coupon_code" type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" class="form-control" required autocomplete="off" placeholder="Coupon Code">
                        </div>

                        <div class="form-group">
                            <label for="coupon_type">Coupon Type</label>
                            <select class="form-control" id="coupon_type" name="coupon_type">
                                <option value="" selected disabled>Select the coupon type</option>
                                <option value="1" @if( $coupon->type == 1 ) selected @endif>Fixed</option>
                                <option value="2" @if( $coupon->type == 2 ) selected @endif>Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coupon_amount" class="col-form-label">Coupon Amount</label>
                            <input id="coupon_amount" type="text" name="coupon_amount" value="{{ $coupon->coupon_amount }}" class="form-control" required autocomplete="off" placeholder="Coupon Amount">
                        </div>

                        <div class="form-group">
                            <label for="valid_date" class="col-form-label">Coupon Date</label>
                            <input id="valid_date" type="date" name="valid_date" value="{{ $coupon->valid_date }}" class="form-control" required autocomplete="off" placeholder="Coupon Date">
                        </div>

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="status">
                                <option value="" selected disabled>Select the status name</option>
                                <option value="1" @if( $coupon->status == 1 ) selected @endif>Active</option>
                                <option value="2" @if( $coupon->status == 2 ) selected @endif>Inactive</option>
                            </select>
                        </div>

                        <input type="submit" value="Save Changes" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection