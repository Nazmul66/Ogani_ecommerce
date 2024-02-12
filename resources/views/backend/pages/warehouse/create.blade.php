@extends('backend.layout.template')

@section('page-titles')
    <title>Create Warehouse | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Warehouse</li>
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
                <h5 class="card-header">Add Warehouse</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('warehouse.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="warehouse_name" class="col-form-label">Warehouse Name</label>
                            <input id="warehouse_name" type="text" name="warehouse_name" class="form-control" required autocomplete="off" placeholder="Warehouse Name">
                        </div>

                        <div class="form-group">
                            <label for="warehouse_address" class="col-form-label">Warehouse Address</label>
                            <input id="warehouse_address" type="text" name="warehouse_address" class="form-control" required autocomplete="off" placeholder="Warehouse Address">
                        </div>

                        <div class="form-group">
                            <label for="warehouse_phone" class="col-form-label">Warehouse Phone Number</label>
                            <input id="warehouse_phone" type="text" name="warehouse_phone" class="form-control" required autocomplete="off" placeholder="Write Phone Number.........">
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