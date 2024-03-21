@extends('backend.layout.template')

@section('page-titles')
    <title>Manage Order | Admin Dashboard </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Order</li>
                        </div>

                        <a href="{{ route('product.create') }}">
                            <button class="btn btn-dark ">Add New Order</button>
                        </a>
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
                    <h5 class="mb-0">Manage Product</h5>
                    <a href="{{ route('product.trash-manage') }}">
                        <button class="btn btn-dark ">Manage Trash Folder</button>
                    </a>
                </div>
                  <div class="card-body">

                    @if ( $orders->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no orders data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">SubTotal</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ( $orders as $key=>$order )
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $order->c_name }}</td>
                                        <td>{{ $order->c_phone }}</td>
                                        <td>{{ $order->c_email }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->payment_type }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>
                                            @if ( $order->status == 0 )
                                                <span class="badge rounded-pill text-white bg-secondary custom-badge">Order Pending</span>
                                            @elseif($order->status == 1)
                                                <span class="badge rounded-pill text-white bg-info custom-badge">Order Received</span>
                                            @elseif($order->status == 2)
                                                <span class="badge rounded-pill text-white bg-primary custom-badge">Order Shipped</span>
                                            @elseif($order->status == 3)
                                                <span class="badge rounded-pill text-white bg-success custom-badge">Order Done</span>
                                            @elseif($order->status == 4)
                                                <span class="badge rounded-pill text-white bg-warning custom-badge">Order Return</span>
                                            @elseif($order->status == 5)
                                                <span class="badge rounded-pill text-white bg-danger custom-badge">Order Cancel</span>
                                            @endif

                                            {{-- <span class="badge rounded-pill text-white bg-success custom-badge">Shipped</span> --}}
                                        </td>
                                        <td>
                                            <ul class="action_list">
                                                <li style="background: #0078FF;">
                                                    <a href="">
                                                        <i class="fa fa-eye text-theme"></i>
                                                    </a> 
                                                </li>
                                                <li style="background: #157347;">
                                                    <a href=""><i class="far fa-edit"></i></a> 
                                                </li>
                                                <li style="background: #BB2D3B;">
                                                    <span data-toggle="modal" data-target="#order{{ $order->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </span> 
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>


                                    <!-- Modal start -->
                                    {{-- <div class="modal fade" id="order{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    
                                                    <a href="{{ route('product.destroy', $product->id) }}" class="btn btn-primary">Confirm</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- Modal end -->
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
