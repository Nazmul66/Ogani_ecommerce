@extends('backend.layout.template')

@section('page-titles')
    <title>Create Category | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Category</li>
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
                <h5 class="card-header">Add Categories</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="cat_name" class="col-form-label">Category Name</label>
                            <input id="cat_name" type="text" name="cat_name" class="form-control" required autocomplete="off" placeholder="Write the category name">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label">Icons*</label>

                            <label class="file_div" for="fileUploader">  
                                <img src="{{ asset('backend/uploads/Upload_icon.png') }}" alt="Upload_icon" class="img_upload">
                                <h3>Upload Files Here or <span>Browse</span></h3>
                                <p>Supported formates: JPEG, PNG, JPG</p>
                                <figcaption class="file_name d-none">{{ old('icon') }}</figcaption>
                            </label>
                            <input type="file" name="icon" accept=".jpg, .png, .jpeg" class="d-none" id="fileUploader">
                        </div>

                        <div class="form-group">
                            <label for="input-select">Home Page</label>
                            <select class="form-control" id="input-select" name="home_page">
                                <option value="" selected disabled>Select the home page status</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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