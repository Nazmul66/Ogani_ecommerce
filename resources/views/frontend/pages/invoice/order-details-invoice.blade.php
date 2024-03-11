
@extends('frontend.layout.template')

@section('page-title')
   <title>Customer Invoice Page | Template</title>
@endsection

@section('body-content')

<section class="theme-invoice-1 section-b-space">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 m-auto">
          <div class="invoice-wrapper">
            <div class="invoice-header">
              <div class="upper-icon">
                <img src="{{ asset('frontend/img/invoice.svg') }}" class="img-fluid" alt="">
              </div>
              <div class="row header-content">
                <div class="col-md-6">
                    <img src="{{ asset('backend/uploads/website_setting/' . $setting->logo) }}" class="img-fluid" alt="">
                    <div class="mt-md-4 mt-3">
                    <h4 class="mb-2">
                      Multikart Demo Store india - 363512
                    </h4>
                    <h4 class="mb-0">{{ $setting->support_email }}</h4>
                  </div>
                </div>
                <div class="col-md-6 text-md-end mt-md-0 mt-4">
                  <h2>invoice</h2>
                  <div class="mt-md-4 mt-3">
                    <h4 class="mb-2">
                       {{ $order_details->c_address }}
                    </h4>
                    <h4 class="mb-0">{{ $order_details->c_country }}, {{ $order_details->c_zipCode }}</h4>
                  </div>
                </div>
              </div>
              <div class="detail-bottom">
                <ul>
                  <li><span>issue date :</span><h4>{{ $order_details->date }}</h4></li>
                  <li><span>invoice no :</span><h4>#{{ $order_details->transaction_id }}</h4></li>
                  <li><span>email :</span><h4>{{ $order_details->c_email }}</h4></li>
                </ul>
              </div>
            </div>
            <div class="invoice-body table-responsive-md">
              <table class="table table-borderless mb-0">
                <thead>
                    <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">description</th>
                        <th scope="col">price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">total</th>
                    </tr>
                </thead>

                <tbody>
                   @foreach ($carts as $row => $cart)
                      @foreach (App\Models\Product::where('id', $cart->product_id)->get() as $items)
                        <tr>
                          <th scope="row">{{ $row + 1 }}</th>
                          <td>{{ $items->product_name }}</td>
                          <td>
                            @if ($items->discount_price)
                                {{ $setting->currency }}{{ $items->discount_price }}
                            @else
                                {{ $setting->currency }}{{ $items->selling_price }}
                            @endif
                          </td>
                          <td>{{ $cart->product_qty }}</td>
                          <td>
                            @if ($items->discount_price)
                                {{ $setting->currency }}{{ $items->discount_price * $cart->product_qty }}
                            @else
                               {{ $setting->currency }}{{ $items->selling_price * $cart->product_qty }}
                            @endif
                          </td>
                      </tr>
                      @endforeach
                   @endforeach
                </tbody>
                
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td class="font-bold text-dark" colspan="2">Sub Total</td>
                        <td class="font-bold text-theme">{{ $setting->currency }}{{ $order_details->subtotal }}</td>
                    </tr>
                    <tr>
                      <td colspan="2"></td>
                      <td class="font-bold text-dark" colspan="2">- Coupon Code (%)</td>
                      <td class="font-bold text-theme">
                         @if ( $order_details->coupon_discount )
                         {{ $setting->currency }}{{ $order_details->coupon_discount }}
                          @else
                          {{ $setting->currency }}0
                         @endif
                      </td>
                  </tr>
                  <tr>
                     <td colspan="2"></td>
                     <td class="font-bold text-dark" colspan="2">- Tax (%)</td>
                     <td class="font-bold text-theme">{{ $setting->currency }}{{ $order_details->tax }}</td>
                  </tr>
                  <tr>
                     <td colspan="2"></td>
                     <td class="font-bold text-dark" colspan="2">- Shipping Charge (%)</td>
                     <td class="font-bold text-theme">{{ $setting->currency }}{{ $order_details->shipping_charge }}</td>
                  </tr>
                  <tr class="Grand_total">
                    <td colspan="2"></td>
                    <td class="font-bold text-dark" colspan="2">Grand Total</td>
                    <td class="font-bold text-theme">{{ $setting->currency }}{{ $order_details->total }}</td>
                 </tr>
                </tfoot>
              </table>
            </div>

            <div class="invoice-footer text-end">
              <div class="buttons">
                <a href="#" class="btn black-btn btn-solid rounded-2 me-2" onclick="window.print();">export as PDF</a>
                <a href="#" class="btn btn-solid rounded-2" onclick="window.print();">print</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection