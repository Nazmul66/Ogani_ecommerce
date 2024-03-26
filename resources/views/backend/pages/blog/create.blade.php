@extends('backend.layout.template')

@section('page-titles')
    <title>Create Blog Category | Admin Dashboard </title>
@endsection

@section('body-content')

   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end pageheader  -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Add Blog</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('blog.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="category_name" class="col-form-label">Blog Category</label>
                            <input id="category_name" type="text" name="category_name" class="form-control" required autocomplete="off" placeholder="Write the Blog Category">
                        </div>

                        <input type="submit" value="Submit" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection
