@extends('backend.layout.template')

@section('page-titles')
    <title>Manage Trash Product | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
   <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb justify-content-between align-items-center">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Trash Product</li>
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
                    <h5 class="mb-0">Manage Trash Product</h5>
                    <a href="{{ route('product.manage') }}">
                        <button class="btn btn-dark ">Manage Folder</button>
                    </a>
                </div>
                  <div class="card-body">

                    @if ( $products->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no trash products data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Category</th>
                                <th scope="col">SubCategory</th>
                                <th scope="col">ChildCategory</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Featured</th>
                                <th scope="col">Today Deal</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ( $products as $key=>$product )
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            <img src="{{ asset('backend/uploads/products/' . $product->thumbnail) }}" alt="" style="width: 60px; height: 60px;">
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>
                                            @foreach ($categories as $category)
                                                @if ( $product->category_id == $category->id )
                                                   {{ $category->category_name }} 
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($sub_cats as $sub_cat)
                                                @if ( $product->subCategory_id == $sub_cat->id )
                                                   {{ $sub_cat->subcategory_name }} 
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($child_cats as $child_cat)
                                                @if ( $product->childCategory_id == $child_cat->id )
                                                   {{ $child_cat->childCategory_name }} 
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($brands as $brand)
                                                @if ( $product->brand_id == $brand->id )
                                                   {{ $brand->brand_name }} 
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ( $product->featured == 1 )
                                                <span class="badge-text-primary">Yes</span>
                                            @elseif ( $product->featured == 2 ) 
                                                <span class="badge-text-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $product->today_deal == 1 )
                                            <span class="badge-text-primary">Active</span>
                                            @elseif ( $product->today_deal == 2 ) 
                                            <span class="badge-text-Danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $product->status == 1 )
                                            <span class="badge-text-primary">Active</span>
                                            @elseif ( $product->status == 2 ) 
                                            <span class="badge-text-Danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action_list">
                                                <li style="background: #157347;">
                                                    <a href="{{ route('product.edit', $product->id) }}"><i class="far fa-edit"></i></a> 
                                                </li>
                                                <li style="background: #BB2D3B;">
                                                    <span data-toggle="modal" data-target="#product{{ $product->id }}"><i class="fas fa-trash"></i></span> 
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>


                                    <!-- Modal start -->
                                    <div class="modal fade" id="product{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this data!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body text-center">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                    <a href="{{ route('product.trash-destroy', $product->id) }}" class="btn btn-primary">Confirm</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal end -->
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                  </div>
            </div>
        </div>
    </div>


@endsection

