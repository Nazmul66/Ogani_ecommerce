@extends('backend.layout.template')

@section('page-titles')
    <title>Create Products | Admin Dashboard </title>
@endsection

@section('style-css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">Create Products</li>
                        </div>

                        <a href="{{ route('product.manage') }}">
                            <button class="btn btn-dark">Manage Products</button>
                        </a>
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
                <h5 class="card-header">New Products</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product_name" class="col-form-label">Product Name*</label>
                                            <input id="product_name" type="text" name="product_name" value="{{ old('product_name') }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
        
                                        <div class="form-group">
                                            <label class="col-form-label">Category / SubCategory*</label>
                                            <select class="form-control" id="subCategory_id" name="subCat_id">
                                                <option value="" selected disabled>Select the category / subCategory</option>
                                                @foreach ($categories as $category)
                                                   <option disabled style="color: rgba(25, 0, 255, 0.6);">{{ $category->category_name }}</option>

                                                        @foreach ( App\Models\SubCategory::where('category_id', $category->id )->get() as $sub_cat)
                                                            <option value="{{ $sub_cat->id }}">---{{ $sub_cat->subcategory_name }}</option>
                                                        @endforeach
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="brand" class="col-form-label">Brand*</label>
                                            <select class="form-control" id="brand_id" required name="brand_id">
                                                <option value="" selected disabled>Select the brand</option>
                                                @foreach ( $brands as $brand )
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="product_unit" class="col-form-label">Product Unit*</label>
                                            <input id="product_unit" type="text" name="product_unit" value="{{ old('product_unit') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product_code" class="col-form-label">Product Code*</label>
                                            <input id="product_code" type="text" name="product_code" value="{{ old('product_code') }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
        
                                        <div class="form-group">
                                            <label for="childCategory_id" class="col-form-label">Child Category*</label>
                                            <select class="form-control" id="childCategory_id" name="childCategory_id" required>
                                                <option value="" selected disabled>Select the child category</option>
                                                @foreach ($child_cats as $child_cat)
                                                    <option value="{{ $child_cat->id }}">{{ $child_cat->id }} rdefgh</option>
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="pickup_point_id" class="col-form-label">Pickup Point*</label>
                                            <select class="form-control" id="pickup_point_id" name="pickup_point_id" required>
                                                <option value="" selected disabled>Select the pickup point</option>
                                                @foreach ( $pickup_points as $pickup_point )
                                                    <option value="{{ $pickup_point->id }}">{{ $pickup_point->pickup_point_name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="product_tags" class="col-form-label">Product Tags*</label>
                                            <input id="product_tags" type="text" name="product_tags" value="{{ old('product_tags') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="purchase_price" class="col-form-label">Purchase Price*</label>
                                            <input id="purchase_price" type="text" name="purchase_price" value="{{ old('purchase_price') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="selling_price" class="col-form-label">Selling Price*</label>
                                            <input id="selling_price" type="text" name="selling_price" value="{{ old('selling_price') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="discount_price" class="col-form-label">Discount Price*</label>
                                            <input id="discount_price" type="text" name="discount_price" value="{{ old('discount_price') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="warehouse" class="col-form-label">Warehouse*</label>
                                            <select class="form-control" id="warehouse_id" required name="warehouse_id">
                                                <option value="" selected disabled>Select the warehouse</option>
                                                @foreach ( $warehouses as $warehouse )
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="quantity_stock" class="col-form-label">Stock</label>
                                            <input id="quantity_stock" type="text" name="quantity_stock" value="{{ old('quantity_stock') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="color" class="col-form-label">Color</label>
                                            <input id="color" type="text" name="color" value="{{ old('color') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="size" class="col-form-label">Size</label>
                                            <input id="size" type="text" name="size" value="{{ old('size') }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Product Description</label>
                                            <textarea id="summernote" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="video" class="col-form-label">Video Embeded Code</label>
                                            <input id="video" type="text" name="video" value="{{ old('video') }}" class="form-control" required autocomplete="off">
                                        </div>
                                    </div>
                               </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="col-form-label">Main Thumbnail*</label>

                                    <label class="file_div" for="fileUploader">  
                                        <img src="{{ asset('backend/uploads/Upload_icon.png') }}" alt="Upload_icon" class="img_upload">
                                        <h3>Upload Files Here or <span>Browse</span></h3>
                                        <p>Supported formates: JPEG, PNG, JPG</p>
                                        <figcaption class="file_name d-none">{{ old('thumbnail') }}</figcaption>
                                    </label>
                                    <input type="file" name="thumbnail" accept=".jpg, .png, .jpeg" class="d-none" id="fileUploader">
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label for="formFile" class="form-label mb-0">More Images</label>
                                        <button type="button" id="addMore" class="btn btn-primary">Add More Images</button>
                                    </div>

                                    <input class="form-control mb-3" type="file" name="images[]" id="formFile">
                                    
                                    <div id="imageInputs"></div>
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Featured Product</label>
                                    <select class="form-control" id="input-select" name="featured">
                                        <option value="" selected disabled>Select the featured product</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Today Deal</label>
                                    <select class="form-control" id="input-select" name="today_deal">
                                        <option value="" selected disabled>Select the today deal</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
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
                            </div>
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
   
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

 <script>
    // file upload function
    const fileUploader = document.querySelector('#fileUploader');
    const fileNameElement = document.querySelector('.file_name');

    fileUploader.addEventListener('change', (e) => {
        const fileName = e.target.files[0].name;
        console.log(e.target.files[0]);
        fileNameElement.textContent = fileName;
        fileNameElement.classList.remove('d-none');
    });

    // multiple image upload function
    document.getElementById('addMore').addEventListener('click', function() {
        let imageInputs = document.getElementById('imageInputs');
        let newInput = document.createElement('div');
        newInput.setAttribute('class', 'd-flex justify-content-between align-items-center position-relative mb-3');
        newInput.innerHTML = `<input type="file" class="form-control" name="images[]">
                              <button type="button" class="remove_btn btn btn-danger"><i class="fas fa-times"></i></button>`;
        imageInputs.appendChild(newInput);
        
        // Attach event listener to the remove button
        let removeButton = newInput.querySelector('.remove_btn');
            removeButton.addEventListener('click', function() {
            imageInputs.removeChild(newInput);
        });
    });

    // SummerNote plugin js 
    $(document).ready(function() {
        $('#summernote').summernote({
          placeholder: "{{ old(strip_tags('description')) }}",
          tabsize: 2,
          height: 150
      });

    // Child Category api data read
     $('#subCategory_id').change(function() {
         var id = $('#subCategory_id').val();
         console.log(id);

         $.ajax({
            url: "{{ url('/get-child-category') }}/" + id,
            type: "get",
            success: function(data) {
                $('#childCategory_id').empty();
                $.each(data, function(key, data){
                    $('#childCategory_id').append('<option value="'+ data.id +'">'+ data.childCategory_name +'</option>');
                });
            }
         })
     })


    });
 </script>


@endsection