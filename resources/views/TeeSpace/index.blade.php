@extends('TeeSpace.blank')
@section('content')
    <section class="banner">
        <div class="container banner-frame">
            <div class="banner-content">
                <button class="blue__btn">Create your own</button>
                <h1>Make the most
                    of
                   <br> printing <img src="{{ asset('frontend') }}/assets/images/banner_img/__before_mask-group.png"></h1>
                <p class="sub-title">What’s more, we do it right! A full administration printing background.
                    Print shirts for yourself or your online business</p>
                <div class="banner-btn-2">
                    <a href="{{ route('shop') }}"><button class="banner-btn">Shop Now<span><i class="fa-solid fa-arrow-right-long"></i></span></button></a>
                    <button class="banner-btn banner-btn-white">How We Work<span><i class="fa-solid fa-play"></i></span></button>
                </div>                
                <div class="collection">
                    <div><h4>4K+</h4><p>Collections</p></div>
                    <img src="{{ asset('frontend') }}/assets/images/element/vartical_line.png" style="max-height: 61px;">
                    <div><h4>9k+</h4><p>items trusted to deliver</p></div>
                </div>
            </div>
            <div class="banner-img">
                <img src="{{ asset('frontend') }}/assets/images/banner_img/Item → slideshow-21.png.png" alt="">
            </div>
        </div>
    </section>
    <!-- Banner End -->
    <section class="category">
        <div class="container">
            <h3>Shopping by Categories</h3>
            <div class="categories">
                @foreach ($categories as $category) 
                @php                    
                    $count = App\Models\Product::where('category_id', $category->id)->count();
                @endphp 
                <div class="cat-card">
                    <img src="{{ asset('backend') }}/category/{{ $category->category_image }}" alt="{{ $category->category_image }}">
                    <p>{{ $category->category_name }} <span>{{ $count }}</span></p>
                </div>
                @endforeach                
            </div>
        </div>
    </section>
    <!-- Category Section End -->
    <section class="banner2">
        <div class="container">
            <div class="banner-box" style="background: url({{ asset('frontend') }}/assets/images/banner_img/Link\ →\ banner-26.png.png);">
                <div>
                    <h3>Thousands of free templates</h3>
                    <p>Free and easy way to bring your ideas to life</p>
                    <button>Explore More <span><i class="fa-solid fa-arrow-right-long"></i></span></button>
                </div>
            </div>
            <div class="banner-box" style="background: url({{ asset('frontend') }}/assets/images/banner_img/Link\ →\ banner-27.jpg.png);">
                <div>
                    <h3>Create your unique style</h3>
                    <p>Free and easy way to bring your ideas to life</p>
                    <button>Shop Now <span><i class="fa-solid fa-arrow-right-long"></i></span></button>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner2 Section End -->    
    <section class="new-arrivals">
        <div class="container">
            <h2>New Arrivals <span>Best Seller</span> <span>Sale</span></h2>
            <div class="slider">
                @foreach ($products as $product)                    
                <div class="p-card">
                    <img src="{{ asset('backend') }}/product/{{ $product->thumbnail }}" alt="{{ $product->thumbnail }}">
                    <h4>{{ Str::of($product->product_name)->limit(20) }}</h4>
                    <p>${{ $product->rel_to_inventory->min('price') ?? '00' }} – ${{ $product->rel_to_inventory->max('price') ?? '00' }}</p>
                </div>
                @endforeach
                <div class="p-card">
                    <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                </div>
                <div class="p-card">
                    <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                </div>
                <div class="p-card">
                    <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                </div>
                <div class="p-card">
                    <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                    <h4>Zone Sweatshirt</h4>
                    <p>$19.95 – $159.95</p>
                </div>
            </div>
        </div>
    </section>
    <!-- New arrival Section End -->
    <section class="hot-items">
        <div class="container">
            <div class="hot-item-heading">
                <h2>Hot under $39 </h2>
                <button id="button-item">View All <span id="button-span"><i class="fa-solid fa-arrow-right"></i></span></button>
            </div>
            <div class="slider2">
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
    <!-- hot-item section End -->
    <section class="custom_t-shirt">
        <div class="container">
            <h2>T-shirt printing made easy.</h2>
            <p>Let us show you how your product come to life.</p>
            <div class="details">
                <ol type="1">
                    <li><span class="list active">1</span><span class="text">Choose from 412 custom products in our catalog</span></li>
                    <li><span class="list ">2</span><span class="text">Customize your design with graphics, text or your own uploaded images.</span></li>
                    <li><span class="list ">3</span><span class="text">Get your order sent to your door with free standard shipping.</span></li>
                </ol>
                <img src="{{ asset('frontend') }}/assets/images/banner_img/step-31.png" alt="banner_img">
            </div>
        </div>
    </section>
    <!-- custom_t-shirt end -->
    <section class="templates">
        <div class="container">
            <div class="templates-heading ">
                <h2>Free design templates</h2>
                <button id="button-item">View All <span id="button-span"><i class="fa-solid fa-arrow-right"></i></span></button>
            </div>
            <div class="img-cards">
                <div class="img-card">
                    <div>
                        <div class="short-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 12px 0 0 0;">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 0 0 0 12px;">
                        </div>
                        <div class="long-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        </div>
                        <div class="img-card-overlay"></div>
                    </div>
                    <h2>Astronauts</h2>
                    <p>85 resources</p>
                </div>
                <div class="img-card">
                    <div>
                        <div class="short-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 12px 0 0 0;">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 0 0 0 12px;">
                        </div>
                        <div class="long-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        </div>
                        <div class="img-card-overlay"></div>
                    </div>
                    <h2>Quote that collection</h2>
                    <p>85 resources</p>
                </div>
                <div class="img-card">
                    <div>
                        <div class="short-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 12px 0 0 0;">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 0 0 0 12px;">
                        </div>
                        <div class="long-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        </div>
                        <div class="img-card-overlay"></div>
                    </div>
                    <h2>Art Styles</h2>
                    <p>85 resources</p>
                </div>
                <div class="img-card">
                    <div >
                        <div class="short-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 12px 0 0 0;">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="" style="border-radius: 0 0 0 12px;">
                        </div>
                        <div class="long-img">
                            <img src="{{ asset('frontend') }}/assets/images/products/product-330x440.png" alt="">
                        </div>
                        <div class="img-card-overlay overlay-active">
                            <h3>+28</h3>
                            <p>Collections</p>
                        </div>
                    </div>
                    <h2>Astronauts</h2>
                    <p>85 resources</p>
                </div>
            </div>
        </div>
    </section>
    <!-- templates design end -->
    <section class="logos">
        <div class="container">
            <div class="logo-section-title">
                <h3 id="h3-element">We integrate with</h3>
                <button id="button-item">And more <span id="button-span"><i class="fa-solid fa-arrow-right"></i></span></button>
            </div>
            <div class="integrate-with">
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
                <div class="logo-items"><img src="{{ asset('frontend') }}/assets/images/logos/logo-spotify.png" alt=""></div>
            </div>
        </div>
    </section>
    <!-- logo section end -->
    <section class="testimonials">
        <div class="container">
            <div class="app-download" style="background-image: url({{ asset('frontend') }}/assets/images/testimonials/app-download-element.png);">
                <div>
                    <h3 id="h3-element">Download our app</h3>
                    <p>Available for iOS and Android</p>
                    <div class="btn">
                        <button><img src="{{ asset('frontend') }}/assets/images/testimonials/google-play.png" alt=""></button>
                        <button><img src="{{ asset('frontend') }}/assets/images/testimonials/apple-store.png" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider">
                <div class="slider-body slider3">
                    <div class="testimonial-item">
                        <h3 id="h3-element">Testimonials</h3>
                        <q>For all your printing prerequisites. Offer to make
                            and print their pamphlets, business cards,
                            solicitations, and occasion programs.</q>
                        <div class="profile">
                            <img src="{{ asset('frontend') }}/assets/images/testimonials/avater-testi-2.png" alt="">
                            <div>
                                <h4>Eddy M.</h4>
                                <p>Designer at Lift </p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <h3 id="h3-element">Testimonials</h3>
                        <q>For all your printing prerequisites. Offer to make
                            and print their pamphlets, business cards,
                            solicitations, and occasion programs.</q>
                        <div class="profile">
                            <img src="{{ asset('frontend') }}/assets/images/testimonials/avater-testi-2.png" alt="">
                            <div>
                                <h4>Eddy M.</h4>
                                <p>Designer at Lift </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonials section end -->
    <section class="subscribe">
        <div class="container">
            <h3 id="h3-element">Get the latest news, events & more delivered to your inbox.</h3>
            <div>
                <form action="">
                    <input type="text" placeholder="Your email address">
                    <button><i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </section>
    <!-- subscribe section end -->
    <section class="gallery">
        <div class="container">
            <img src="{{ asset('frontend') }}/assets/images/gallery/Item.png" alt="">
            <img src="{{ asset('frontend') }}/assets/images/gallery/Item.png" alt="">
            <img src="{{ asset('frontend') }}/assets/images/gallery/Item.png" alt="">
            <img src="{{ asset('frontend') }}/assets/images/gallery/Item.png" alt="">
            <img src="{{ asset('frontend') }}/assets/images/gallery/Item.png" alt="">
        </div>
    </section>    
@endsection