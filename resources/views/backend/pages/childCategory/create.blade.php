@extends('backend.layout.template')

@section('page-titles')
    <title>Create ChildCategory | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ChildCategory</li>
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
                <h5 class="card-header">Add ChildCategories</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('childCategory.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="input-select">Category / SubCategory</label>
                            <select class="form-control" id="input-select" name="sub_id">
                                <option value="" selected disabled>Select the Category / SubCategory</option>
                                  @foreach ($categories as $category)
                                      <option disabled>{{ $category->category_name }}</option>

                                        @foreach ( App\Models\SubCategory::where('category_id', $category->id)->get() as $subCat)
                                            <option value="{{ $subCat->id }}">---- {{ $subCat->subcategory_name }}</option>
                                        @endforeach
                                  @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="childCat_name" class="col-form-label">ChildCategory Name</label>
                            <input id="childCat_name" type="text" name="childCat_name" class="form-control" required autocomplete="off" placeholder="Write the ChildCategory name">
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