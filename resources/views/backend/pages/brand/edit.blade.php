@extends('backend.layout.template')

@section('page-titles')
    <title>Update Brand | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Brand</li>
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
                <h5 class="card-header">Update Brand</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('brand.update', $brand->id ) }}" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="cat_name" class="col-form-label">Brand Name</label>
                            <input id="cat_name" type="text" name="brand_name" value="{{ $brand->brand_name }}" class="form-control" required autocomplete="off" placeholder="Write the brand name">
                        </div>

                        <div class="mb-3">
                            <label class="file_div" for="fileUploader">
                                {{-- <h2>Upload</h2> --}}
                                <img src="{{ asset('backend/uploads/Upload_icon.png') }}" alt="" class="img_upload">
                                <h3>Upload Files Here or <span>Browse</span></h3>
                                <p>Supported formates: JPEG, PNG, JPG</p>
                                @if ( !is_null($brand->brand_logo) )
                                   <figcaption class="file_name">{{ $brand->brand_logo }}</figcaption>
                                @else
                                   <figcaption class="file_name d-none"></figcaption>
                                @endif
                            </label> 

                            <input type="file" name="brandLogo" value="{{ $brand->brand_logo }}" accept=".jpg, .png, .jpeg" class="d-none" id="fileUploader">
                          </div>

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="status">
                                <option value="" selected disabled>Select the status name</option>
                                <option value="1" @if( $brand->status == 1 ) selected @endif>Active</option>
                                <option value="2" @if( $brand->status == 2 ) selected @endif>Inactive</option>
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


@section('scripts')
   
<script>
const fileUploader = document.querySelector('#fileUploader');
const fileNameElement = document.querySelector('.file_name');

fileUploader.addEventListener('change', (e) => {
    const fileName = e.target.files[0].name;
    console.log(e.target.files[0]);
    fileNameElement.textContent = fileName;
    fileNameElement.classList.remove('d-none');
});
</script>

@endsection
