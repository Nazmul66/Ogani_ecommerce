@extends('frontend.layout.template')

@section('page-title')
   <title>Customer Profile | Template</title>
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
                        <span>Customer Profile</span>
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
           <div class="col-lg-3">
               <div class="dashboard-sidebar">
                   <div class="profile-top">
                       <div class="profile-image">
                           <img src="{{ asset('frontend/img/avtar.jpg') }}" alt="" class="img-fluid">
                       </div>
                       <div class="profile-detail">
                           <h5>Mark Jecno</h5>
                           <h6>mark.jecno@mail.com</h6>
                       </div>
                   </div>
                   <div class="faq-tab">
                       <ul class="nav nav-tabs" id="top-tab" role="tablist">
                           <li class="nav-item"><a data-toggle="tab" data-target="#info"
                                   class="nav-link active">Account Info</a></li>
                           <li class="nav-item"><a data-toggle="tab" data-target="#orders"
                                   class="nav-link">My Orders</a></li>
                           <li class="nav-item"><a data-toggle="tab" data-target="#wishlist"
                                   class="nav-link">My Wishlist</a></li>
                           <li class="nav-item"><a data-toggle="tab" data-target="#review"
                            class="nav-link">Write a Review</a></li>
                           <li class="nav-item"><a data-toggle="tab" data-target="#payment"
                                   class="nav-link">Saved Cards</a></li>
                           <li class="nav-item"><a data-toggle="tab" data-target="#profile"
                                   class="nav-link">Profile</a></li>
                           <li class="nav-item"><a href="" class="nav-link">Log Out</a> </li>
                       </ul>
                   </div>
               </div>
           </div>
           <div class="col-lg-9">
               <div class="faq-content tab-content" id="top-tabContent">
                   <div class="tab-pane fade show active" id="info">
                       <div class="counter-section">
                           <div class="welcome-msg">
                               <h4>Hello, MARK JECNO !</h4>
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
                                               <h6>Mark Jecno</h6>
                                               <h6>mark-jecno@gmail.com</h6>
                                               <h6><a href="#">Change Password</a></h6>
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
                                           <address>You have not set a default billing address.<br><a href="#">Edit
                                                   Address</a></address>
                                       </div>
                                       <div class="col-sm-6">
                                           <h6>Default Shipping Address</h6>
                                           <address>You have not set a default shipping address.<br><a
                                                   href="#">Edit Address</a></address>
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
                                                       <th scope="col">Order Id</th>
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
                                                            <span class="mt-0 td_ash">{{ $row->order_id }}</span>
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
                                                            <a href="" class="btn_action">
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
                                           <table class="table cart-table wishlist-table">
                                               <thead>
                                                   <tr class="table-head">
                                                       <th scope="col">image</th>
                                                       <th scope="col">Order Id</th>
                                                       <th scope="col">Product Details</th>
                                                       <th scope="col">Price</th>
                                                       <th scope="col">Action</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <tr>
                                                       <td>
                                                           <a href="javascript:void(0)">
                                                               <img src="../assets/images/pro3/1.jpg"
                                                                   class="blur-up lazyloaded" alt="">
                                                           </a>
                                                       </td>
                                                       <td>
                                                           <span class="mt-0">#125021</span>
                                                       </td>
                                                       <td>
                                                           <span>Purple polo tshirt</span>
                                                       </td>
                                                       <td>
                                                           <span class="theme-color fs-6">$49.54</span>
                                                       </td>
                                                       <td>
                                                           <a href="javascript:void(0)"
                                                               class="btn btn-xs btn-solid">
                                                               Move to Cart
                                                           </a>
                                                       </td>
                                                   </tr>

                                                   <tr>
                                                       <td>
                                                           <a href="javascript:void(0)">
                                                               <img src="../assets/images/pro3/2.jpg"
                                                                   class="blur-up lazyloaded" alt="">
                                                           </a>
                                                       </td>
                                                       <td>
                                                           <span class="mt-0">#125367</span>
                                                       </td>
                                                       <td>
                                                           <span>Sleevless white top</span>
                                                       </td>
                                                       <td>
                                                           <span class="theme-color fs-6">$49.54</span>
                                                       </td>
                                                       <td>
                                                           <a href="javascript:void(0)"
                                                               class="btn btn-xs btn-solid">
                                                               Move to Cart
                                                           </a>
                                                       </td>
                                                   </tr>

                                                   <tr>
                                                       <td>
                                                           <a href="javascript:void(0)">
                                                               <img src="../assets/images/pro3/27.jpg"
                                                                   class="blur-up lazyloaded" alt="">
                                                           </a>
                                                       </td>
                                                       <td>
                                                           <span>#125948</span>
                                                       </td>
                                                       <td>
                                                           <span>multi color polo tshirt</span>
                                                       </td>
                                                       <td>
                                                           <span class="theme-color fs-6">$49.54</span>
                                                       </td>
                                                       <td>
                                                           <a href="javascript:void(0)"
                                                               class="btn btn-xs btn-solid">
                                                               Move to Cart
                                                           </a>
                                                       </td>
                                                   </tr>

                                                   <tr>
                                                       <td>
                                                           <a href="javascript:void(0)">
                                                               <img src="../assets/images/pro3/28.jpg"
                                                                   class="blur-up lazyloaded" alt="">
                                                           </a>
                                                       </td>
                                                       <td>
                                                           <span>#127569</span>
                                                       </td>
                                                       <td>
                                                           <span>Candy red solid tshirt</span>
                                                       </td>
                                                       <td>
                                                           <span class="theme-color fs-6">$49.54</span>
                                                       </td>
                                                       <td>
                                                           <a href="javascript:void(0)"
                                                               class="btn btn-xs btn-solid">
                                                               Move to Cart
                                                           </a>
                                                       </td>
                                                   </tr>

                                                   <tr>
                                                       <td>
                                                           <a href="javascript:void(0)">
                                                               <img src="../assets/images/pro3/33.jpg"
                                                                   class="blur-up lazyloaded" alt="">
                                                           </a>
                                                       </td>
                                                       <td>
                                                           <span>#125753</span>
                                                       </td>
                                                       <td>
                                                           <span>multicolored polo tshirt</span>
                                                       </td>
                                                       <td>
                                                           <span class="theme-color fs-6">$49.54</span>
                                                       </td>
                                                       <td>
                                                           <a href="javascript:void(0)"
                                                               class="btn btn-xs btn-solid">
                                                               Move to Cart
                                                           </a>
                                                       </td>
                                                   </tr>

                                                   <tr>
                                                       <td>
                                                           <a href="javascript:void(0)">
                                                               <img src="../assets/images/pro3/34.jpg"
                                                                   class="blur-up lazyloaded" alt="">
                                                           </a>
                                                       </td>
                                                       <td>
                                                           <span>#125021</span>
                                                       </td>
                                                       <td>
                                                           <span>Men's Sweatshirt</span>
                                                       </td>
                                                       <td>
                                                           <span class="theme-color fs-6">$49.54</span>
                                                       </td>
                                                       <td>
                                                           <a href="javascript:void(0)"
                                                               class="btn btn-xs btn-solid">
                                                               Move to Cart
                                                           </a>
                                                       </td>
                                                   </tr>
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   
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

                   <div class="tab-pane fade" id="payment">
                       <div class="row">
                           <div class="col-12">
                               <div class="card mt-0">
                                   <div class="card-body">
                                       <div class="top-sec">
                                           <h3>Saved Cards</h3>
                                           <a href="#" class="btn btn-sm btn-solid">+ add new</a>
                                       </div>
                                       <div class="address-book-section">
                                           <div class="row g-4">
                                               <div class="select-box active col-xl-4 col-md-6">
                                                   <div class="address-box">
                                                       <div class="bank-logo">
                                                           <img src="../assets/images/bank-logo.png"
                                                               class="bank-logo">
                                                           <img src="../assets/images/visa.png"
                                                               class="network-logo">
                                                       </div>
                                                       <div class="card-number">
                                                           <h6>Card Number</h6>
                                                           <h5>6262 6126 2112 1515</h5>
                                                       </div>
                                                       <div class="name-validity">
                                                           <div class="left">
                                                               <h6>name on card</h6>
                                                               <h5>Mark Jecno</h5>
                                                           </div>
                                                           <div class="right">
                                                               <h6>validity</h6>
                                                               <h5>XX/XX</h5>
                                                           </div>
                                                       </div>
                                                       <div class="bottom">
                                                           <a href="javascript:void(0)"
                                                               data-target="#edit-address"
                                                               data-toggle="modal" class="bottom_btn">edit</a>
                                                           <a href="#" class="bottom_btn">remove</a>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="select-box col-xl-4 col-md-6">
                                                   <div class="address-box">
                                                       <div class="bank-logo">
                                                           <img src="../assets/images/bank-logo1.png"
                                                               class="bank-logo">
                                                           <img src="../assets/images/visa.png"
                                                               class="network-logo">
                                                       </div>
                                                       <div class="card-number">
                                                           <h6>Card Number</h6>
                                                           <h5>6262 6126 2112 1515</h5>
                                                       </div>
                                                       <div class="name-validity">
                                                           <div class="left">
                                                               <h6>name on card</h6>
                                                               <h5>Mark Jecno</h5>
                                                           </div>
                                                           <div class="right">
                                                               <h6>validity</h6>
                                                               <h5>XX/XX</h5>
                                                           </div>
                                                       </div>
                                                       <div class="bottom">
                                                           <a href="javascript:void(0)"
                                                               data-target="#edit-address"
                                                               data-toggle="modal" class="bottom_btn">edit</a>
                                                           <a href="#" class="bottom_btn">remove</a>
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
                                                               <h6>company name</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>Fashion Store</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>email address</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>mark.jecno@gmail.com</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Country / Region</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>Downers Grove, IL</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Year Established</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>2018</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Total Employees</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>101 - 200 People</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>category</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>clothing</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>street address</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>549 Sulphur Springs Road</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>city/state</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>Downers Grove, IL</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>zip</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>60515</h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                               </ul>
                                           </div>
                                           <div class="dashboard-title mt-lg-5 mt-3">
                                               <h4>login details</h4>
                                               <a class="edit-link" href="#">edit</a>
                                           </div>
                                           <div class="dashboard-detail">
                                               <ul>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Email Address</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>mark.jecno@gmail.com <a class="edit-link"
                                                                       href="#">edit</a></h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Phone No.</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>+01 4485 5454<a class="edit-link"
                                                                       href="#">Edit</a></h6>
                                                           </div>
                                                       </div>
                                                   </li>
                                                   <li>
                                                       <div class="details">
                                                           <div class="left">
                                                               <h6>Password</h6>
                                                           </div>
                                                           <div class="right">
                                                               <h6>******* <a class="edit-link" href="#">Edit</a>
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