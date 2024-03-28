@extends('backend.layout.template')

@section('page-titles')
    <title>Campaign Products List  | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Campaign Products List</li>
                        </div>
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
                <div class="d-flex justify-content-between align-items-center card-header">
                    <h5 class="mb-0">Campaign Products List</h5>
                    <a href="{{ route('campaign.product', $campaign_id) }}">
                        <button class="btn btn-dark">Back</button>
                    </a>
                </div>
                  <div class="card-body">

                    @if ( $products->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no campaign products list data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ( $products as $sl => $row )
                                    <tr>
                                        <th scope="row">{{ $sl + 1 }}</th>
                                        <td>{{ $row->product_name }}</td>
                                        <td>
                                            <img src="{{ asset('backend/uploads/products/' . $row->thumbnail )  }}" alt="" style="width: 75px; height: 75px;">
                                        </td>
                                        <td>{{ $row->product_code }}</td>
                                        <td>{{ $row->selling_price }}{{ $setting->currency }}</td>
                                        <td>
                                            <ul class="action_list">
                                                <li style="background: #dd0000;">
                                                    <a href="{{ route('destroy.campaign.product', $row->id) }}"><i class="fa fa-trash"></i></a> 
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
    <!-- body content start end -->

@endsection
