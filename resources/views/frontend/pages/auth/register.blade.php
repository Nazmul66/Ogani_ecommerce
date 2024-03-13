@extends('frontend.layout.template')

@section('page-title')
   <title>Register | Ecommerce</title>
@endsection

@section('body-content')

{{-- Breadcum section start --}}
   <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}" style="background-image: url(&quot;http://127.0.0.1:8000/frontend/img/breadcrumb.jpg&quot;);">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
                  <div class="breadcrumb__text">
                     <h2>Register Pages</h2>
                     <div class="breadcrumb__option">
                        <a href="{{ route('homePage') }}">Home</a>	
                        <span>Register Page</span>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </section>
{{-- Breadcum section end --}}


{{-- Register section start --}}
  <section class="login__section">
     <div class="login__form__box">
         <h3>Create Account</h3>

         <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="name" class="input__field" placeholder="Full Name" value="{{ old('name') }}" required="required" autofocus autocomplete="off">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
             </div>

            <div class="form-group">
               <input type="email" name="email" class="input__field" placeholder="Email" value="{{ old('email') }}" required="required" autocomplete="off">
               <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
               <input type="password" name="password" class="input__field" placeholder="Password" required="required" autocomplete="off">
               <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" class="input__field" placeholder="Confirm Password" required="required" autocomplete="off">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
             </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form_check_label">Accept all terms & Conditions</label>
            </div>

            <button type="submit" class="register__btn mb-3">Create Account</button>

            <p class="form_check_label text-center">Already have account <a href="{{ route('login') }}" class="anchor_link">Login</a></p>
        </form>
     </div>
  </section>
{{-- Register section end --}}

@endsection