@extends('TeeSpace.blank')
@section('header_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap"><link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_7.3.2/css/mdb.min.css"><link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/mdb-plugins-gathered.min.css">   
<style>
    a {
        text-decoration: none;
        color: #4f4f4f;
    }
    .form-outline .form-control {
    border: 1px solid rgb(126, 126, 126 , 0.2);
    border-radius: 6px;
}
</style> 
@endsection
@section('content')  
  <section class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 col-lg-8 mb-4">
            @auth('customer')
            @else
             <div class="card mb-4 border shadow-0">
                <div class="p-4 d-flex justify-content-between">
                <div class="">
                    <h5>Have an account?</h5>
                    <p class="mb-0 text-wrap ">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
                <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
                    <a href="{{ route('customer.registration') }}" class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
                    <a href="{{ route('customer.login') }}" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
                </div>
                </div>
            </div>
            @endauth
            @php
                $sub_total = 0;
                $total = 0;
            @endphp
          <!-- Checkout -->
          <form action="{{ route('billing') }}" method="POST">
            @csrf
          <div class="card shadow-0 border">
            <div class="p-4">
              <h5 class="card-title mb-3">Guest checkout</h5>
              <div class="row">
                <div class="col-6 mb-3">
                  <p class="mb-0">First name</p>
                  <div class="form-outline">
                    <input type="text" id="typeText" placeholder="Type here" class="form-control" name="fname"/>
                  </div>
                </div>
  
                <div class="col-6">
                  <p class="mb-0">Last name</p>
                  <div class="form-outline">
                    <input type="text" id="typeText" placeholder="Type here" class="form-control" name="lname"/>
                  </div>
                </div>
  
                <div class="col-6 mb-3">
                  <p class="mb-0">Phone</p>
                  <div class="form-outline">
                    <input type="tel" id="typePhone" value="+48 " class="form-control" name="phone"/>
                  </div>
                </div>
  
                <div class="col-6 mb-3">
                  <p class="mb-0">Email</p>
                  <div class="form-outline">
                    <input type="email" id="typeEmail" placeholder="example@gmail.com" class="form-control" name="email"/>
                  </div>
                </div>
              </div>
  
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                <label class="form-check-label" for="flexCheckDefault">Keep me up to date on news</label>
              </div>
  
              <hr class="my-4" />
  
              <h5 class="card-title mb-3">Shipping info</h5>
  
              <div class="row mb-3">
                <div class="col-lg-4 mb-3">
                  <!-- Default checked radio -->
                  <div class="form-check h-100 border rounded-3">
                    <div class="p-3">
                      <input class="form-check-input delivery" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked value="60"/>
                      <label class="form-check-label" for="flexRadioDefault1">
                        Express delivery <br />
                        <small class="text-muted">3-4 days via Fedex </small>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 mb-3">
                  <!-- Default radio -->
                  <div class="form-check h-100 border rounded-3">
                    <div class="p-3">
                      <input class="form-check-input delivery" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="30"/>
                      <label class="form-check-label" for="flexRadioDefault2">
                        Post office <br />
                        <small class="text-muted">20-30 days via post </small>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 mb-3">
                  <!-- Default radio -->
                  <div class="form-check h-100 border rounded-3">
                    <div class="p-3">
                      <input class="form-check-input delivery" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="0"/>
                      <label class="form-check-label" for="flexRadioDefault3">
                        Self pick-up <br />
                        <small class="text-muted">Come to our shop </small>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="row">
                <div class="col-sm-4 mb-3">
                  <p class="mb-0">Country</p>
                  <select class="form-select country" name="country">
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-4 mb-3">
                  <p class="mb-0">City</p>
                  <select class="form-select cities" name="city">
                    <option value="1">New York</option>
                    <option value="2">Moscow</option>
                    <option value="3">Samarqand</option>
                  </select>
                </div>
                <div class="col-sm-4 col-6 mb-3">
                  <p class="mb-0">company</p>
                  <div class="form-outline">
                    <input type="text" id="typeText" class="form-control" name="company"/>
                  </div>
                </div>
                
                <div class="col-sm-8 mb-3">
                  <p class="mb-0">Address</p>
                  <div class="form-outline">
                    <input type="text" id="typeText" placeholder="Type here" class="form-control" name="address"/>
                  </div>
                </div>
  
                <div class="col-sm-4 col-6 mb-3">
                  <p class="mb-0">Zip</p>
                  <div class="form-outline">
                    <input type="text" id="typeText" class="form-control" name="zip"/>
                  </div>
                </div>
              </div>
  
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault1" name="save_it" value="1"/>
                <label class="form-check-label" for="flexCheckDefault1">Save this address</label>
              </div>
  
              <div class="mb-3">
                <p class="mb-0">Message to seller</p>
                <div class="form-outline">
                  <textarea class="form-control" id="textAreaExample1" rows="2" name="massage"></textarea>
                </div>
              </div>
              <input class="discount_input" type="hidden" name="discount" value="">
              <input id="sub_total" type="hidden" name="sub_total" value="">
              <input type="hidden" name="coupon_code" value="{{ session('coupon')->unique_id ?? Null }}">
              <div class="float-end">
                <button class="btn btn-light border" type="button">Cancel</button>
                <button class="btn btn-success shadow-0 border" type="submit">Continue</button>
              </div>
            </div>
          </div>
          </form>
          <!-- Checkout -->
        </div>        
        <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
          <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
            <h6 class="mb-3">Summary</h6>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Total price:</p>
              <p class="mb-2 sub_total">${{ $sub_total }}</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Discount:</p>
              <p class="mb-2 text-danger">- @if(!session('coupon')) $00.00 @else {{ session('coupon')->coupon_type == 1 ? '$' . session('coupon')->amount : session('coupon')->amount . '%' }}@endif</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Shipping cost:</p>
              <p class="mb-2 shipping_cost">+ $60.00</p>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
              <p class="mb-2">Total price:</p>
              <p class="mb-2 fw-bold total">${{ $total }}</p>
            </div>
  
            <div class="input-group mt-3 mb-4">
              <input type="text" class="form-control border" name="" placeholder="Promo code" />
              <button class="btn btn-light text-primary border">Apply</button>
            </div>
  
            <hr />
            <h6 class="text-dark my-4">Items in cart</h6>

            @foreach ($cart as $cart)                         
            <div class="d-flex align-items-center mb-4">
                <div class="me-3 position-relative">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
                        {{ $cart->quantity }}
                    </span>
                    <img src="{{ asset('backend') }}/product/{{ $cart->rel_to_product->thumbnail }}" style="height: 96px; width: 96x;" class="img-sm rounded border" />
                </div>
                <div class="">
                    <a href="#" class="nav-link">
                        {{ $cart->rel_to_product->product_name }}
                    </a>
                      @php
                        if ($cart->material_id == 0) {
                            $price = App\Models\Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->first();
                        }else {
                            $price = App\Models\Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->where('material_id' , $cart->material_id)->first();
                        }
                        if ($price->discount) {
                            $sub_total += ($price->price - (($price->price / 100) * $price->discount)) * $cart->quantity;
                        }else {
                            $sub_total += $price->price * $cart->quantity;
                        }
                      @endphp
                    <div class="price text-muted">Total: $
                      @if ($price->discount)
                        {{ ($price->price - (($price->price / 100) * $price->discount)) * $cart->quantity }}                      
                      @else
                        {{ $price->price * $cart->quantity }}
                      @endif
                    </div>
                </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  @php
      if (session('coupon') && session('coupon')->coupon_type == 1) {
         $total = $sub_total - session('coupon')->amount;
      }
      elseif (session('coupon') && session('coupon')->coupon_type == 2) {
        $total = $sub_total - (($sub_total / 100) * session('coupon')->amount);
      }
      else {
        $total = $sub_total;
      }      
  @endphp   
@endsection
@section('footer_script')
<script src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_7.3.2/js/mdb.umd.min.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/plugins/mdb-plugins-gathered.min.js"></script>
<script>
    var total =  {{  $total }};
    var delivery = 60;
    $('.total').html('$' + (parseInt(total) + parseInt(delivery)));
    $('.delivery').click(function(){
        var delivery = $(this).val();
        $('.shipping_cost').html('+ $' + delivery)
        $('.total').html('$' + (parseInt(total) + parseInt(delivery)));
    });
    $('.sub_total').html('$' + {{  $sub_total }}); 
    $("#sub_total").val({{  $sub_total }})
</script>
@if (session('coupon'))
 <script>
  if ({{ session('coupon')->coupon_type }} == 1) {
    var discount_input = {{ session('coupon')->amount }};
  }
  else{
    var discount_input = {{ ($sub_total / 100) * session('coupon')->amount }};
  }
  $(".discount_input").val(discount_input);
</script>  
@endif
<script>
  $('.country').change(function(){
      var country_id = $(this).val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          'url': '/checkout/get_cities',
          'type': 'POST',
          data: {'country_id': country_id},
          success: function(data){
              $('.cities').html(data);
          }
      });
  })
</script>
{{ Session::pull('coupon') }}
@endsection