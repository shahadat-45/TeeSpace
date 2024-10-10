@extends('TeeSpace.blank')
@section('header_content')
<link rel="stylesheet" href="{{ asset('assets') }}/dropify/style.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/assets/main_css/owl.carousel.css"> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
#drop-area2 {
    display: flex;
    justify-content: center;
    align-items: center;
    column-gap: 10px;
    height: auto;
}
#drop-area2 {
    p {
        margin-top: unset;
        margin-bottom: unset;
    }
}
#browse-files2 {
    margin-top: unset;
    padding: 10px 25px;
}

</style>    
@endsection
@section('content')
    <!-- Header section End -->
    <section>
        <div class="mini-breadcrumb">            
            <p><span style="color: #7E7E7E;">Home </span> <img src="{{ asset('frontend') }}/assets/images/element/__before.png" > <span style="color: #7E7E7E;">{{ $products->rel_to_ctg->category_name }}</span><img src="{{ asset('frontend') }}/assets/images/element/__before.png" >{{ $products->product_name }}</p>
        </div>
    </section>
    <!-- Start Codding form here-->
              
    <section class="product__detailes">
        <div class="container">
            <div class="gallery">                
                <div id="sync1" class="owl_slider owl-carousel main_img product-active"> 
                    @foreach ($galleries as $gallery)
                      <div class="item zoom" onmousemove="zoom(event)" style="background-image: url({{ asset('backend') }}/product/{{ $gallery->images }});">
                        <img src="{{ asset('backend') }}/product/{{ $gallery->images }}" alt="" id="zooming_img">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn3">New</button>
                        <span class="play_icon"><i class="fa-solid fa-play"></i></span>
                        <span id="search_icon" class="search_icon" onclick="zoomStart()"><i class="fa-solid fa-magnifying-glass"></i></span>
                    </div>  
                    @endforeach

                </div>
                <div id="sync2" class="navigation-thumbs owl-carousel sub_img">
                    @foreach ($galleries as $gallery)
                    <div class="item">
                        <img src="{{ asset('backend') }}/product/{{ $gallery->images }}" alt="{{ $gallery->images }}">
                    </div>                        
                    @endforeach
                </div>
            </div>
            <div class="detailes">
                <h3>${{ number_format(App\Models\Inventory::where('product_id', $products->id)->Min('price'), 2)  }} - ${{ number_format(App\Models\Inventory::where('product_id', $products->id)->Max('price'), 2) }}</h3>
                <h2>{{ $products->product_name }}</h2>
                <p>{{ $products->short_desp }}</p>
                    <a href="">Product Guide</a> 
                <form action="{{ route('add.to.cart' , $products->id ) }}" method="POST" enctype="multipart/form-data" class="product_detailes_form"> 
                    @csrf
                    <div class="product__titles">Color:<span class="color_name">White</span></div>
                    <div class="color-name">
                        <ul>
                            @php
                                $color = App\Models\Inventory::where('product_id' , $products->id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
                            @endphp
                            @foreach ($color as $key => $color)
                            <li class="color{{ $key + 1 }}" ><input class="color_id" id="a{{ $key + 1 }}" type="radio" name="color" value="{{ $color->color_id }}">
                                <label for="a{{ $key + 1 }}" data-color='a{{ $key + 1 }}' style="background-color: {{ $color->rel_to_color->color_code }};"></label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="product__titles">Size:<span class="size_name">Small</span></div>
                    <div class="size-name">
                        <ul class="sizes">
                            @php
                                $size = App\Models\Inventory::where('product_id' , $products->id)->groupBy('size_id')->selectRaw('count(*) as total, size_id')->get();
                            @endphp
                            @foreach ($size as $key => $size)                                
                            <li><input id="s{{ $key + 1 }}" type="radio" name="size" value="{{ $size->size_id }}">
                                <label for="s{{ $key + 1 }}" >{{ $size->rel_to_size->size }}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="product__titles">Material:<span class="material_name">Metal</span></div>
                    <div class="material2">
                        @php
                            $material = App\Models\Inventory::where('product_id' , $products->id)->groupBy('material_id')->selectRaw('count(*) as total, material_id')->get();
                            $mtrl_count = App\Models\Inventory::where('product_id' , $products->id)->count();
                            $mtrl = App\Models\Inventory::where('product_id' , $products->id)->first();
                        @endphp
                        <ul id="material">
                            {{-- @if ($mtrl_count == 1 || $mtrl->material_id == null)
                                <li class="mtrl"><input id="mtrl" type="radio" name="mtrl" value="null">
                                    <label for="mtrl" ><img src="" alt="">none</label>
                                </li>
                            @else
                                @forelse($material as $key => $material)
                                   <li class="mtrl{{ $key + 1 }}"><input id="mtrl{{ $key + 1 }}" type="radio" name="mtrl" value="{{ $material->material_id }}">
                                        <label for="mtrl{{ $key + 1 }}" ><img src="{{ asset('backend') }}/material/{{ $material->rel_to_material->image }}" alt=""></label>
                                    </li> 
                                @empty
                                    N/A
                                @endforelse 
                            @endif --}}
                        </ul>
                    </div>                    
                    <div class="product__titles">Delivery:<span>1 to 3 business days</span></div>
                    <div class="delivery">
                        <select name="delivery">
                            <option selected disabled hidden >1 to 3 business days</option>
                            <option value="1">COD</option>
                            <option value="2" >Stripe</option>
                            <option value="3" >SSL Commerz</option>
                        </select>
                    </div>
                    <button type="button" class="clear__selection" id="clearSelectionButton"><i class="fa-solid fa-arrow-rotate-left"></i></i>Clear selection</button>
                    <div class="price__qty">                        
                        <div class="price">
                            @php
                                $prices = App\Models\Inventory::where('product_id' , $products->id)->first()
                            @endphp
                            <p class="new_price">${{ number_format($prices->price - (($prices->price / 100) * $prices->discount), 2)  }}</p>
                            <p class="old_price">${{ number_format($prices->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="drop-area2">
                                <svg width="45" viewBox="0 0 65 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M55.9414 21.095C56.0247 20.7616 56.0872 20.4179 56.1289 20.0637C56.1706 19.7096 56.1914 19.345 56.1914 18.97C56.1914 16.22 55.2122 13.8658 53.2539 11.9075C51.2956 9.94914 48.9414 8.96997 46.1914 8.96997C45.7331 8.96997 45.2956 9.00122 44.8789 9.06372C44.4622 9.12622 44.0456 9.19914 43.6289 9.28247C42.8372 6.8658 41.3997 4.87622 39.3164 3.31372C37.2331 1.75122 34.8581 0.969971 32.1914 0.969971C29.4414 0.969971 27.0143 1.78247 24.9102 3.40747C22.806 5.03247 21.3997 7.09497 20.6914 9.59497C19.9831 9.38664 19.2539 9.23039 18.5039 9.12622C17.7539 9.02205 16.9831 8.96997 16.1914 8.96997C13.9831 8.96997 11.8997 9.38664 9.94141 10.22C8.02474 11.0533 6.33724 12.1991 4.87891 13.6575C3.42057 15.1158 2.27474 16.8033 1.44141 18.72C0.608073 20.6783 0.191406 22.7616 0.191406 24.97C0.191406 27.1783 0.608073 29.2616 1.44141 31.22C2.27474 33.1366 3.42057 34.8241 4.87891 36.2825C6.33724 37.7408 8.02474 38.8866 9.94141 39.72C11.8997 40.5533 13.9831 40.97 16.1914 40.97H24.1914V52.97H40.1914V40.97H54.1914C56.9414 40.97 59.2956 39.9908 61.2539 38.0325C63.2122 36.0741 64.1914 33.72 64.1914 30.97C64.1914 28.5116 63.3997 26.3658 61.8164 24.5325C60.2331 22.6991 58.2747 21.5533 55.9414 21.095ZM36.1914 36.97V48.97H28.1914V36.97H18.1914L32.1914 22.97L46.1914 36.97H36.1914Z" fill="#7E7E7E"/>
                                    </svg>
                                <p>Drag & Drop Files Here <span>or</span></p>
                                <button id="browse-files2" type="button">Browse Files</button>
                                <input type="file" id="fileElem2" class="hidden" multiple name="gallery[]">
                            </div>
                            <div class="preview-container" id="preview-container2"></div>
                        </div>
                    </div>
                    <div class="price__qty">
                        <div class="quantity cart-plus-minus">
                            <input class="text-value" type="text" value="1" name="quantity">
                            <div class="dec qtybutton" onclick="quentity_decrement()">-</div>
                            <div class="inc qtybutton" onclick="quentity_increment()">+</div>
                        </div>
                        <div class="submit_btn"><button type="submit">Add to cart</button></div>
                    </div>
                </form> 
                <div class="wishlist__compare">
                    <a ><input type="checkbox" id="wishlist"><i class="fa-regular fa-star"></i><label for="wishlist">Add to wishlist</label></a>
                    <a href=""><i class="fa-solid fa-arrow-right-arrow-left"></i><label style="margin-left: 6px;">Compare</label></a>
                </div>
                <div class="additional__details">
                    <div class="product__titles">SKU:<span>{{ $products->slug ?? 'N/A' }}</span></div>
                    <div class="product__titles">Category:<span>{{ $products->rel_to_ctg->category_name ?? 'N/A' }}</span></div>
                    <div class="product__titles">Tags:<span>
                        @php
                            if ($products->tags == null) {
                                echo 'N/A';
                            }
                            else {                                        
                                $explode = explode(',', $products->tags);
                                foreach ($explode as $key => $value) {
                                    $tag = App\Models\Tag::find($value)->tag_name;
                                    echo  $tag ;
                                }
                            }
                        @endphp
                        </span></div>
                    <div class="product__titles">Share:
                        <span>
                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                            <a href=""><i class="fa-brands fa-instagram"></i></a>
                            <a href=""><i class="fa-brands fa-pinterest"></i></a>
                            <a href=""><i class="fa-brands fa-youtube"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- product__detailes section end-->
    <section class="product_description">
        <div class="container">
            <ul>
                <li class="desp_item tab_active" value="0">Description</li>
                <li class="desp_item" value="1">Additional information</li>
                <li class="desp_item" value="2">Reviews (<span>0</span>)</li>
                <li class="desp_item" value="3">Vendor Info</li>
                <li class="desp_item" value="4">More Products</li>
            </ul>
            <div class="description active fade show">
                {!! $products->long_desp !!}
            </div>
            <div class="Additional_information fade">               
                {!! $products->additional_info !!}
            </div>
            <div class="Reviews fade">
                Consectetur a scelerisque
                In pharetra turpis
                Pellentesque nec
            </div>
            <div></div>
            <div></div>
        </div>
    </section>
        <!-- product_description section end-->
    <section class="prd_also_like">
        <div class="container">
            <h3>You may also like…</h3>
            <div class="slider4">
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <!-- <button class="hot-item-btn2">New</button> -->
                        <button class="hot-item-btn3">Hot</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p><span class="discount-price">$19.95 </span> <span class="old-price">$159.95</span></p>
                    <!-- <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul> -->
                </div>
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>                
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- you may also like product_slider end-->
    <section class="prd_also_like related__product">
        <div class="container">
            <h3>Related Products</h3>
            <div class="slider4">
                @php
                    $rel_product = App\Models\Product::where('category_id' , $products->category_id )->get();                    
                @endphp
                @foreach ($rel_product as $rel_product)
                @php
                    $inventories = App\Models\Inventory::where('product_id', $rel_product->id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->take(2)->get();
                    $count = App\Models\Inventory::where('product_id', $rel_product->id)->count();
                @endphp
                    <div class="p-card">
                        <div class="card-img">
                            <a href="{{ route('product.detailes', $rel_product->slug) }}"><img src="{{ asset('backend') }}/product/{{ $rel_product->thumbnail }}" alt=""></a>
                            <button class="hot-item-btn1">Sale!</button>
                            <button class="hot-item-btn2">New</button>
                        </div>
                        <h4>{{ Str::limit($rel_product->product_name, 22 , '..') }}</h4>
                        <p>${{ App\Models\Inventory::where('product_id', $rel_product->id)->Min('price') }} - ${{ App\Models\Inventory::where('product_id', $rel_product->id)->Max('price') }}</p>
                        <ul>
                            @foreach ($inventories as $inventory)
                            <li style="background-color: {{ $inventory->rel_to_color->color_code }};"></li>
                            @endforeach
                            @if ($count > 2)
                            <span>+{{ $count - 2 }}</span>
                            @else
                            <span></span>                        
                            @endif
                        </ul>
                    </div>
                @endforeach
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <!-- <button class="hot-item-btn2">New</button> -->
                        <button class="hot-item-btn3">Hot</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p><span class="discount-price">$19.95 </span> <span class="old-price">$159.95</span></p>
                    <!-- <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul> -->
                </div>
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>                
                <div class="p-card">
                    <div class="card-img">
                        <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        <button class="hot-item-btn1">Sale!</button>
                        <button class="hot-item-btn2">New</button>
                    </div>
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                    <ul>
                        <li style="background-color: black;"></li>
                        <li style="background-color: #D7A983;"></li>
                        <span>+3</span>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer section Start -->
@endsection   
@section('footer_script')    
<script src="{{ asset('frontend') }}/assets/js fils/jquery-plugin-collection.js"></script>
<script src="{{ asset('frontend') }}/assets/js fils/quantity-plus-minus.js"></script>
<script src="{{ asset('frontend') }}/assets/js fils/product_description.js"></script>
<script src="{{ asset('frontend') }}/assets/js fils/image_gallery.js"></script>
<script>
    $('.color_id').click(function (){
        var color = $(this).val();
        var product_id = {{ $products->id }};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': '/product/pick_color',
            'type': 'POST',
            data: {'color': color},
            success: function(data){
                $('.color_name').html(data);
            }
        })
        $.ajax({
            'url': '/product/get_size',
            'type': 'POST',
            data: {'color': color , 'product_id': product_id},
            success: function(data){
                $('.sizes').html(data);

                //size
                $('.size_id').click(function(){
                    var size = $(this).val();
                    var product_id = {{ $products->id }};
                    var color = $("input[class='color_id']:checked").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        'url': '/product/pick_size',
                        'type': 'POST',
                        data: {'size': size},
                        success: function(data){
                            $('.size_name').html(data);
                        }
                    })
                    $.ajax({
                        'url': '/product/get_material',
                        'type': 'POST',
                        data:{'color': color , 'product_id': product_id , 'size': size},
                        success: function(data){
                            $('#material').html(data);

                            //Price
                            $('.material').click(function(){
                                var product_id = {{ $products->id }};
                                var color = $("input[class='color_id']:checked").val();
                                var size = $("input[class='size']:checked").val();
                                var material = $(this).val();

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    'url': '/product/pick_material',
                                    'type': 'POST',
                                    data: {'material': material},
                                    success: function(data){
                                        $('.material_name').html(data);
                                    }
                                })
                                $.ajax({
                                    'url': '/product/get_price',
                                    'type': 'POST',
                                    data:{'color': color , 'product_id': product_id , 'size': size , 'material': material},
                                    success: function(data){
                                        var item = JSON.parse(data);
                                        $('.old_price').html(item.price.toLocaleString('en-US', { style: 'currency', currency: 'USD' }));
                                        $('.new_price').html((item.price - ((item.price / 100) * item.discount)).toLocaleString('en-US', { style: 'currency', currency: 'USD' }));
                                    }
                                });
                                
                            })
                        }
                    })
                })
            }
        })
    })
