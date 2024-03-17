@extends('frontend.layout.template')

@section('page-title')
   <title>Customer Dashboard | Template</title>
@endsection

@section('body-content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Customer Dashboard</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('homePage') }}">Home</a>	
                        <span>Customer Dashboard</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!--  dashboard section start -->
<section class="dashboard-section section-b-space user-dashboard-section">
   <div class="container">
       <div class="row">
        
        @include('frontend.pages.component.customer-sidebar')

           <div class="col-lg-9">
            
               <div class="faq-content tab-content" id="top-tabContent">

                   {{-- Account Info --}}
                   <div class="tab-pane fade show active" id="info">
                       <div class="counter-section">
                           <div class="welcome-msg">
                               <h4>Hello, @if ( Auth::check() ) {{ Auth::user()->name }} @endif !</h4>
                               <p>From your My Account Dashboard you have the ability to view a snapshot of your
                                   recent
                                   account activity and update your account information. Select a link below to
                                   view or
                                   edit information.</p>
                           </div>
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="counter-box">
                                       <img src="{{ asset('frontend/img/sale.png') }}" class="img-fluid">
                                       <div>
                                           <h3>25</h3>
                                           <h5>Total Order</h5>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="counter-box">
                                       <img src="{{ asset('frontend/img/homework.png') }}" class="img-fluid">
                                       <div>
                                           <h3>5</h3>
                                           <h5>Pending Orders</h5>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="counter-box">
                                       <img src="{{ asset('frontend/img/order.png') }}" class="img-fluid">
                                       <div>
                                           <h3>50</h3>
                                           <h5>Wishlist</h5>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="box-account box-info">
                               <div class="box-head">
                                   <h4>Account Information</h4>
                               </div>
                               <div class="row">
                                   <div class="col-sm-6">
                                       <div class="box">
                                           <div class="box-title">
                                               <h3>Contact Information</h3><a href="#">Edit</a>
                                           </div>
                                           <div class="box-content">
                                               <h6>@if ( Auth::check() ) {{ Auth::user()->name }} @endif</h6>
                                               <h6>@if ( Auth::check() ) {{ Auth::user()->email }} @endif</h6>
                                               <h6><a href="{{ route('password.email') }}">Change Password</a></h6>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-sm-6">
                                       <div class="box">
                                           <div class="box-title">
                                               <h3>Newsletters</h3><a href="#">Edit</a>
                                           </div>
                                           <div class="box-content">
                                               <p>You are currently not subscribed to any newsletter.</p>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="box mt-3">
                                   <div class="box-title">
                                       <h3>Address Book</h3><a href="#">Manage Addresses</a>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-6">
                                           <h6>Default Billing Address</h6>
                                           <address>@if ( Auth::check() ) {{ Auth::user()->address_Line1 }} - {{ Auth::user()->zipCode }} @endif<br><a href="{{ route('customer.profile') }}">Edit
                                                   Address</a></address>
                                       </div>
                                       <div class="col-sm-6">
                                           <h6>Default Shipping Address</h6>
                                           <address>@if ( Auth::check() ) {{ Auth::user()->address_Line2 }} - {{ Auth::user()->zipCode }} @endif<br><a
                                                   href="{{ route('customer.profile') }}">Edit Address</a></address>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   {{-- My order pages --}}
                   <div class="tab-pane fade" id="orders">
                       <div class="row">
                           <div class="col-12">
                               <div class="card dashboard-table mt-0">
                                   <div class="card-body table-responsive-sm">
                                       <div class="alert alert-secondary" role="alert">
                                          My Orders
                                       </div>

                                      <div class="all_order_Status">
                                            <div class="orders">
                                                <h5 style="color: #529575;">Total Order</h5>
                                                <span>{{ $total_order }}</span>
                                            </div>

                                            <div class="orders">
                                                <h5 style="color: #529575;">Complete Order</h5>
                                                <span>{{ $complete_order }}</span>
                                            </div>

                                            <div class="orders">
                                                <h5 style="color: #dd0000;">Cancel Order</h5>
                                                <span>{{ $cancel_order }}</span>
                                            </div>

                                            <div class="orders">
                                                <h5 style="color: #F5C65E;">Return Order</h5>
                                                <span>{{ $return_order }}</span>
                                            </div>
                                      </div>

                                       <div class="table-responsive-xl">
                                           <table class="table cart-table order-table">
                                               <thead>
                                                   <tr class="table-head">
                                                       <th scope="col">#SL.</th>
                                                       <th scope="col">Transaction Id</th>
                                                       <th scope="col">Date</th>
                                                       <th scope="col">Total</th>
                                                       <th scope="col">Payment Type</th>
                                                       <th scope="col">Status</th>
                                                       <th scope="col">View</th>
                                                   </tr>
                                               </thead>
                                               <tbody>

                                                 @foreach ($orders as $index => $row)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <span class="mt-0 td_ash">#{{ $row->transaction_id }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fs-6 td_ash">{{ $row->date }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fs-6 td_ash">{{ $row->total }} {{ $setting->currency }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fs-6 td_ash">{{ $row->payment_type }}</span>
                                                        </td>
                                                        <td>
                                                            @if ( $row->status == 0 )
                                                                <span class="badge rounded-pill text-white bg-secondary custom-badge">Order Pending</span>
                                                            @elseif($row->status == 1)
                                                                <span class="badge rounded-pill text-white bg-info custom-badge">Order Received</span>
                                                            @elseif($row->status == 2)
                                                                <span class="badge rounded-pill text-white bg-primary custom-badge">Order Shipped</span>
                                                            @elseif($row->status == 3)
                                                                <span class="badge rounded-pill text-white bg-success custom-badge">Order Done</span>
                                                            @elseif($row->status == 4)
                                                                <span class="badge rounded-pill text-white bg-warning custom-badge">Order Return</span>
                                                            @elseif($row->status == 5)
                                                                <span class="badge rounded-pill text-white bg-danger custom-badge">Order Cancel</span>
                                                            @endif

                                                            {{-- <span class="badge rounded-pill text-white bg-success custom-badge">Shipped</span> --}}
                                                        </td>
                                                        <td>
                                                            {{-- <a href="" class="btn_action">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a> --}}
                                                            <a href="{{ route('customer.invoice', $row->transaction_id) }}" class="btn_action">
                                                                <i class="fa fa-eye text-theme"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                 @endforeach
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   {{-- my wishlist pages --}}
                   <div class="tab-pane fade" id="wishlist">
                       <div class="row">
                           <div class="col-12">
                               <div class="card dashboard-table mt-0">
                                   <div class="card-body table-responsive-sm">
                                       <div class="top-sec">
                                           <h3>My Wishlist</h3>
                                       </div>
                                       <div class="table-responsive-xl">
                                            @if ( $wishlists->count() === 0 )
                                                <div class="alert alert-danger text-center" role="alert">
                                                    There is no wishlists data available right now!
                                                </div>
                                            @else
                                                <table class="table cart-table wishlist-table">
                                                    <thead>
                                                        <tr class="table-head">
                                                            <th scope="col">image</th>
                                                            <th scope="col">Product Name</th>
                                                            <th scope="col">Product Details</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($wishlists as $wishlist)
                                                           @php
                                                              $products  =  App\Models\Product::where('id', $wishlist->product_id)->get();
                                                           @endphp

                                                           @foreach ($products as $product)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('productDetails', $product->slug ) }}">
                                                                        <img src="{{ asset('backend/uploads/products/' . $product->thumbnail) }}"
                                                                            class="blur-up lazyloaded" alt="">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <span class="mt-0">{{ $product->product_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ Str::substr(strip_tags($product->description), 0, 40) }}.....</span>
                                                                </td>
                                                                <td>
                                                                    <span class="theme-color fs-6">
                                                                        @if ( $product->discount_price )
                                                                          {{ $setting->currency }}{{ $product->discount_price }}
                                                                        @else
                                                                           {{ $setting->currency }}{{ $product->selling_price }}
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('productDetails', $product->slug ) }}"
                                                                        class="btn btn-xs btn-solid">
                                                                        Move to Cart
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                           @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   
                   {{-- my review pages --}}
                   <div class="tab-pane fade" id="review">
                        <div class="row">
                            <div class="col-12">
                                <div class="card dashboard-table mt-0">
                                    <div class="card-body table-responsive-sm">
                                        <div class="top-sec">
                                            <h3>Write your valuable review based on our product quality and services</h3>
                                        </div>

                                        <div class="table-responsive-xl">
                                            <form action="{{ route('write.review') }}" method="POST">

                                                @csrf

                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    <input type="text" name="name" class="form-control" readonly value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Write Review</label>
                                                    <textarea class="form-control" name="review" rows="4" required autocomplete="off"></textarea>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <span style="margin-right: 20px;">Select Review star</span>
                                                    <select class="form-select" aria-label="Default select example" name="rating">
                                                        <option selected>Select your Review</option>
                                                        <option value="1">1 star</option>
                                                        <option value="2">2 star</option>
                                                        <option value="3">3 star</option>
                                                        <option value="4">4 star</option>
                                                        <option value="5">5 star</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>

                    {{-- my ticket pages --}}
                   <div class="tab-pane fade" id="ticket">
                       <div class="row">
                           <div class="col-12">
                               <div class="card dashboard-table mt-0">
                                   <div class="card-body table-responsive-sm">
                                       <div class="alert alert-secondary d-flex align-items-center justify-content-between" role="alert">
                                          All Tickets
                                          <button class="btn btn-primary" data-toggle="modal" data-target="#openTicket">Open Ticket</button>

                                          <!-- Modal for open ticket -->
                                            <div class="modal fade" id="openTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header mb-3">
                                                            <h5>Submit your ticket, We will reply</h5>

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('store.ticket') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Subject</label>
                                                                    <input type="text" name="subject" class="form-control" required>
                                                                </div>
    
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <label>Priority *</label>
                                                                        <select class="custom_select_form" name="priority" style="height: 56px;">
                                                                            <option value="Low" selected>Low</option>
                                                                            <option value="Medium">Medium</option>
                                                                            <option value="High">High</option>
                                                                        </select>
                                                                    </div>
    
                                                                    <div class="col-lg-6">
                                                                        <label>service *</label>
                                                                        <select class="custom_select_form" name="service" style="height: 56px;">
                                                                            <option value="Technical" selected>Technical</option>
                                                                            <option value="Payment">Payment</option>
                                                                            <option value="Affiliate">Affiliate</option>
                                                                            <option value="Refund">Refund</option>
                                                                            <option value="Return">Return</option>
                                                                        </select>
                                                                    </div>
    
                                                                    <div class="col-lg-12 mt-3">
                                                                        <div class="form-group">
                                                                            <label for="message">Message</label>
                                                                            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="file">image</label>
                                                                            <input type="file" name="image" class="form-control" id="file">
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-lg-12">
                                                                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                       </div>

                                       {{-- table for ticket --}}
                                       <div class="table-responsive-xl">
                                            <table class="table cart-table order-table">
                                                <thead>
                                                    <tr class="table-head">
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Service</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($tickets as $index => $row)
                                                    <tr>
                                                        <td>
                                                            <span class="mt-0 td_ash">{{ $row->date }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fs-6 td_ash">{{ $row->service }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fs-6 td_ash">{{ $row->subject }} {{ $setting->currency }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fs-6 td_ash">
                                                                @if ( $row->status == 0 )
                                                                   <span class="badge badge-danger">Pending</span>
                                                                @elseif ( $row->status == 1 )
                                                                   <span class="badge badge-success">Replied</span>
                                                                @elseif ( $row->status == 2 )
                                                                   <span class="badge badge-warning">Muted</span>
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td class="d-flex justify-content-center align-items-center">
                                                            <a href="{{ route('show.ticket', $row->id ) }}" class="btn_action" data-toggle="modal" data-target="#showTicket{{ $row->id }}">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="" class="btn_action">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="showTicket{{ $row->id }}" tabindex="-1" aria-labelledby="showTicket" aria-hidden="true">
                                                        @php
                                                           $ticket = App\Models\Ticket::where('id', $row->id)->first();    
                                                        @endphp
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header mb-3">
                                                                    <h5>Submit your ticket, We will reply</h5>

                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="alert alert-secondary" role="alert">
                                                                    Reply message
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form method="POST" action="{{ route('store.ticket') }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-lg-12 mt-3">
                                                                                <div class="form-group">
                                                                                    <label for="message">Message</label>
                                                                                    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
            
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label for="file">image</label>
                                                                                    <input type="file" name="image" class="form-control" id="file">
                                                                                </div>
                                                                            </div>
            
                                                                            <div class="col-lg-12">
                                                                                <button type="submit" class="btn btn-primary">Submit Ticket</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                             </tbody>
                                          </table>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   {{-- my profile pages --}}
                   <div class="tab-pane fade" id="profile">
                       <div class="row">
                           <div class="col-12">
                               <div class="card mt-0">
                                   <div class="card-body">
                                       <div class="dashboard-box">
                                           <div class="dashboard-title">
                                               <h4>profile</h4>
                                               <a class="edit-link" href="#">edit</a>
                                           </div>
                                           <div class="dashboard-detail">
                                               <ul>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Customer Name</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->name }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Email Address</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->email }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Phone Number</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->phone }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Address</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->address_Line1 }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Address (optional)</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->address_Line2 }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Division</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->division_id }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                    <li>
                                                        <div class="details">
                                                            <div class="left">
                                                                <h6>District</h6>
                                                            </div>
                                                            <div class="right">
                                                                <h6>@if ( Auth::check() ) {{ Auth::user()->district_id }} @endif</h6>
                                                            </div>
                                                        </div>
                                                    </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>city/state</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->country_id }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>

                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>zip</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->zipCode }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                               </ul>
                                           </div>
                                           <div class="dashboard-title mt-lg-5 mt-3">
                                               <h4>login details</h4>
                                           </div>
                                           <div class="dashboard-detail">
                                               <ul>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Email Address</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->email }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Phone No.</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>@if ( Auth::check() ) {{ Auth::user()->phone }} @endif</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Password</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>******* <a class="edit-link" href="{{ route('password.email') }}">Edit</a>
                                                               </h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

               </div>
           </div>
       </div>
   </div>
</section>
<!--  dashboard section end -->

@endsection