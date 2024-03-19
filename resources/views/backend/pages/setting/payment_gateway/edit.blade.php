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
                    <li class="breadcrumb-item active" aria-current="page">Payment Gateway</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- end pageheader  -->

<!-- body content start here -->
   <section class="">
      <div class="container">
        <div class="row">
            <div class="col-lg-4">
               <div class="payment_gateway card">
                  <div class="btn btn-primary text-left mb-3">
                      Aamerpay Payment Gateway
                   </div>

                   <form method="POST"
                     @if ( !is_null($aamerpay) )
                       action="{{ route('update.aamerpay', $aamerpay->id) }}"    
                     @else
                       action="{{ route('store.aamerpay') }}" 
                     @endif
                    
                    >
                        @csrf
                        <div class="form-group px-3 mb-3">
                            <label for="store_id">Store Id</label>
                            <input type="text" class="form-control" 
                            @if ( $aamerpay )
                                value="{{ $aamerpay->store_id }}"
                            @endif
                            name="store_id" id="store_id">
                        </div>

                        <div class="form-group px-3 mb-3">
                            <label for="signature_key">Signature Key</label>
                            <input type="text" class="form-control"
                            @if ( $aamerpay )
                                value="{{ $aamerpay->signature_key }}"
                            @endif
                            name="signature_key" id="signature_key">
                        </div>

                        <div class="form-group px-3 mb-1">
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status*</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected="" disabled="">Select the status</option>
                                        <option value="0" @if( $aamerpay && $aamerpay->status == 0) selected  @endif>Sandbox</option>      
                                        <option value="1" @if( $aamerpay && $aamerpay->status == 1) selected @endif>Live Server</option>      
                                    </select>
                            </div>
                            <label class="form-check-label mx-1">**Note**: (If checkbox are not checked, it working for only sandbox)</label>
                        </div>

                        <div class="px-3 mb-3">
                            @if ( !is_null($aamerpay) )
                               <button type="submit" class="btn btn-primary">Update</button>
                            @else
                               <button type="submit" class="btn btn-primary">Submit</button>
                            @endif
                            
                        </div>
                   </form>
               </div>
            </div>

            <div class="col-lg-4">
                <div class="payment_gateway card">
                    <div class="btn btn-primary text-left mb-3">
                        Surjopay Payment Gateway
                     </div>
  
                     <form method="POST"
                       {{-- @if ( !is_null($aamerpay) )
                         action="{{ route('update.aamerpay', $aamerpay->id) }}"    
                       @else
                         action="{{ route('store.aamerpay') }}" 
                       @endif --}}
                      >
                          @csrf
                          <div class="form-group px-3 mb-3">
                              <label for="store_id">Store Id</label>
                              <input type="text" class="form-control" 
                              {{-- @if ( $aamerpay )
                                  value="{{ $aamerpay->store_id }}"
                              @endif --}}
                              name="store_id" id="store_id">
                          </div>
  
                          <div class="form-group px-3 mb-3">
                              <label for="signature_key">Signature Key</label>
                              <input type="text" class="form-control"
                              {{-- @if ( $aamerpay )
                                  value="{{ $aamerpay->signature_key }}"
                              @endif --}}
                              name="signature_key" id="signature_key">
                          </div>
  
                          <div class="form-group px-3 mb-1">
                              <div class="form-group">
                                  <label for="status" class="col-form-label">Status*</label>
                                      <select class="form-control" id="status" name="status">
                                          <option value="" selected="" disabled="">Select the status</option>
                                          <option value="0" >Sandbox</option>      
                                          <option value="1" >Live Server</option>      
                                      </select>
                              </div>
                              <label class="form-check-label mx-1">**Note**: (If checkbox are not checked, it working for only sandbox)</label>
                          </div>
  
                          <div class="px-3 mb-3">
                              {{-- @if ( !is_null($aamerpay) )
                                 <button type="submit" class="btn btn-primary">Update</button>
                              @else
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              @endif --}}
                                 <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                     </form>
                 </div>
            </div>

            <div class="col-lg-4">
                <div class="payment_gateway card">
                    <div class="btn btn-primary text-left mb-3">
                        SSL_Commerzz Payment Gateway
                     </div>
  
                     <form method="POST" action="">
                          <div class="form-group px-3 mb-3">
                              <label for="store_id">Store Id</label>
                              <input type="text" class="form-control" id="store_id" aria-describedby="emailHelp">
                          </div>
  
                          <div class="form-group px-3 mb-3">
                              <label for="signature_id">Signature Key</label>
                              <input type="text" class="form-control" name="signature_key" id="signature_key" aria-describedby="emailHelp">
                          </div>
  
                          <div class="form-group px-3 mb-1">
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status*</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" selected="" disabled="">Select the status</option>
                                        <option value="0">Sandbox</option>      
                                        <option value="1">Live Server</option>      
                                    </select>
                            </div>
                            <label class="form-check-label mx-1">**Note**: (If checkbox are not checked, it working for only sandbox)</label>
                        </div>
  
                          <div class="px-3 mb-3">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                     </form>
                 </div>
            </div>
        </div>
      </div>
   </section>
<!-- body content end here  -->

@endsection