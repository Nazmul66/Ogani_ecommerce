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
                    <h2>Customer Profile</h2>
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

<!-- personal deatail section start -->
<section class="contact-page register-page customer_profile">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>PERSONAL DETAIL</h3>
                <form class="theme-form" method="POST" action="{{ route("user.info", Auth::id()) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row row">
                        <div class="col-md-4">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" name="name" 
                            @if ( !is_null($usersData->name) )
                               value="{{ $usersData->name }}" 
                            @else
                               value="{{ old('name') }}" 
                            @endif
                            id="name" placeholder="Enter Your name"
                                required="">
                        </div>

                        <div class="col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" disabled id="email" placeholder="Email" required="">
                        </div>

                        <div class="col-md-4">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" name="phone"
                            @if ( !is_null($usersData->phone) )
                                value="{{ $usersData->phone }}" 
                            @else
                                value="{{ old('phone') }}" 
                            @endif
                             id="phone" placeholder="Enter your number"
                                required="">
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Profile Images*</label>

                                <label class="file_div" for="fileUploader">  
                                    <img src="{{ asset('backend/uploads/Upload_icon.png') }}" alt="Upload_icon" class="img_upload">
                                    <h3>Upload Files Here or <span>Browse</span></h3>
                                    <p>Supported formates: JPEG, PNG, JPG</p>
                                    @if (!is_null($usersData->image))
                                        <figcaption class="file_name">{{ $usersData->image }}</figcaption>
                                    @else
                                        <figcaption class="file_name d-none"></figcaption>
                                    @endif
                                </label>
                                <input type="file" name="image" accept=".jpg, .png, .jpeg" class="d-none" id="fileUploader">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-solid" type="submit">Save setting</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

<!-- address section start -->
<section class="contact-page register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>SHIPPING ADDRESS</h3>
                <form class="theme-form" method="POST" action="{{ route("user.shippingInfo", Auth::id()) }}">
                    @csrf

                    <div class="form-row row">
                        <div class="col-md-4">
                            <label>Address Line 1*</label>
                            <input type="text" class="form-control" name="address_Line1"
                            @if ( !is_null($usersData->address_Line1) )
                               value="{{ $usersData->address_Line1 }}" 
                            @else
                               value="{{ old('address_Line1') }}" 
                            @endif
                             placeholder="Address Line 1"
                                required="" >
                        </div>

                        <div class="col-md-4">
                            <label for="name">Address Line 2*</label>
                            <input type="text" class="form-control" name="address_Line2"
                            @if ( !is_null($usersData->address_Line2) )
                               value="{{ $usersData->address_Line2 }}" 
                            @else
                               value="{{ old('address_Line2') }}" 
                            @endif
                            placeholder="Address Line 2">
                        </div>

                        <div class="col-md-4">
                            <label for="email">Division *</label>
                            <select class="custom_select_form" name="division_id" style="height: 56px;">
                                <option value="" disabled selected>select this division</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="email">District *</label>
                            <select class="custom_select_form" name="district_id" style="height: 56px;">
                                <option value="" disabled selected>select this state/division</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="review">City *</label>
                            <select class="custom_select_form" name="city_id" style="height: 56px;">
                                <option value="" disabled selected>select this city</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="email">Zip Code *</label>
                            <input type="text" class="form-control" name="zipCode"
                            @if ( !is_null($usersData->zipCode) )
                               value="{{ $usersData->zipCode }}" 
                            @else
                               value="{{ old('zipCode') }}" 
                            @endif
                             id="zip-code" placeholder="zip-code"
                                required="">
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-sm btn-solid" type="submit">Save setting</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

@endsection


@section('scripts')
    <script>
          // file upload function
    const fileUploader = document.querySelector('#fileUploader');
    const fileNameElement = document.querySelector('.file_name');

    fileUploader.addEventListener('change', (e) => {
        const fileName = e.target.files[0].name;
        console.log(e.target.files[0]);
        fileNameElement.textContent = fileName;
        fileNameElement.classList.remove('d-none');
    });
    </script>
@endsection

