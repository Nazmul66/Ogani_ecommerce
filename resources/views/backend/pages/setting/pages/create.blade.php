@extends('backend.layout.template')

@section('page-titles')
    <title>Create Page | Admin Dashboard </title>
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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Page</li>
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
                <h5 class="card-header">Add Page</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('page.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="input-select">Page Position</label>
                            <select class="form-control" id="input-select" name="page_position">
                                <option value="" selected disabled>Select the page position</option>
                                <option value="1">Line One</option>
                                <option value="2">Line Two</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="page_name" class="col-form-label">Page Name</label>
                            <input id="page_name" type="text" name="page_name" value="{{ old('page_name') }}" class="form-control" required autocomplete="off" placeholder="Page Name">
                        </div>

                        <div class="form-group">
                            <label for="page_title" class="col-form-label">Page Title</label>
                            <input id="page_title" type="text" name="page_title" value="{{ old('page_title') }}" class="form-control" required autocomplete="off" placeholder="Page Title">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Page Description</label>
                            <textarea id="summernote" name="page_description" value="{{ old('page_description') }}"></textarea>
                        </div>

                        <input type="submit" value="Create Page" class="btn btn-dark" />
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
    $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: 'Page Description',
        tabsize: 2,
        height: 150
      });
    });
 </script>

@endsection
