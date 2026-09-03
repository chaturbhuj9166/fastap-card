<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>Products - Fastap | NFC Digital Business Cards</title>
    <meta name="description" content="Shop premium NFC digital business cards. Choose from smart cards, metal cards, professional cards, and custom designs.">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Material Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    {{-- New Design System CSS --}}
    <link rel="stylesheet" href="{{url('redesign/css/variables.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/base.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/components.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/theme-toggle.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/animations.css')}}">

    {{-- Theme Toggle Script --}}
    <script src="{{url('redesign/js/theme-toggle.js')}}"></script>

    <style>
    /* Page Hero */
    .page-hero {
        background: linear-gradient(120deg, rgba(15, 23, 42, 0.08), rgba(99, 102, 241, 0.08));
        padding: var(--space-3xl) 0;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid var(--border-light);
    }

    .page-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: var(--gradient-purple);
        opacity: 0.1;
        border-radius: 50%;
        filter: blur(100px);
    }

    .page-hero-content {
        position: relative;
        z-index: 1;
    }

    .page-hero h1 {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: var(--font-extrabold);
        margin-bottom: var(--space-md);
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        color: var(--text-secondary);
    }

    .breadcrumb-nav a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: color var(--transition-fast);
    }

    .breadcrumb-nav a:hover {
        color: var(--purple-500);
    }

    .breadcrumb-nav .current {
        color: var(--purple-500);
        font-weight: var(--font-medium);
    }

    /* Products Section */
    .products-section {
        padding: var(--space-3xl) 0;
        background: var(--bg-secondary);
    }

    .products-shell {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-2xl);
        padding: var(--space-2xl);
        box-shadow: var(--shadow-xl);
    }

    .products-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: var(--space-2xl);
    }

    /* Sidebar Filters */
    .products-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .filter-card {
        background: var(--bg-primary);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-md);
    }

    .filter-card h3 {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .filter-card h3 i {
        color: var(--purple-500);
    }

    .search-box {
        display: flex;
        gap: var(--space-sm);
    }

    .search-box input {
        flex: 1;
        padding: var(--space-sm) var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        background: var(--bg-primary);
        color: var(--text-primary);
        font-size: var(--text-sm);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--purple-500);
    }

    .search-box button {
        padding: var(--space-sm) var(--space-md);
        background: var(--gradient-purple);
        border: none;
        border-radius: var(--radius-lg);
        color: white;
        cursor: pointer;
        transition: all var(--transition-fast);
    }

    .search-box button:hover {
        transform: scale(1.05);
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-list li {
        margin-bottom: var(--space-xs);
    }

    .category-list a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--space-sm) var(--space-md);
        color: var(--text-secondary);
        text-decoration: none;
        border-radius: var(--radius-md);
        transition: all var(--transition-fast);
        font-size: var(--text-sm);
    }

    .category-list a:hover,
    .category-list a.active {
        background: var(--bg-primary);
        color: var(--purple-500);
    }

    .category-list .count {
        background: var(--bg-tertiary);
        padding: 2px 8px;
        border-radius: var(--radius-full);
        font-size: var(--text-xs);
    }

    .price-range {
        display: flex;
        flex-direction: column;
        gap: var(--space-sm);
    }

    .price-inputs {
        display: flex;
        gap: var(--space-sm);
        align-items: center;
    }

    .price-inputs input {
        width: 100%;
        padding: var(--space-sm);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-primary);
        color: var(--text-primary);
        font-size: var(--text-sm);
        text-align: center;
    }

    .price-inputs span {
        color: var(--text-muted);
    }

    /* Products Grid */
    .products-main {
        min-width: 0;
    }

    .products-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--space-xl);
        flex-wrap: wrap;
        gap: var(--space-md);
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
        box-shadow: var(--shadow-md);
    }

    .products-count {
        color: var(--text-secondary);
        font-size: var(--text-sm);
    }

    .products-sort {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .products-sort label {
        font-size: var(--text-sm);
        color: var(--text-secondary);
    }

    .products-sort select {
        padding: var(--space-xs) var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: var(--text-sm);
        cursor: pointer;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: var(--space-xl);
    }

    /* Product Card */
    .product-card {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: all var(--transition-base);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--purple-300);
    }

    .product-image {
        position: relative;
        aspect-ratio: 4/3;
        overflow: hidden;
        background: var(--bg-secondary);
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-base);
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: var(--space-sm);
        left: var(--space-sm);
        padding: var(--space-xs) var(--space-sm);
        background: var(--gradient-purple);
        color: white;
        font-size: var(--text-xs);
        font-weight: var(--font-semibold);
        border-radius: var(--radius-full);
    }

    .product-wishlist {
        position: absolute;
        top: var(--space-sm);
        right: var(--space-sm);
        width: 36px;
        height: 36px;
        background: var(--bg-primary);
        border: none;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-fast);
        color: var(--text-secondary);
    }

    .product-wishlist:hover {
        background: var(--red-500);
        color: white;
    }

    .product-content {
        padding: var(--space-lg);
    }

    .product-category {
        font-size: var(--text-xs);
        color: var(--purple-500);
        font-weight: var(--font-medium);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: var(--space-xs);
    }

    .product-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-sm);
        line-height: 1.3;
    }

    .product-title a {
        color: var(--text-primary);
        text-decoration: none;
        transition: color var(--transition-fast);
    }

    .product-title a:hover {
        color: var(--purple-500);
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        margin-bottom: var(--space-sm);
    }

    .product-rating .stars {
        color: var(--yellow-500);
        font-size: var(--text-sm);
    }

    .product-rating .count {
        color: var(--text-muted);
        font-size: var(--text-xs);
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        margin-bottom: var(--space-md);
    }

    .product-price .current {
        font-size: var(--text-xl);
        font-weight: var(--font-bold);
        color: var(--purple-600);
    }

    .product-price .original {
        font-size: var(--text-sm);
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .product-price .discount {
        font-size: var(--text-xs);
        color: var(--green-600);
        font-weight: var(--font-semibold);
        background: rgba(16, 185, 129, 0.1);
        padding: 2px 6px;
        border-radius: var(--radius-sm);
    }

    .product-actions {
        display: flex;
        gap: var(--space-sm);
    }

    .btn-add-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-md);
        background: var(--gradient-purple);
        color: white;
        border: none;
        border-radius: var(--radius-lg);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        cursor: pointer;
        text-decoration: none;
        transition: all var(--transition-fast);
    }

    .btn-add-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(139, 92, 246, 0.3);
    }

    .btn-quick-view {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        color: var(--text-secondary);
        cursor: pointer;
        transition: all var(--transition-fast);
        text-decoration: none;
    }

    .btn-quick-view:hover {
        background: var(--purple-500);
        border-color: var(--purple-500);
        color: white;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: var(--space-2xl);
    }

    .pagination {
        display: flex;
        gap: var(--space-xs);
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 var(--space-sm);
        background: var(--bg-secondary);
        color: var(--text-secondary);
        text-decoration: none;
        border-radius: var(--radius-md);
        font-size: var(--text-sm);
        transition: all var(--transition-fast);
    }

    .pagination .page-item .page-link:hover,
    .pagination .page-item.active .page-link {
        background: var(--gradient-purple);
        color: white;
    }

    /* Popular Products Sidebar */
    .popular-product {
        display: flex;
        gap: var(--space-md);
        padding: var(--space-sm) 0;
        border-bottom: 1px solid var(--border-light);
    }

    .popular-product:last-child {
        border-bottom: none;
    }

    .popular-product-image {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        overflow: hidden;
        flex-shrink: 0;
    }

    .popular-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popular-product-info {
        flex: 1;
        min-width: 0;
    }

    .popular-product-title {
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        margin-bottom: var(--space-xs);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .popular-product-title a {
        color: var(--text-primary);
        text-decoration: none;
    }

    .popular-product-title a:hover {
        color: var(--purple-500);
    }

    .popular-product-price {
        font-size: var(--text-sm);
    }

    .popular-product-price .current {
        color: var(--purple-600);
        font-weight: var(--font-semibold);
    }

    .popular-product-price .original {
        color: var(--text-muted);
        text-decoration: line-through;
        font-size: var(--text-xs);
    }

    .empty-state {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-xl);
        padding: var(--space-3xl);
        text-align: center;
        box-shadow: var(--shadow-md);
    }

    .empty-state-icon {
        width: 64px;
        height: 64px;
        border-radius: var(--radius-full);
        background: var(--bg-secondary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: var(--space-md);
        color: var(--text-muted);
        font-size: var(--text-xl);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .products-layout {
            grid-template-columns: 1fr;
        }

        .products-sidebar {
            position: static;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-lg);
        }

        .filter-card {
            margin-bottom: 0;
        }
    }

    @media (max-width: 768px) {
        .products-sidebar {
            grid-template-columns: 1fr;
        }

        .products-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    </style>
</head>
<body>
    {{-- Header --}}
    @include('frontend.header-new')

    {{-- Page Hero --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content fade-up">
                <h1>Our <span class="text-gradient-purple">Products</span></h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">Products</span>
                </nav>
            </div>
        </div>
    </section>

    {{-- Products Section --}}
    <section class="products-section">
        <div class="container">
            <div class="products-shell">
            <div class="products-layout">
                {{-- Sidebar --}}
                <aside class="products-sidebar fade-up">
                    {{-- Search --}}
                    <div class="filter-card">
                        <h3><i class="fas fa-search"></i> Search</h3>
                        <form class="search-box">
                            <input type="text" placeholder="Search products...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    {{-- Categories --}}
                    <div class="filter-card">
                        <h3><i class="fas fa-list"></i> Categories</h3>
                        <ul class="category-list">
                            <li><a href="{{ url('/Product') }}" class="active">All Products <span class="count">{{ $product->total() ?? 0 }}</span></a></li>
                            @php
                                $categories = App\Models\category::where('status', 1)->get();
                            @endphp
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ url('/Product/'.$cat->id) }}">
                                        {{ $cat->categroy }}
                                        <span class="count">{{ App\Models\Product::where('category_id', $cat->id)->where('status', 1)->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Price Range --}}
                    <div class="filter-card">
                        <h3><i class="fas fa-rupee-sign"></i> Price Range</h3>
                        <div class="price-range">
                            <div class="price-inputs">
                                <input type="number" placeholder="Min" min="0">
                                <span>-</span>
                                <input type="number" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>

                    {{-- Popular Products --}}
                    <div class="filter-card">
                        <h3><i class="fas fa-fire"></i> Popular</h3>
                        @foreach(App\Models\Product::where('status', 1)->inRandomOrder()->take(4)->get() as $popular)
                            <div class="popular-product">
                                <div class="popular-product-image">
                                    <a href="{{ url('digital-business-card-in-jaipur/'.$popular->url) }}">
                                        <img src="{{ asset('public/uploads/product_images/product_single_img/'.$popular->pro_img) }}" alt="{{ $popular->pro_name }}">
                                    </a>
                                </div>
                                <div class="popular-product-info">
                                    <div class="popular-product-title">
                                        <a href="{{ url('digital-business-card-in-jaipur/'.$popular->url) }}">{{ $popular->pro_name }}</a>
                                    </div>
                                    <div class="popular-product-price">
                                        <span class="current">₹{{ number_format($popular->pro_price) }}</span>
                                        @if($popular->pro_mrp > $popular->pro_price)
                                            <span class="original">₹{{ number_format($popular->pro_mrp) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>

                {{-- Products Main --}}
                <div class="products-main">
                    <div class="products-header">
                        <div class="products-count">
                            Showing <strong>{{ $product->firstItem() ?? 0 }}-{{ $product->lastItem() ?? 0 }}</strong> of <strong>{{ $product->total() ?? 0 }}</strong> products
                        </div>
                        <div class="products-sort">
                            <label for="sort">Sort by:</label>
                            <select id="sort">
                                <option value="newest">Newest First</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                                <option value="popular">Most Popular</option>
                            </select>
                        </div>
                    </div>

                    @if($product->count())
                    <div class="products-grid stagger-animation">
                        @foreach($product as $item)
                            @php
                                $category = App\Models\category::find($item->category_id);
                                $discount = $item->pro_mrp > 0 ? round((($item->pro_mrp - $item->pro_price) / $item->pro_mrp) * 100) : 0;
                            @endphp
                            <div class="product-card fade-up">
                                <div class="product-image">
                                    <a href="{{ url('digital-business-card-in-jaipur/'.$item->url) }}">
                                        <img src="{{ asset('public/uploads/product_images/product_single_img/'.$item->pro_img) }}" alt="{{ $item->pro_name }}">
                                    </a>
                                    @if($discount > 0)
                                        <span class="product-badge">{{ $discount }}% OFF</span>
                                    @endif
                                    <button class="product-wishlist" aria-label="Add to wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="product-content">
                                    @if($category)
                                        <div class="product-category">{{ $category->categroy }}</div>
                                    @endif
                                    <h3 class="product-title">
                                        <a href="{{ url('digital-business-card-in-jaipur/'.$item->url) }}">{{ $item->pro_name }}</a>
                                    </h3>
                                    <div class="product-rating">
                                        <div class="stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i > 4 ? '-half-alt' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="count">(4.5)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current">₹{{ number_format($item->pro_price) }}</span>
                                        @if($item->pro_mrp > $item->pro_price)
                                            <span class="original">₹{{ number_format($item->pro_mrp) }}</span>
                                            <span class="discount">Save {{ $discount }}%</span>
                                        @endif
                                    </div>
                                    <div class="product-actions">
                                        <a href="{{ url('digital-business-card-in-jaipur/'.$item->url) }}" class="btn-add-cart">
                                            <i class="fas fa-shopping-cart"></i> Buy Now
                                        </a>
                                        <a href="{{ url('digital-business-card-in-jaipur/'.$item->url) }}" class="btn-quick-view" aria-label="Quick view">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3>No products found</h3>
                        <p>Try adjusting filters or check back soon.</p>
                    </div>
                    @endif

                    {{-- Pagination --}}
                    <div class="pagination-wrapper">
                        {{ $product->links() }}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('frontend.footer-new')

    {{-- WhatsApp Button --}}
    @include('frontend.whatsapp-new')

    {{-- Scripts --}}
    <script src="{{url('redesign/js/animations.js')}}"></script>
</body>
</html>

