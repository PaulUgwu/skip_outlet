@extends('layouts.customer')
@section('body-class', 'woocommerce-active two-sidebar')



@section('content')

<br>
<br>

            <div id="content" class="site-content" tabindex="-1">
                <div class="col-full">
                    <div class="row">
                        <!-- .woocommerce-breadcrumb -->
                        


                        


                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="shop-control-bar">
                                    <div class="handheld-sidebar-toggle">
                                        <button type="button" class="btn sidebar-toggler">
                                            <i class="fa fa-sliders"></i>
                                            <span>Filters</span>
                                        </button>
                                    </div>
                                    <!-- .handheld-sidebar-toggle -->
                                    <h1 class="woocommerce-products-header__title page-title">Products</h1>
                                    <!-- .form-techmarket-wc-ppp -->
                                    <form method="get" class="woocommerce-ordering d-none">
                                        <select class="orderby" name="orderby">
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="rating">Sort by average rating</option>
                                            <option selected="selected" value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                        <input type="hidden" value="5" name="shop_columns">
                                        <input type="hidden" value="15" name="shop_per_page">
                                        <input type="hidden" value="right-sidebar" name="shop_layout">
                                    </form>
                                    <!-- .woocommerce-ordering -->
                                    <nav class="techmarket-advanced-pagination">
                                        <form class="form-adv-pagination" method="post">
                                            <input type="number" value="1" class="form-control" step="1" max="5" min="1" size="2" id="goto-page">
                                        </form> of 5<a href="#" class="next page-numbers">→</a>
                                    </nav>
                                    <!-- .techmarket-advanced-pagination -->
                                </div>


                                <!-- .shop-control-bar -->
                                <div class="tab-content">
                                    <div id="grid" class="tab-pane active" role="tabpanel">
                                        <div class="woocommerce columns-4">
                                            <div class="products">



                                                @foreach($products->forPage($_GET['page'], 16) as $product)
                                                    <div class="product first">
                                                        <!-- .yith-wcwl-add-to-wishlist -->
                                                        <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="{{ url('/product', [$product->slug]) }}">
                                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="{{ asset('storage/uploads/products/images/'.$product->get_product_image(1)) }}">
                                                            {!!$product->price_html()!!}
                                                            <h2 class="woocommerce-loop-product__title text-capitalize pb-0">{{$product->name}}</h2>
                                                            <small class="pt-0 text-capitalize text-truncate pr-3">{{$product->supermarket->name}}, {{$product->supermarket->area->name}}, {{$product->supermarket->state->name}}</small>
                                                        </a>
                                                        <!-- .woocommerce-LoopProduct-link -->
                                                        <div class="hover-area">
                                                            <a class="button" href="javascript:void(0)" onclick="add_to_cart({{$product->id}})">Add to cart</a>
                                                            <a class="" href="{{ url('/store', [$product->supermarket->slug]) }}">More from store</a>
                                                        </div>
                                                        <!-- .hover-area -->
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- .products -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .tab-pane -->
                                </div>

                                <!-- .tab-content -->
                                <div class="shop-control-bar-bottom">
                                    <nav class="woocommerce-pagination">
                                        <ul class="page-numbers">
                                            @for($i = 1; $i <= ceil($products->count()/16) ; $i++)
                                                <li>
                                                    <span class="page-numbers {{$_GET['page'] == $i ? 'disabled current' : ''}}">
                                                        <a href="{{ url('/products?product_name=' . $_GET['product_name'] . '&category_name=' . $_GET['category_name'] . '&type_id=' . $_GET['type_id'] . '&min_price=' . $_GET['min_price'] . '&max_price=' . $_GET['max_price'] . '&store_id=' . $_GET['store_id'] . '&page=' . $i) }}">{{$i}}</a>
                                                    </span>
                                                </li>
                                            @endfor
                                        </ul>
                                        <!-- .page-numbers -->
                                    </nav>
                                    <!-- .woocommerce-pagination -->
                                </div>
                                <!-- .shop-control-bar-bottom -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                        <div id="secondary" class="widget-area shop-sidebar" role="complementary">
                            
                            <div id="techmarket_products_filter-3" class="widget widget_techmarket_products_filter">
                                






                                <div class="widget woocommerce widget_product_categories techmarket_widget_product_categories" id="techmarket_product_categories_widget-2">
                                    <ul class="product-categories ">
                                        <li class="product_cat">
                                            <span>Browse Categories</span>
                                            <ul class="dropright">
                                                <li>
                                                    <span class="text-capitalize"  aria-haspopup="true" aria-expanded="false" style="cursor: pointer">
                                                        <a href="{{url('/products') . '?' . http_build_query(['category_name' => ''])}}" class="">All Products</a>
                                                    </span>
                                                </li>
                                                
                                                @foreach($categories as $category)
                                                    <li>
                                                        <span class="dropdown-toggle text-capitalize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer">
                                                        {{$category->name}}
                                                        </span>
                                                        <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{url('/products') . '?' . http_build_query(['category_name' => $category->name])}}" style="font-size: 12px" >All</a>
                                                        @foreach($category->types as $type)
                                                            <a class="dropdown-item text-capitalize" href="{{url('/products') . '?' . http_build_query(['category_name' => $category->name, 'type_id' => $type->id])}}" style="font-size: 12px">{{$type->name}}</a>
                                                        @endforeach
                                                        </div>
                                                    </li>
                                                @endforeach


                                            </ul>
                                        </li>
                                    </ul>
                                </div>



                                <div class="widget woocommerce widget_price_filter" id="woocommerce_price_filter-2">
                                    <form method="get" action="{{ url('/products') }}">
                                        <span class="gamma widget-title">Filter by price</span>
                                        <div class="price_slider_amount">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Min</label>
                                                    <input type="number" name="min_price" value="{{$_GET['min_price']}}" id="">
                                                </div>
                                                <div class="col-6">
                                                    <label>Max</label>
                                                    <input type="number" name="max_price" value="{{$_GET['max_price']}}" id="">
                                                </div>
                                            </div>
                                            <input type="hidden" name="category_name" value="{{$_GET['category_name']}}" id="">
                                            <button class="button" type="submit">Filter</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- .woocommerce widget_layered_nav -->
                            </div>
                            <div class="widget widget_techmarket_products_carousel_widget">
                                <section id="single-sidebar-carousel" class="section-products-carousel">
                                    <header class="section-header">
                                        <h2 class="section-title">Latest Products</h2>
                                        <nav class="custom-slick-nav"></nav>
                                    </header>
                                    <!-- .section-header -->
                                    <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;rows&quot;:2,&quot;slidesPerRow&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#single-sidebar-carousel .custom-slick-nav&quot;}">
                                        <div class="container-fluid">
                                            <div class="woocommerce columns-1">
                                                <div class="products">


                                                    @foreach($products->take(8) as $product)
                                                        <div class="landscape-product-widget product">
                                                            <a class="woocommerce-LoopProduct-link" href="{{url('/product', [$product->slug])}}">
                                                                <div class="media">
                                                                    <img class="wp-post-image" src="{{ asset('storage/uploads/products/images/'.$product->get_product_image(1)) }}" alt="">
                                                                    <div class="media-body">
                                                                        {!!$product->price_html()!!}
                                                                        <!-- .price -->
                                                                        <h2 class="woocommerce-loop-product__title text-capitalize">{{$product->name}}</h2>
                                                                        <!-- .techmarket-product-rating -->
                                                                    </div>
                                                                    <!-- .media-body -->
                                                                </div>
                                                                <!-- .media -->
                                                            </a>
                                                            <!-- .woocommerce-LoopProduct-link -->
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- .products -->
                                            </div>
                                            <!-- .woocommerce -->
                                        </div>
                                        <!-- .container-fluid -->
                                    </div>
                                    <!-- .products-carousel -->
                                </section>
                                <!-- .section-products-carousel -->
                            </div>
                            <!-- .widget_techmarket_products_carousel_widget -->
                        </div>







                        <div id="tertiary" class="widget-area shop-sidebar" role="complementary">
                            <div class="widget widget_techmarket_products_carousel_widget">
                                <section class="section-products-carousel">
                                    <header class="section-header">
                                        <h2 class="section-title">Featured Products</h2>
                                    </header>
                                    <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;rows&quot;:6,&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:false}">
                                        <div class="container-fluid">
                                            <div class="woocommerce columns-1">
                                                <div class="products">

                                                    @foreach($products->take(8) as $product)
                                                        <div class="product">
                                                            <a href="{{url('/product', [$product->slug])}}" class="woocommerce-LoopProduct-link">
                                                                <img src="{{ asset('storage/uploads/products/images/'.$product->get_product_image(1)) }}" width="224" height="197" class="wp-post-image" alt="">
                                                                <span class="price">
                                                                    {!!$product->price_html()!!}
                                                                </span>
                                                                <!-- /.price -->
                                                                <h2 class="woocommerce-loop-product__title text-truncate text-capitalize">{{$product->name}}</h2>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>












                    </div>
                    <!-- .row -->
                </div>
                <!-- .col-full -->
            </div>
@endsection