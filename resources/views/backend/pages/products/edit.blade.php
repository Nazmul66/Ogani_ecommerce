@extends('backend.layout.template')

@section('page-titles')
    <title>Update Products | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Update Products</li>
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
                <h5 class="card-header">Update Products</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product_name" class="col-form-label">Product Name*</label>
                                            <input id="product_name" type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
        
                                        <div class="form-group">
                                            <label class="col-form-label">Category / SubCategory*</label>
                                            <select class="form-control" id="subCategory_id" name="subCat_id">
                                                <option value="" selected disabled>Select the category / subCategory</option>
                                                @foreach ($categories as $category)
                                                   <option disabled style="color: rgba(25, 0, 255, 0.6);">{{ $category->category_name }}</option>

                                                        @foreach ( App\Models\SubCategory::where('category_id', $category->id )->get() as $sub_cat)
                                                            <option value="{{ $sub_cat->id }}" @if( $sub_cat->id == $product->subCategory_id  ) selected @endif>---{{ $sub_cat->subcategory_name }}</option>
                                                        @endforeach
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="brand" class="col-form-label">Brand*</label>
                                            <select class="form-control" id="brand_id" required name="brand_id">
                                                <option value="" selected disabled>Select the brand</option>
                                                @foreach ( $brands as $brand )
                                                    <option value="{{ $brand->id }}" @if( $brand->id == $product->brand_id  ) selected @endif>{{ $brand->brand_name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="product_unit" class="col-form-label">Product Unit*</label>
                                            <select class="form-control" id="product_unit" name="product_unit" required>
                                                <option value="" selected disabled>Select the product unit</option>
                                                <option value="pcs" @if( $product->product_unit === 'pcs' ) selected @endif>Pcs</option>
                                                <option value="kg" @if( $product->product_unit === 'kg' ) selected @endif>Kg</option>
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product_code" class="col-form-label">Product Code*</label>
                                            <input id="product_code" type="text" name="product_code" value="{{ $product->product_code }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
        
                                        <div class="form-group">
                                            <label for="childCategory_id" class="col-form-label">Child Category*</label>
                                            <select class="form-control" id="childCategory_id" name="childCategory_id">
                                                <option value="" selected disabled>Select the child category</option>
                                                @foreach ($childCats as $childCat)
                                                   <option value="{{ $childCat->id }}" @if($childCat->id == $product->childCategory_id) selected @endif>{{ $childCat->childCategory_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="pickup_point_id" class="col-form-label">Pickup Point*</label>
                                            <select class="form-control" id="pickup_point_id" required name="pickup_point_id">
                                                <option value="" selected disabled>Select the pickup point</option>
                                                @foreach ( $pickup_points as $pickup_point )
                                                    <option value="{{ $pickup_point->id }}" @if($pickup_point->id == $product->pickup_point_id) selected @endif>{{ $pickup_point->pickup_point_name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="product_tags" class="col-form-label">Product Tags*</label>
                                            <input id="product_tags" type="text" name="product_tags" value="{{ $product->product_tags }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="purchase_price" class="col-form-label">Purchase Price*</label>
                                            <input id="purchase_price" type="text" name="purchase_price" value="{{ $product->purchase_price }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="selling_price" class="col-form-label">Selling Price*</label>
                                            <input id="selling_price" type="text" name="selling_price" value="{{ $product->selling_price }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="discount_price" class="col-form-label">Discount Price*</label>
                                            <input id="discount_price" type="text" name="discount_price" value="{{ $product->discount_price }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="warehouse" class="col-form-label">Warehouse*</label>
                                            <select class="form-control" id="warehouse_id" required name="warehouse_id">
                                                <option value="" selected disabled>Select the warehouse</option>
                                                @foreach ( $warehouses as $warehouse )
                                                    <option value="{{ $warehouse->id }}" @if($warehouse->id == $product->warehouse)  selected @endif>{{ $warehouse->warehouse_name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="quantity_stock" class="col-form-label">Stock</label>
                                            <input id="quantity_stock" type="text" name="quantity_stock" value="{{ $product->quantity_stock }}" class="form-control" required autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                   
                                    <div class="col-lg-6" id="color"  >
                                        <div class="form-group">
                                            <label for="color" class="col-form-label">Color</label>
                                            <input type="text" name="color" value="{{ $product->color }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
                                    </div>
                                   
        
                                    <div class="col-lg-6" id="size">
                                        <div class="form-group">
                                            <label for="size" class="col-form-label">Size</label>
                                            <input type="text" name="size" value="{{ $product->size }}" class="form-control" autocomplete="off" placeholder="">
                                        </div>
                                    </div>
        
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Product Description</label>
                                            <textarea id="editor" name="description">{{ $product->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="video" class="col-form-label">Video Embeded Code</label>
                                            <input id="video" type="text" name="video" value="{{ $product->video }}" class="form-control" autocomplete="off">
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
                                        @if ( !is_null($product->thumbnail) )
                                            <figcaption class="file_name">{{ $product->thumbnail }}</figcaption>
                                        @endif
                                    </label>
                                    <input type="file" name="thumbnail" accept=".jpg, .png, .jpeg" class="d-none" id="fileUploader">
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Featured Product</label>
                                    <select class="form-control" id="input-select" name="featured">
                                        <option value="" selected disabled>Select the featured product</option>
                                        <option value="1" @if( $product->featured == 1 ) selected @endif>Yes</option>
                                        <option value="2" @if( $product->featured == 2 ) selected @endif>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Trendy Product</label>
                                    <select class="form-control" id="input-select" name="trendy" required>
                                        <option value="" selected disabled>Select the trendy product</option>
                                        <option value="1" @if( $product->trendy == 1 ) selected @endif>Active</option>
                                        <option value="0" @if( $product->trendy == 2 ) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Product Slide</label>
                                    <select class="form-control" id="input-select" name="product_slide">
                                        <option value="" selected disabled>Select the product slide</option>
                                        <option value="1" @if( $product->product_slide == 1 ) selected @endif>Active</option>
                                        <option value="2" @if( $product->product_slide == 2 ) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Today Deal</label>
                                    <select class="form-control" id="input-select" name="today_deal">
                                        <option value="" selected disabled>Select the today deal</option>
                                        <option value="1" @if( $product->today_deal == 1 ) selected @endif>Active</option>
                                        <option value="2" @if( $product->today_deal == 2 ) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="input-select">Status</label>
                                    <select class="form-control" id="input-select" name="status">
                                        <option value="" selected disabled>Select the status name</option>
                                        <option value="1" @if( $product->status == 1 ) selected @endif>Active</option>
                                        <option value="2" @if( $product->status == 2 ) selected @endif>Inactive</option>
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

    <div class="row border border-3 p-4 rounded mt-3">
        <div class="col-lg-12">
              <div class="alert alert-info mb-3" role="alert">
                Update Images
              </div>
              <table class="table mb-0">
                  <thead>
                      <tr>
                          <th scope="col">Sl.</th>
                          <th scope="col">Product Image</th> 
                          <th scope="col">Image Form</th> 
                          <th>Action</th>
                      </tr>
                  </thead>


                  <tbody>
                    @php $sl = 1; @endphp
                    @foreach ( App\Models\productImage::where('product_id', $product->id)->get() as $prdImg )
                        <tr>
                          <form method="post" action="{{ route('product.imageUpdate', $prdImg->id) }}" enctype="multipart/form-data">

                            @csrf

                            <td>{{ $sl }}</td>
                            <td>
                                <img src="{{ asset('backend/uploads/products/' . $prdImg->product_image_name ) }}" alt="" style="width: 100px; height: 75px;">
                            </td>
                            <td>
                                <input type="file" name="images" value="{{ $prdImg->product_image_name }}" class="form-control">
                            </td>
                            <td>
                               <input type="submit" class="btn btn-primary" value="Update" />
                            </td>
                          </form>
                          </tr>
                      @php $sl++; @endphp
                    @endforeach
                  </tbody>
              </table>
        </div>
     </div>
    <!-- body content end here  -->

@endsection


@section('scripts')
   
 <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

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

     // Product units
     let product_unit =  document.getElementById('product_unit');
     let color        =  document.getElementById('color');
     let size         =  document.getElementById('size');
     
     product_unit.addEventListener('change', function(e){
        console.log(e.target.value);

        if( e.target.value === 'kg' ){
            color.style.display = 'none';
            size.style.display = 'none';
        }
        else if( e.target.value === 'pcs' ){
            color.style.display = 'block';
            size.style.display = 'block';
        }
     })

     // Simulate change event to set initial state based on the selected value
    // This will trigger the event listener defined above
    product_unit.dispatchEvent(new Event('change'));


    // CK Editor Plugin
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );


    $(document).ready(function() {

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