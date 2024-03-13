@extends('frontend.layout.template')

@section('page-title')
   <title>Login | Ecommerce</title>
@endsection

@section('body-content')

{{-- Breadcum section start --}}
   <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}" style="background-image: url(&quot;http://127.0.0.1:8000/frontend/img/breadcrumb.jpg&quot;);">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
                  <div class="breadcrumb__text">
                     <h2>Login Pages</h2>
                     <div class="breadcrumb__option">
                        <a href="{{ route('homePage') }}">Home</a>	
                        <span>Login Page</span>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </section>
{{-- Breadcum section end --}}


{{-- Login section start --}}
  <section class="login__section">
     <div class="login__form__box">
         <h3>Sign In</h3>

         <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
               <input type="email" name="email" class="input__field" placeholder="Email" value="{{ old('email') }}" required="required" autofocus autocomplete="off">
               <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
               <input type="password" name="password" class="input__field" placeholder="Password" required="required" autofocus autocomplete="off">
               <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                  <label class="form_check_label">Remember Me</label>
               </div>

                  <a href="{{ route('forgot.password') }}" class="form_check_label">Forget Password</a>
            </div>

            <button type="submit" class="login__btn mb-3">Login</button>

            <p class="form_check_label text-center">Don’t have account? <a href="{{ route('register') }}" class="anchor_link">Register</a></p>
        </form>
     </div>
  </section>
{{-- Login section end --}}

@endsection