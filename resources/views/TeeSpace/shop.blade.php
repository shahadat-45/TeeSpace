@extends('TeeSpace.blank')
@section('content')
<section>
    <div class="breadcrumb">
        <h2>Shop</h2>
        <p><span style="color: #7E7E7E;">Home </span> <img src="{{ asset('frontend') }}/assets/images/element/__before.png" > Shop</p>
    </div>
</section>
<div class="container product-page shop_page">
    <aside>
        <div class="search">
            <label for="search">Search</label>
            <input type="text" id="search" placeholder="Search products…">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="product-categories">
            <h3 class="label-headding">Product categories</h3>
            <ul>
                <li>Hoodie<span>11</span></li>
                <li>Kids<span>11</span></li>
                <li>Long Sleeves<span>11</span></li>
                <li>Product Designer<span>11</span></li>
                <li>Long Sleeves<span>11</span></li>
                <li>T-Shirt<span>11</span></li>
            </ul>
        </div>
        <div class="filter-bar">
            <h3 class="label-headding">Filter by price</h3>
            <!-- <input type="range" class="custom-range" id="customRange1"> -->
            <div class="multi-range">
                <input type="range" min="0" max="160" id="lower" value="0">
                <input type="range" min="0" max="160" id="upper" value="160">
            </div>
            <div class="show-price">
                <p>Price: <span id="price-start"> $0</span> <img src="{{ asset('frontend') }}/assets/images/element/__before.png" > <span id="price-end"> $160</span></p>
                <button>Filter</button>
            </div>
        </div>
        <div class="color">
            <h3 class="label-headding">Filter by Color</h3>
            <ul>
                <li class="color1"><label style="background-color: black;"></label> Black <span>10</span> </li>
                <li class="color2"> <label style="background-color: rgb(255, 0, 0);"></label> Red <span>10</span> </li>
                <li class="color3"> <label style="background-color: rgb(229, 255, 0);"></label> Yellow <span>10</span> </li>
                <li class="color4"> <label style="background-color: rgb(8, 3, 255);"></label> Blue <span>10</span> </li>
                <li class="color5"> <label style="background-color: #D7A983;"></label> Brown <span>10</span> </li>
            </ul>
        </div>
        <div class="size">
            <h3 class="label-headding">Filter by Size</h3>
            <ul>
                <li class="size1">2XL <span>10</span> </li>
                <li class="size2">Xl <span>10</span> </li>
                <li class="size3">L <span>10</span> </li>
                <li class="size4">M <span>10</span> </li>
                <li class="size5">S <span>10</span> </li>
            </ul>
        </div>
        <div class="material color">
            <h3 class="label-headding">Filter by Material</h3>
            <ul>
                <li class="mtrl-1"><label style="background-image: url({{ asset('frontend') }}/assets/images/element/material.png);"></label> Glass <span>10</span> </li>
                <li class="mtrl-2"> <label style="background-image: url({{ asset('frontend') }}/assets/images/element/material.png);"></label> Wood <span>10</span> </li>
                <li class="mtrl-3"> <label style="background-image: url({{ asset('frontend') }}/assets/images/element/material.png);"></label> Paper <span>10</span> </li>
                <li class="mtrl-4"> <label style="background-image: url({{ asset('frontend') }}/assets/images/element/material.png);"></label> Metal <span>10</span> </li>
                
            </ul>
        </div>
        <div class="price size">
            <h3 class="label-headding">Price filter</h3>
            <ul>
                <li style="color: black;">All</li>
                <li class="price1">$0.00 - $40.00</li>
                <li class="price2">$0.00 - $40.00</li>
                <li class="price3">$0.00 - $40.00</li>
                <li class="price4">$0.00 - $40.00</li>
                <li class="price5">$0.00 - $40.00</li>
            </ul>
        </div>
        <div class="sort-by size">
            <h3 class="label-headding">Sort by</h3>
            <ul>
                <li class="sort1">Popularity</li>
                <li class="sort2">Average rating</li>
                <li class="sort3">Latest</li>
                <li class="sort4">Price: low to high</li>
                <li class="sort5">Price: high to low</li>
            </ul>
        </div>
        <div class="stock">
            <h3 class="label-headding">Stock status</h3>
            <ul>
                <li class="stock1"><input type="checkbox" name="stock"><label>On sale</label></li>
                <li class="stock2"><input type="checkbox" name="stock"><label>In stock</label></li>
                <li class="stock3"><input type="checkbox" name="stock"><label>Out of stock</label></li>
                <li class="stock4"><input type="checkbox" name="stock"><label>On back order</label></li>                    
            </ul>
        </div>
        <div class="tags">
            <h3 class="label-headding">Product tags</h3>
            <ul>
                <li class="tags1">On sale</li>
                <li class="tags2">In tags</li>
                <li class="tags3">Out of tags</li>
                <li class="tags4">On back order</li>                    
            </ul>
        </div>

    </aside>
    <div class="list-of-product">
        <div class="filter-2">
            {{-- <p>Showing <span>1{{ $paginator->firstItem() }}</span> – <span>12{{ $paginator->lastItem() }}</span> of <span>20{{ $paginator->total() }}</span> results</p> --}}
            <div>
                <button class="filter_bar" title="Filter"><i class="fa-solid fa-filter"></i></button>
                <select name="sorting" >
                    <option value="">Default sorting</option>
                    <option value="">Grid</option>
                </select>
                <div>
                    <p>See</p>
                    <i class="fa-solid fa-border-all"></i>
                    <i class="fa-solid fa-bars active"></i>
                </div>
            </div>
        </div>
        <div class="products">
            @foreach ($products as $product)
            @php                
                $inventories = App\Models\Inventory::where('product_id', $product->id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->take(2)->get();
                $count = App\Models\Inventory::where('product_id', $product->id)->count();
            @endphp
            <div class="p-card">
                <div class="card-img">
                    <a href="{{ route('product.detailes', $product->slug) }}"><img src="{{ asset('backend') }}/product/{{ $product->thumbnail }}" alt=""></a>
                    <button class="hot-item-btn1">Sale!</button>
                    <button class="hot-item-btn2">New</button>
                </div>
                <h4><a href="{{ route('product.detailes', $product->slug) }}">{{ Str::limit($product->product_name, 22 , '..') }}</a></h4>
                <p>${{ App\Models\Inventory::where('product_id', $product->id)->Min('price') }} - ${{ App\Models\Inventory::where('product_id', $product->id)->Max('price') }}</p>
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
        </div>
    </div>
</div>
<section>
    <div class="center">
        {{ $products->links('vendor.pagination.custom-pagination') }}        
    </div>
</section>
@endsection
@section('footer_script')    
<script src="{{ asset('frontend') }}/assets/js fils/multi-range-filterbar.js"></script>
<script>
    let aside = document.querySelector('.product-page > aside');
    let button = document.querySelector('.filter-2 > div > .filter_bar');
    button.addEventListener('click' , function(){
        aside.classList.toggle('aside__active');            
    })
    </script>
<script>
    $('.pagination-summary')
</script>
@endsection
</body>
</html>