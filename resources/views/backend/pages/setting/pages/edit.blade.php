@extends('backend.layout.template')

@section('page-titles')
    <title>Update Page | Admin Dashboard </title>
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
                        <li class="breadcrumb-item active" aria-current="page">Update Page</li>
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
                <h5 class="card-header">Update Page</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('page.update', $pages->id) }}">

                        @csrf

                        <div class="form-group">
                            <label for="input-select">Page Position</label>
                            <select class="form-control" id="input-select" name="page_position">
                                <option value="" selected disabled>Select the page position</option>
                                <option value="1" @if( $pages->page_position == 1 ) selected @endif>Line One</option>
                                <option value="2" @if( $pages->page_position == 2 ) selected @endif>Line Two</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="page_name" class="col-form-label">Page Name</label>
                            <input id="page_name" type="text" name="page_name" value="{{ $pages->page_name }}" class="form-control" required autocomplete="off" placeholder="Page Name">
                        </div>

                        <div class="form-group">
                            <label for="page_title" class="col-form-label">Page Title</label>
                            <input id="page_title" type="text" name="page_title" value="{{ $pages->page_title }}" class="form-control" required autocomplete="off" placeholder="Page Title">
                        </div>

                        @php $taglessBody = strip_tags( $pages->page_description ); @endphp
                        <div class="form-group">
                            <label class="col-form-label">Page Description</label>
                            <textarea id="summernote" name="page_description" >{{ $taglessBody }}</textarea>
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
