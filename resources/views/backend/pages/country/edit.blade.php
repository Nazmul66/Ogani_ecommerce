@extends('backend.layout.template')

@section('page-titles')
    <title>Update Country | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Update Country</li>
                        </div>

                        <a href="{{ route('country.manage') }}">
                            <button class="btn btn-dark">Manage Country</button>
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
                <h5 class="card-header">Update Country</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('country.update', $country->id) }}">

                        @csrf

                        <div class="form-group">
                            <label for="country_name" class="col-form-label">Country Name*</label>
                            <input id="country_name" type="text" name="name" value="{{ $country->name }}" class="form-control" autocomplete="off" required>
                        </div>

                        <input type="submit" value="Update" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection