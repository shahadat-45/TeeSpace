@extends('TeeSpace.blank')
@section('header_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    a {
        text-decoration: none;
        color: black;
    }    
</style>    
@endsection
@section('content')
<section class="mb-5">
<div class="container">
    <div class="row">
    <!-- cart -->
    <div class="col-lg-9">
        <div class="card border shadow-0">
        <div class="m-4">
            @php
                $total = 0;
            @endphp
            <h4 class="card-title mb-4">Your shopping cart</h4>
            @foreach ($cart as $cart)
            <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="cart_info">
                @csrf
             <div class="row gy-3 mb-4">
            <div class="col-lg-5">
                <div class="me-lg-5">
                <div class="d-flex">
                    <div style="width: 96px; height: 96px; margin-right: 1rem;">
                        <img src="{{ asset('backend') }}/product/{{ $cart->rel_to_product->thumbnail ?? '' }}" class="border rounded" width="96px" height="96px" style="object-fit: contain">
                    </div>
                    <div class="">
                    <a href="#" class="nav-link">{{ $cart->rel_to_product->product_name }}</a>
                    <p class="text-muted">{{ $cart->rel_to_color->color_name ?? 'N/A' }}, {{ $cart->rel_to_size->size ?? 'N/A' }}</p>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                <div class="">
                <select style="width: 100px;" class="form-select me-4 quantity" name="quantity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="{{ $cart->quantity ?? 1 }}" selected>{{ $cart->quantity ?? 1 }}</option>
                </select>
                </div>
                <div class="">
                @php
                    if ($cart->material_id == 0) {
                        $price = App\Models\Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->first();
                    }else {
                        $price = App\Models\Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->where('material_id' , $cart->material_id)->first();
                    }
                    if ($price->discount) {
                        $total += ($price->price - (($price->price / 100) * $price->discount)) * $cart->quantity;
                    }else {
                        $total += $price->price * $cart->quantity;
                    }
                @endphp
                <span class="h6">$
                    @if ($price->discount)
                    {{ number_format(($price->price - (($price->price / 100) * $price->discount)) * $cart->quantity , 2) ?? 00 }}
                    @php
                    @endphp
                    @else
                    {{ $price->price ?? 00 }}
                    @endif
                </span> <br>
                <small class="text-muted text-nowrap"> $@if ($price->discount)
                    {{ number_format($price->price - (($price->price / 100) * $price->discount) , 2) ?? 00 }}
                    @else
                    {{ $price->price ?? 00 }}
                    @endif / per item </small>
                </div>
            </div>
            <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                <div class="float-md-end">
                <a href="#!" class="btn btn-light border px-2 icon-hover-primary"><i class="fas fa-heart fa-lg px-1 text-secondary"></i></a>
                <a href="{{ route('cart.delete' , $cart->id) }}" class="btn btn-light border text-danger icon-hover-danger"> Remove</a>
                </div>
            </div>
            </div>
        </form>
            @endforeach
        </div>

        <div class="border-top pt-4 mx-4 mb-4">
            <p><i class="fas fa-truck text-muted fa-lg"></i> Free Delivery within 1-2 weeks</p>
            <p class="text-muted">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip
            </p>
        </div>
        </div>
    </div>
    <!-- cart -->
    <!-- summary -->
    <div class="col-lg-3">
        <div class="card mb-3 border shadow-0">
        <div class="card-body">
            <form action="{{ route('cart',Auth::guard('customer')->id()) }}" method="GET">
                @if (session('couponError'))
                    <div class="alert alert-danger">{{ session('couponError') }}</div>
                @endif
                <div class="form-group">
                    <label class="form-label">Have coupon?</label>
                    <div class="input-group">
                        <input type="text" class="form-control border" name="coupon" placeholder="Coupon code or Name">
                        <button type="submit" class="btn btn-light border">Apply</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div class="card shadow-0 border">
        <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="mb-2">Total price:</p>
            <p class="mb-2">${{ number_format($total , 2) }}</p>
            </div>
            <div class="d-flex justify-content-between">
            <p class="mb-2">Discount:</p>
            <p class="mb-2 text-success">-${{ $type == 1 ? $amount : number_format((($total / 100)* $amount) , 2) }}</p>
            </div>
            <div class="d-flex justify-content-between">
            <p class="mb-2">TAX:</p>
            <p class="mb-2">$00.00</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
            <p class="mb-2">Total price:</p>
            <p class="mb-2 fw-bold">$
                @if ($type == 0)
                    {{ number_format($total , 2) }}
                @elseif ($type == 1)
                    {{ number_format($total - $amount, 2) }}
                @else
                    {{ number_format($total - (($total / 100) * $amount) , 2) }}
                @endif
            </div>
            <div class="mt-3">
            <a href="{{ route('checkout', Auth::guard('customer')->id()) }}" class="btn btn-success w-100 shadow-0 mb-2"> Make Purchase </a>
            <a href="{{ route('shop') }}" class="btn btn-light w-100 border mt-2"> Back to shop </a>
            </div>
        </div>
        </div>
    </div>
    <!-- summary -->
    </div>
</div>
</section>
<!-- cart + summary -->
<section>
<div class="container my-5">
    <header class="mb-4">
    <h3>Recommended items</h3>
    </header>

    <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card px-4 border shadow-0 mb-4 mb-lg-0">
        <div class="mask px-2" style="height: 50px;">
            <div class="d-flex justify-content-between">
            <h6><span class="badge bg-danger pt-1 mt-3 ms-2">New</span></h6>
            <a href="#"><i class="fas fa-heart text-primary fa-lg float-end pt-3 m-2"></i></a>
            </div>
        </div>
        <a href="#" class="">
            <img src="assets/images/7.webp" class="card-img-top rounded-2">
        </a>
        <div class="card-body d-flex flex-column pt-3 border-top">
            <a href="#" class="nav-link">Gaming Headset with Mic</a>
            <div class="price-wrap mb-2">
            <strong class="">$18.95</strong>
            <del class="">$24.99</del>
            </div>
            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
            <a href="#" class="btn btn-outline-primary w-100">Add to cart</a>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card px-4 border shadow-0 mb-4 mb-lg-0">
        <div class="mask px-2" style="height: 50px;">
            <a href="#"><i class="fas fa-heart text-primary fa-lg float-end pt-3 m-2"></i></a>
        </div>
        <a href="#" class="">
            <img src="assets/images/5.webp" class="card-img-top rounded-2">
        </a>
        <div class="card-body d-flex flex-column pt-3 border-top">
            <a href="#" class="nav-link">Apple Watch Series 1 Sport </a>
            <div class="price-wrap mb-2">
            <strong class="">$120.00</strong>
            </div>
            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
            <a href="#" class="btn btn-outline-primary w-100">Add to cart</a>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card px-4 border shadow-0">
        <div class="mask px-2" style="height: 50px;">
            <a href="#"><i class="fas fa-heart text-primary fa-lg float-end pt-3 m-2"></i></a>
        </div>
        <a href="#" class="">
            <img src="assets/images/9.webp" class="card-img-top rounded-2">
        </a>
        <div class="card-body d-flex flex-column pt-3 border-top">
            <a href="#" class="nav-link">Men's Denim Jeans Shorts</a>
            <div class="price-wrap mb-2">
            <strong class="">$80.50</strong>
            </div>
            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
            <a href="#" class="btn btn-outline-primary w-100">Add to cart</a>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card px-4 border shadow-0">
        <div class="mask px-2" style="height: 50px;">
            <a href="#"><i class="fas fa-heart text-primary fa-lg float-end pt-3 m-2"></i></a>
        </div>
        <a href="#" class="">
            <img src="assets/images/10.webp" class="card-img-top rounded-2">
        </a>
        <div class="card-body d-flex flex-column pt-3 border-top">
            <a href="#" class="nav-link">Mens T-shirt Cotton Base Layer Slim fit </a>
            <div class="price-wrap mb-2">
            <strong class="">$13.90</strong>
            </div>
            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
            <a href="#" class="btn btn-outline-primary w-100">Add to cart</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>    
@endsection  
@section('footer_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('.quantity').change(function(){
        var quantity = $(this).val();
        // alert(quantity);
        $('.cart_info').submit();
    })
</script>

@endsection
