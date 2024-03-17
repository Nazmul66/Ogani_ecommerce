<div class="col-lg-3">
    <div class="dashboard-sidebar">
        <div class="profile-top">
            <div class="profile-image">
                   @if ( Auth::check() )
                     <img src="{{ asset('frontend/img/customer-images/' . Auth::user()->image) }}" alt="" class="img-fluid">
                   @else
                     <img src="{{ asset('frontend/img/avtar.jpg') }}" alt="" class="img-fluid">
                   @endif
            </div>
            <div class="profile-detail">
                <h5>
                   @if ( Auth::check() )
                       {{ Auth::user()->name }}
                   @else
                     Customer Name
                   @endif
                </h5>
                <h6>
                   @if ( Auth::check() )
                       {{ Auth::user()->email }}
                   @else
                     customer@gmail.com
                   @endif
                </h6>
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
                <li class="nav-item"><a data-toggle="tab" data-target="#ticket"
                        class="nav-link">Open Ticket</a></li>
                <li class="nav-item"><a data-toggle="tab" data-target="#profile"
                        class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="" class="nav-link">Log Out</a> </li>
            </ul>
        </div>
    </div>
</div>