@extends('backend.layout.template')

@section('page-titles')
    <title>Update Division | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Update Division</li>
                        </div>

                        <a href="{{ route('division.manage') }}">
                            <button class="btn btn-dark">Manage Division</button>
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
                <h5 class="card-header">Update Division</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('division.update', $division->id) }}">

                        @csrf

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="country_id">
                                <option value="" selected disabled>Select the country name</option>
                                @foreach ( $countries as $country )
                                     <option value="{{ $country->id }}" @if($country->id == $division->country_id) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="division_name" class="col-form-label">Division Name*</label>
                            <input id="division_name" type="text" name="name" value="{{ $division->division_name }}" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="status">
                                <option value="" selected disabled>Select the status name</option>
                                <option value="1" @if($division->status === 1) selected @endif>Active</option>
                                <option value="2" @if($division->status === 2district) selected @endif>Inactive</option>
                            </select>
                        </div>

                        <input type="submit" value="Update" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection