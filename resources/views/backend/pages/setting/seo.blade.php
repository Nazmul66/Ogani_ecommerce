@extends('backend.layout.template')

@section('page-titles')
    <title>SEO Setting | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SEO Setting</li>
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
                <h5 class="card-header">SEO Setting</h5>
                  <div class="card-body">
                    <form method="POST" action="{{ route('seo.update', $seo->id) }}" >

                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meta_title" class="col-form-label">Meta Title</label>
                                    <input id="meta_title" type="text" value="{{ $seo->meta_title }}" name="meta_title" class="form-control" required autocomplete="off" placeholder="Meta Title">
                                </div>
        
                                <div class="form-group">
                                    <label for="meta_author" class="col-form-label">Meta Author</label>
                                    <input id="meta_author" type="text" value="{{ $seo->meta_author }}" name="meta_author" class="form-control" required autocomplete="off" placeholder="Meta Author">
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meta_tag" class="col-form-label">Meta Tag</label>
                                    <input id="meta_tag" type="text" value="{{ $seo->meta_tag }}" name="meta_tag" class="form-control" required autocomplete="off" placeholder="Meta Tag">
                                </div>
        
                                <div class="form-group">
                                    <label for="meta_keyword" class="col-form-label">Meta Keyword</label>
                                    <input id="meta_keyword" type="text" value="{{ $seo->meta_keyword }}" name="meta_keyword" class="form-control" required autocomplete="off" placeholder="Meta Keyword">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_des" class="col-form-label">Meta Description</label>
                            <textarea id="meta_des" name="meta_des" class="form-control" required placeholder="Meta Description">{{ $seo->meta_description }}</textarea>
                        </div>

                        <span style="color: green">-- others --</span>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_verification" class="col-form-label">Google Verification</label>
                                    <input id="google_verification" type="text" value="{{ $seo->google_verification }}" name="google_verification" class="form-control" autocomplete="off" placeholder="Google Verification">
                                </div>
        
                                <div class="form-group">
                                    <label for="google_analytics" class="col-form-label">Google Analytics</label>
                                    <input id="google_analytics" type="text" value="{{ $seo->google_analytics }}" name="google_analytics" class="form-control" autocomplete="off" placeholder="Google Analytics">
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alexa_verification" class="col-form-label">Alexa Verification</label>
                                    <input id="alexa_verification" type="text" value="{{ $seo->alexa_verification }}" name="alexa_verification" class="form-control" autocomplete="off" placeholder="Alexa Verification">
                                </div>
        
                                <div class="form-group">
                                    <label for="google_adsense" class="col-form-label">Google Adsense</label>
                                    <input id="google_adsense" type="text" value="{{ $seo->google_adsense }}" name="google_adsense" class="form-control" autocomplete="off" placeholder="Google Adsense">
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