</script>
<script>
    // Function to clear all radio button selections
    function clearSelection() {
      // Get all radio buttons in the document
      var radioButtons = document.querySelectorAll('input[type=radio]');
      
      // Loop through each radio button and uncheck it
      radioButtons.forEach(function(radioButton) {
        radioButton.checked = false;
      });
    }
  
    // Add an event listener to the "Clear selection" button
    document.getElementById('clearSelectionButton').addEventListener('click', clearSelection);
  </script>
<script>
    const dropArea2 = document.getElementById('drop-area2');
    const fileElem2 = document.getElementById('fileElem2');
    const browseFiles2 = document.getElementById('browse-files2');
    const previewContainer2 = document.getElementById('preview-container2');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea2.addEventListener(eventName, preventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea2.addEventListener(eventName, () => dropArea2.classList.add('hover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea2.addEventListener(eventName, () => dropArea2.classList.remove('hover'), false);
    });

    dropArea2.addEventListener('drop', handleDrop2, false);
    browseFiles2.addEventListener('click', () => fileElem2.click());
    fileElem2.addEventListener('change', handleFiles2, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop2(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles2({ target: { files } });
    }

    function handleFiles2(e) {
        let files = e.target.files;
        ([...files]).forEach(previewFile2);
        ([...files]).forEach(uploadFile);
    }

    function previewFile2(file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () => {
            let div = document.createElement('div');
            div.classList.add('preview2');
            div.innerHTML = `<img src="${reader.result}" alt="Image preview">
                            <button class="remove-btn" onclick="removePreview(this)">x</button>`;
            previewContainer2.appendChild(div);
        };
    }

    function removePreview(button) {
        button.parentElement.remove();
    }
</script>
  
@endsection