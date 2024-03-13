@extends('frontend.layout.template')

@section('page-title')
   <title>Forget Email Password | Ecommerce</title>
@endsection

@section('body-content')

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Forget Email Password</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('homePage') }}">Home</a>
                        <span>Forget Email Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<section class="verify_email">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="verify_container">
                    <p>   {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

                    @if (session('status') == 'verification-link-sent')
                        <p>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
                    @endif

                    <div class="text-center">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required autofocus>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <button type="submit" class="btn btn-success mb-3">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection