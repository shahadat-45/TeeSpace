<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <title>Payment</title>
    <style>
        .cancel{text-decoration: none}.bg-pay{background-color: #eee;border-radius: 2px}.com-color{color: #8f37aa!important}.radio{cursor: pointer}label.radio input{position: absolute;top: 0;left: 0;visibility: hidden;pointer-events: none}label.radio div{padding: 7px 14px;border: 2px solid #8f37aa;display: inline-block;color: #8f37aa;border-radius: 3px;text-transform: uppercase;width: 100%;margin-bottom: 10px}label.radio input:checked+div{border-color: #8f37aa;background-color: #8f37aa;color: #fff}.fw-500{font-weight: 400}.lh-16{line-height: 16px}
    </style>
</head>
<body>
    @php
        $order = App\Models\Order::where('order_id' , session('order_id'))->first();
        @endphp
<div class="container mt-3 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex flex-row align-items-center">
            <h4 class="text-uppercase mt-1">TeeSpace</h4> <span class="ml-2">Pay</span>
        </div> <a href="{{ route('cart' , Auth::guard('customer')->id()) }}" class="cancel com-color">Cancel and return to website</a>
    </div>
    <div class="row">
        <div class="col-md-6">            
            <form action="{{ route('payment.method') }}" method="POST">
                @csrf
            <div class="about">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row mt-1">
                        <h6>Insurance Coverage</h6>
                        <h6 class="text-success font-weight-bold ml-1">N/A</h6>
                    </div>
                    <div class="d-flex flex-row align-items-center com-color"> <i class="fa fa-plus-circle"></i> </div>
                </div>
                <p>Your insurance will cover a portion of this order. All necessary claims will be submitted directly to your insurer.</p>
                <div class="p-2 d-flex justify-content-between bg-pay align-items-center"> <span>Aetna - Open Access</span> </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-row mt-1">
                        <h6>Your Balance</h6>
                        <h6 class="text-success font-weight-bold ml-1">${{ $order->total ?? '00.00' }}</h6>
                    </div>
                    <div class="d-flex flex-row align-items-center com-color"> <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Payment card</span> </div>
                </div>
                <p>This is the amount you'll need to pay. Insurance claims will handle the rest.</p>
                <div class="d-flex flex-column"> 
                    <label class="radio"> <input type="radio" name="payment" value="1" checked>
                        <div class="d-flex justify-content-between"> <span>COD</span> </div>
                    </label> 
                    <label class="radio"> <input type="radio" name="payment" value="2">
                        <div class="d-flex justify-content-between"> <span>STRIPE</span> </div>
                    </label> 
                    <label class="radio"> <input type="radio" name="payment" value="3">
                        <div class="d-flex justify-content-between"> <span>SSLCOMMERZ</span> </div>
                    </label> 
                </div>
                <div class="buttons"> <button type="submit" class="btn btn-success btn-block">Proceed to payment</button> </div>
            </div></form>
        </div>
        <div class="col-md-2"> </div>
        <div class="col-md-4">
            <div class="bg-pay p-3"> <span class="font-weight-bold">Order Recap</span>
                @foreach ($cart as $cart)
                @php
                    if ($cart->material_id == 0) {
                        $price = App\Models\Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->first();
                    }else {
                        $price = App\Models\Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->where('material_id' , $cart->material_id)->first();
                    }
                    if ($price->discount) {
                        $total = ($price->price - (($price->price / 100) * $price->discount)) * $cart->quantity;
                    }else {
                        $total = $price->price * $cart->quantity;
                    }
                @endphp
                <div class="d-flex justify-content-between mt-2"> <span class="fw-500">{{ Str::of($cart->rel_to_product->product_name)->words(3, '..') }} ({{ $cart->quantity }})</span> <span>${{ $total }}</span> </div>                    
                @endforeach
                <hr>
                <div class="d-flex justify-content-between mt-2"> <span class="fw-500">Discount Amount </span> <span>-${{ $order->discount ?? '00.00' }}</span> </div>
                <div class="d-flex justify-content-between mt-2"> <span class="fw-500">Delivery Charge </span> <span>+${{ $order->charge ?? '00.00' }}</span> </div>
                <hr>
                <div class="d-flex justify-content-between mt-2"> <span class="fw-500">Total </span> <span class="text-success">${{ $order->total ?? '00.00' }}</span> </div>
            </div>
        </div>
    </div>
</div>    
</body>
</html>
