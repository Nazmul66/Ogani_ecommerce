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
                <div class="card-header">
                    <h5 class="mb-0">Manage Order</h5>
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
                                <th scope="col">SubTotal({{ $setting->currency }})</th>
                                <th scope="col">Total({{ $setting->currency }})</th>
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
                                        </td>
                                        <td>
                                            <ul class="action_list">
                                                <li style="background: #157347;">
                                                    <a href="{{ route('order.edit', $order->id) }}"><i class="far fa-edit"></i></a> 
                                                </li>
                                                <li style="background: #BB2D3B;">
                                                    <span data-toggle="modal" data-target="#order{{ $order->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </span> 
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

