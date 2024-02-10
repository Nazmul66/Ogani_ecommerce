@extends('backend.layout.template')

@section('page-titles')
    <title>SMTP Setting | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
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
                <h5 class="card-header">SMTP Setting</h5>
                  <div class="card-body">
                    
                    <form method="POST" action="{{ route('smtp.update', $smtp->id) }}" >

                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mail_mailer" class="col-form-label">Mail Mailer</label>
                                    <input id="mail_mailer" type="text" value="{{ $smtp->mailer }}" name="mail_mailer" class="form-control" required autocomplete="off" placeholder="Mail Mailer">
                                </div>
        
                                <div class="form-group">
                                    <label for="mail_host" class="col-form-label">Mail Host</label>
                                    <input id="mail_host" type="text" value="{{ $smtp->host }}" name="mail_host" class="form-control" required autocomplete="off" placeholder="Mail Host">
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mail_port" class="col-form-label">Mail Port</label>
                                    <input id="mail_port" type="text" value="{{ $smtp->port }}" name="mail_port" class="form-control" required autocomplete="off" placeholder="Mail Port Example: 465">
                                </div>
        
                                <div class="form-group">
                                    <label for="user_name" class="col-form-label">Mail UserName</label>
                                    <input id="user_name" type="text" value="{{ $smtp->user_name }}" name="user_name" class="form-control" required autocomplete="off" placeholder="Mail UserName">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mail_password" class="col-form-label">Mail Password</label>
                            <input id="mail_password" type="password" value="{{ $smtp->password }}" name="mail_password" class="form-control" required autocomplete="off" placeholder="Mail Password">
                        </div>

                        <input type="submit" value="Submit" class="btn btn-dark" />
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- body content end here  -->

@endsection