@extends('backend.layout.template')

@section('page-titles')
    <title>Manage Category | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
   <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
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
                <div class="d-flex justify-content-between align-items-center card-header ">
                    <h5 class="mb-0">Manage Categories</h5>
                    <a href="{{ route('category.trash-manage') }}">
                        <button class="btn btn-dark ">Manage Trash Folder</button>
                    </a>
                </div>
                  <div class="card-body">

                    @if ( $categories->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no category data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Category Slug</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ( $categories as $key=>$category )
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->category_slug }}</td>
                                        <td>
                                            @if ( $category->status == 1 )
                                            <span class="badge-text-primary">Active</span>
                                            @elseif ( $category->status == 2 ) 
                                            <span class="badge-text-Danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                        <ul class="action_list">
                                            <li style="background: #157347;">
                                                <a href="{{ route('category.edit', $category->id) }}"><i class="far fa-edit"></i></a> 
                                            </li>
                                            <li style="background: #BB2D3B;">
                                                <a href="{{ route('category.destroy', $category->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-trash"></i></a> 
                                            </li>
                                        </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                  </div>
            </div>
        </div>
    </div>


@endsection
