@extends('backend.layout.template')

@section('page-titles')
    <title>Update Campaign | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Campaign</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end pageheader  -->

    <!-- body content start here -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Update Campaign</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('campaign.update', $campaign->id ) }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="campaign_title" class="col-form-label">Campaign Title</label>
                                    <input id="campaign_title" type="text" name="campaign_title" value="{{ $campaign->title }}" class="form-control" required autocomplete="off" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_date" class="col-form-label">Start Date</label>
                                    <input id="start_date" type="date" name="start_date" value="{{ $campaign->start_date }}" class="form-control" required autocomplete="off" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="end_date" class="col-form-label">End Date</label>
                                    <input id="end_date" type="date" name="end_date" value="{{ $campaign->end_date }}" class="form-control" required autocomplete="off" placeholder="">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-select">Status</label>
                                    <select class="form-control" id="input-select" name="status">
                                        <option value="" selected disabled>Select the status name</option>
                                        <option value="1" @if( $campaign->status == 1 ) selected @endif>Active</option>
                                        <option value="2" @if( $campaign->status == 2 ) selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="discount" class="col-form-label">Discount</label>
                                    <input id="discount" type="number" name="discount" value="{{ $campaign->discount }}" class="form-control" required autocomplete="off" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="col-form-label">Main Thumbnail*</label>

                                    <label class="file_div" for="fileUploader">  
                                        <img src="{{ asset('backend/uploads/Upload_icon.png') }}" alt="Upload_icon" class="img_upload">
                                        <h3>Upload Files Here or <span>Browse</span></h3>
                                        <p>Supported formates: JPEG, PNG, JPG</p>
                                        @if ( !is_null( $campaign->image  ) )
                                           <figcaption class="file_name">{{ $campaign->image }}</figcaption>
                                        @else
                                           <figcaption class="file_name d-none"></figcaption>
                                        @endif

                                    </label>
                                    <input type="file" name="image" accept=".jpg, .png, .jpeg" class="d-none" id="fileUploader">
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