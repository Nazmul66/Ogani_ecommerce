@extends('backend.layout.template')

@section('page-titles')
    <title>Update SubCategory | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SubCategory</li>
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
                <h5 class="card-header">Update SubCategories</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('subCategory.update', $sub_cat->id) }}">

                        @csrf

                        <div class="form-group">
                            <label for="input-select">Category Name</label>
                            <select class="form-control" id="input-select" name="cat_id">
                                <option value="" selected disabled>Select the category name</option>
                                  @foreach ($categories as $category)
                                      <option value="{{ $category->id }}" @if( $category->id == $sub_cat->category_id ) selected @endif>{{ $category->category_name }}</option>
                                  @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subCat_name" class="col-form-label">SubCategory Name</label>
                            <input id="subCat_name" value="{{ $sub_cat->subcategory_name }}" type="text" name="subCat_name" class="form-control" required autocomplete="off" placeholder="Write the SubCategory name">
                        </div>

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="status">
                                <option value="" selected disabled>Select the status name</option>
                                <option value="1" @if( $sub_cat->status == 1 ) selected @endif>Active</option>
                                <option value="2" @if( $sub_cat->status == 2 ) selected @endif>Inactive</option>
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