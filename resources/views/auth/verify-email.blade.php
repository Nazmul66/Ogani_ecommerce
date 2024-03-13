@extends('frontend.layout.template')

@section('page-title')
   <title>Verify Email | Ecommerce</title>
@endsection

@section('body-content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Email Verify</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('homePage') }}">Home</a>
                            <span>Email Verify</span>
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
                        <p>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>

                        @if (session('status') == 'verification-link-sent')
                            <p>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
                        @endif

                        <div class="authenticate_verify">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                    
                                <button type="submit" class="btn btn-success mb-3">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </form>
                    
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                    
                                <button type="submit" class="btn btn-dark mb-3">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
