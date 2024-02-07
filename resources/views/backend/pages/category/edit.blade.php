@extends('backend.layout.template')

@section('page-titles')
    <title>Update Category | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Category</li>
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
                <h5 class="card-header">Update Categories</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('category.update', $category->id ) }}">

                        @csrf

                        <div class="form-group">
                            <label for="cat_name" class="col-form-label">Category Name</label>
                            <input id="cat_name" type="text" name="cat_name" value="{{ $category->category_name }}" class="form-control" required autocomplete="off" placeholder="Write the category name">
                        </div>

                        <div class="form-group">
                            <label for="input-select">Status</label>
                            <select class="form-control" id="input-select" name="status">
                                <option value="" selected disabled>Select the status name</option>
                                <option value="1" @if( $category->status == 1 ) selected @endif>Active</option>
                                <option value="2" @if( $category->status == 2 ) selected @endif>Inactive</option>
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