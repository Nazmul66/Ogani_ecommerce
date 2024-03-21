@extends('backend.layout.template')

@section('page-titles')
    <title>Order Status | Admin Dashboard </title>
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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Customer Details -->
                <div class="col-lg-4">
                    <div class="information-box">
                        <h5 class="mb-3">Customer Details</h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody class="table-light">
                                    <tr>
                                        <th>Full Name</th>
                                        <th>{{ $order->c_name }}</th>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <th>{{ $order->c_email }}</th>
                                    </tr>

                                    <tr>
                                        <th>Phone</th>
                                        <th>{{ $order->c_phone }}</th>
                                    </tr>

                                    <tr>
                                        <th>Address</th>
                                        <th>{{ $order->c_address }}</th>
                                    </tr>

                                    <tr>
                                        <th>State / Division</th>
                                        <th>
                                           
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>District</th>
                                        <th>
                                           
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Country</th>
                                        <th>
                                           
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Zip Code</th>
                                        <th>{{ $order->c_zipCode }}</th>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- {{ $order-> }} --}}

                <!-- Product Details -->
                <div class="col-lg-8">
                    <div class="information-box ">
                        <h5 class="mb-3">Product Details - Payment Method
                            
                        </h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#Sl.</th>
                                        <th>Product Title</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($carts as $cart)
                                       @php
                                           $products = App\Models\Product::where('id', $cart->product_id)->get();
                                       @endphp
                                          @foreach ($products as $row => $product)
                                            <tr>
                                                <td>{{ $row + 1 }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>
                                                    @if ( $product->discount_price )
                                                        {{ $product->discount_price }}
                                                    @else
                                                       {{ $product->selling_price }}
                                                    @endif
                                                </td>
                                                <td>{{ $cart->product_qty }} {{ $product->product_unit }}</td>
                                                <td>
                                                    @if ( $product->discount_price )
                                                        {{ $product->discount_price * $cart->product_qty }} 
                                                    @else
                                                        {{ $product->selling_price * $cart->product_qty }}
                                                    @endif
                                                </td>
                                            </tr>
                                          @endforeach
                                    @endforeach
                                </tbody>

                                <tbody>
                                    <tr>
                                        <th colspan="4" style="text-align: right">Sub Total</th>
                                        <td>{{ $order->subtotal }}</td>
                                    </tr>

                                    @if ($order->coupon_code)
                                        <tr>
                                            <th colspan="4" style="text-align: right">
                                                - Counpon Discount(
                                                        {{ $order->coupon_discount }}
                                                )
                                            </th>

                                            <td>
                                                @if ($order->coupon_discount)
                                                    {{ $order->coupon_discount }}
                                                @else
                                                0
                                                @endif
                                            </td>
                                        </tr>         
                                    @endif
                                    

                                    <tr>
                                        <th colspan="4" style="text-align: right">
                                           + Tax (5%)
                                        </th>
                                        <td>{{ $order->tax }}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="4" style="text-align: right">
                                        Total Amount to be collected
                                        </th>
                                        <td>{{ $order->total }}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 25px;">
                <!-- Order Status -->
                <div class="col-lg-4">
                    <div class="information-box ">
                        <h5 class="mb-3">Order Status</h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody class="table-light">
                                    <tr>
                                        <th>Current Status</th>
                                        <th>
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
                                        </th>
                                    </tr>
                                </tbody>
                                </table>
                        </div>

                        <form method="POST" action="" class="mt-3">
                            @csrf

                            <input type="hidden" name="emailAddress" value="">
                            <div class="mb-3">
                                <label for="status">Update Status</label>
                                <select class="form-control" name="update_status" id="status">
                                    <option value="0">Order Pending</option>
                                    <option value="1">Order Received</option>
                                    <option value="2">Order Shipped</option>
                                    <option value="3">Order Done</option>
                                    <option value="4">Order Return</option>
                                    <option value="5">Order Cancel</option>
                                </select>
                            </div>

                            <input type="submit" class="btn btn-dark btn-sm" value="Update Status">
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- body content start here -->

@endsection