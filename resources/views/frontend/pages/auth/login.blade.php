@extends('frontend.layout.template')

@section('page-title')
   <title>Login | Ecommerce</title>
@endsection

@section('body-content')

  <section>
     <div class="container">
        <div class="row">
            <div class="col-lg-6">
               <div style="margin-bottom: 100px;">
                   <img src="{{ asset('backend/uploads/website_setting/' . $setting->logo) }}" alt="" class="img_">
               </div>
               <h2 style="font-weight: 600; margin-bottom: 40px;">Login</h2>

               <div class="form-group">
                  <label for="inputEmail4">Email</label>
                  <input type="email" class="form-control" id="inputEmail4">
              </div>

              <div class="form-group">
                <label for="inputEmail4">Password</label>
                <input type="password" class="form-control" id="inputEmail4">
            </div>
            </div>

            <div class="col-lg-6">
               <img src="{{ asset('backend/uploads/login-pic.png') }}" alt="">
            </div>
        </div>
     </div>
  </section>

@endsection