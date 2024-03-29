
@php
    $page_one = App\Models\Page::where('page_position', 1)->get();
    $page_two = App\Models\Page::where('page_position', 2)->get();
@endphp

    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: {{ $setting->address }}</li>
                            <li>Phone: {{ $setting->phone_one }}</li>
                            <li>Email: {{ $setting->mail_email }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            @foreach ($page_one as $pageOne)
                               <li><a href="{{ route($pageOne->page_url) }}">{{ $pageOne->page_name }}</a></li>
                            @endforeach
                        </ul>
                        <ul>
                            @foreach ($page_two as $pagTwo)
                               <li><a href="#">{{ $pagTwo->page_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                            <form action="{{ route('store.newsletter') }}" method="post">
                                @csrf
                                <input type="email" name="email" placeholder="Enter your mail">
                                <button type="submit" class="site-btn">Subscribe</button>
                            </form>
                        <div class="footer__widget__social">
                            <a href="{{ $setting->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
