@extends('backend.layout.template')

@section('page-titles')
    <title>Website Setting | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Website Setting</li>
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
                <h5 class="card-header">Website Setting</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('website.update', $web_setting->id) }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <select class="form-control" id="currency" name="currency">
                                            <option value="" selected disabled="">Select the currency</option>
                                            <option value="৳" @if($web_setting->currency == '৳') selected @endif>BDT</option>
                                            <option value="$" @if($web_setting->currency == "$") selected @endif>Dollar</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="phone_one" class="col-form-label">Phone One</label>
                                    <input id="phone_one" type="text" value="{{ $web_setting->phone_one }}" name="phone_one" class="form-control" required autocomplete="off" placeholder="Phone One">
                                </div>

                                <div class="form-group">
                                    <label for="phone_two" class="col-form-label">Phone Two</label>
                                    <input id="phone_two" type="text" value="{{ $web_setting->phone_two }}" name="phone_two" class="form-control" required autocomplete="off" placeholder="Phone Two">
                                </div>
                            </div>
    
                            <div class="col-lg-6">        
                                <div class="form-group">
                                    <label for="mail_email" class="col-form-label">Mail Email</label>
                                    <input id="mail_email" type="text" value="{{ $web_setting->mail_email }}" name="mail_email" class="form-control" required autocomplete="off" placeholder="Mail Email">
                                </div>

                                <div class="form-group">
                                    <label for="support_email" class="col-form-label">Support Email</label>
                                    <input id="support_email" type="text" value="{{ $web_setting->support_email }}" name="support_email" class="form-control" required autocomplete="off" placeholder="Meta Author">
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-form-label">Address</label>
                                    <input id="address" type="text" value="{{ $web_setting->address }}" name="address" class="form-control" required autocomplete="off" placeholder="Address">
                                </div>
                            </div>
                        </div>

                        <span style="color: green">-- Favicon & Logo --</span>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Website Logo</label>
                                    <input class="form-control" type="file" name="logo" id="logo" value="{{ $web_setting->logo }}">
                                    <input type="hidden" name="old_logo" value="{{ $web_setting->logo }}" style="display: none;">
                                    <img src="{{ asset('backend/uploads/website_setting/' . $web_setting->logo) }}" alt="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    <input class="form-control" type="file" name="favicon" id="favicon" value="{{ $web_setting->favicon }}">
                                    {{-- <input type="file" name="old_favicon" value="{{ $web_setting->favicon }}" style="display: none;"> --}}
                                    <img src="{{ asset('backend/uploads/website_setting/' . $web_setting->favicon) }}" alt="">
                                </div>
                            </div>
                        </div>

                        <span style="color: green">-- Others --</span>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="facebook" class="col-form-label">Facebook</label>
                                    <input id="facebook" type="text" value="{{ $web_setting->facebook }}" name="facebook" class="form-control" autocomplete="off" placeholder="Facebook link">
                                </div>
        
                                <div class="form-group">
                                    <label for="twitter" class="col-form-label">Twitter</label>
                                    <input id="twitter" type="text" value="{{ $web_setting->twitter }}" name="twitter" class="form-control" autocomplete="off" placeholder="Twitter link">
                                </div>

                                <div class="form-group">
                                    <label for="youtube" class="col-form-label">Youtube</label>
                                    <input id="youtube" type="text" value="{{ $web_setting->youtube }}" name="youtube" class="form-control" autocomplete="off" placeholder="Youtube Link">
                                </div>
                            </div>
    
                            <div class="col-lg-6">        
                                <div class="form-group">
                                    <label for="instagram" class="col-form-label">Instagram</label>
                                    <input id="instagram" type="text" value="{{ $web_setting->instagram }}" name="instagram" class="form-control" autocomplete="off" placeholder="Instagram link">
                                </div>

                                <div class="form-group">
                                    <label for="linkedin" class="col-form-label">Linkedin</label>
                                    <input id="linkedin" type="text" value="{{ $web_setting->linkedin }}" name="linkedin" class="form-control" autocomplete="off" placeholder="Linkedin link">
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection