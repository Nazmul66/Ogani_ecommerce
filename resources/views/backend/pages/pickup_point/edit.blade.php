@extends('backend.layout.template')

@section('page-titles')
    <title>Update Pickup Point | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Update Pickup Point</li>
                        </div>

                        <a href="{{ route('pickup.manage') }}">
                            <button class="btn btn-dark">Manage Pickup Point</button>
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
                <h5 class="card-header">Update Pickup Point</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('pickup.update', $pickup_point->id) }}">

                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pickup_point_name" class="col-form-label">Pickup Point Name</label>
                                    <input id="pickup_point_name" type="text" name="pickup_point_name" class="form-control" value="{{ $pickup_point->pickup_point_name }}" required autocomplete="off" placeholder="Pickup Point Name ........">
                                </div>
        
                                <div class="form-group">
                                    <label for="pickup_point_address" class="col-form-label">Pickup Point Address</label>
                                    <input id="pickup_point_address" type="text" name="pickup_point_address" class="form-control" value="{{ $pickup_point->pickup_point_address }}" required autocomplete="off" placeholder="Pickup Point Address ........">
                                </div>
        
                                <div class="form-group">
                                    <label for="input-select">Status</label>
                                    <select class="form-control" id="input-select" name="status">
                                        <option value="" selected disabled>Select the status name</option>
                                        <option value="1" @if( $pickup_point->status == 1 ) selected @endif>Active</option>
                                        <option value="2" @if( $pickup_point->status == 2 ) selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pickup_point_phone" class="col-form-label">Pickup Point Phone</label>
                                    <input id="pickup_point_phone" type="text" name="pickup_point_phone" class="form-control" value="{{ $pickup_point->pickup_point_phone }}" required autocomplete="off" placeholder="Pickup Point Phone ........">
                                </div>
        
                                <div class="form-group">
                                    <label for="pickup_point_phone_two" class="col-form-label">Pickup Point Phone 2</label>
                                    <input id="pickup_point_phone_two" type="text" name="pickup_point_phone_two" class="form-control" value="{{ $pickup_point->pickup_point_phone_two }}" required autocomplete="off" placeholder="Pickup Point Phone 2 ........">
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Save Changes" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection