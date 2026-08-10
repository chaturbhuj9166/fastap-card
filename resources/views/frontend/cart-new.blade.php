<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>Shopping Cart - Fastap | NFC Digital Business Cards</title>

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
        background: var(--bg-secondary);
        padding: var(--space-2xl) 0;
        position: relative;
        overflow: hidden;
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
        font-size: clamp(2rem, 4vw, 2.5rem);
        font-weight: var(--font-extrabold);
        margin-bottom: var(--space-sm);
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        color: var(--text-secondary);
        font-size: var(--text-sm);
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

    /* Cart Section */
    .cart-section {
        padding: var(--space-2xl) 0 var(--space-3xl);
    }

    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: var(--space-2xl);
        align-items: start;
    }

    /* Cart Items */
    .cart-items-container {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-xl);
        overflow: hidden;
    }

    .cart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--space-lg) var(--space-xl);
        border-bottom: 1px solid var(--border-light);
        background: var(--bg-secondary);
    }

    .cart-header h2 {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .cart-header h2 i {
        color: var(--purple-500);
    }

    .cart-count {
        background: var(--purple-100);
        color: var(--purple-600);
        padding: 2px 10px;
        border-radius: var(--radius-full);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
    }

    .cart-item {
        display: grid;
        grid-template-columns: 120px 1fr auto;
        gap: var(--space-lg);
        padding: var(--space-lg) var(--space-xl);
        border-bottom: 1px solid var(--border-light);
        transition: background var(--transition-fast);
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item:hover {
        background: var(--bg-secondary);
    }

    .cart-item-image {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        background: var(--bg-secondary);
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-logo {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        background: white;
        padding: 2px;
        box-shadow: var(--shadow-sm);
    }

    .cart-item-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .cart-item-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cart-item-name {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-xs);
        color: var(--text-primary);
    }

    .cart-item-name a {
        color: inherit;
        text-decoration: none;
    }

    .cart-item-name a:hover {
        color: var(--purple-500);
    }

    .cart-item-meta {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        margin-bottom: var(--space-sm);
    }

    .cart-item-price {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .cart-item-price .current {
        font-size: var(--text-lg);
        font-weight: var(--font-bold);
        color: var(--purple-600);
    }

    .cart-item-price .original {
        font-size: var(--text-sm);
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .cart-item-price .discount {
        font-size: var(--text-xs);
        color: var(--green-600);
        font-weight: var(--font-medium);
        background: rgba(16, 185, 129, 0.1);
        padding: 2px 6px;
        border-radius: var(--radius-sm);
    }

    .cart-item-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
    }

    .remove-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        color: var(--text-muted);
        cursor: pointer;
        transition: all var(--transition-fast);
        text-decoration: none;
    }

    .remove-btn:hover {
        background: var(--red-500);
        border-color: var(--red-500);
        color: white;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        background: var(--bg-secondary);
        border-radius: var(--radius-md);
        padding: 4px;
    }

    .quantity-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-primary);
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: all var(--transition-fast);
    }

    .quantity-btn:hover {
        background: var(--purple-500);
        color: white;
    }

    .quantity-value {
        width: 40px;
        text-align: center;
        font-weight: var(--font-medium);
    }

    /* Empty Cart */
    .cart-empty {
        text-align: center;
        padding: var(--space-3xl);
    }

    .cart-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto var(--space-lg);
        background: var(--bg-secondary);
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-3xl);
        color: var(--text-muted);
    }

    .cart-empty h3 {
        font-size: var(--text-xl);
        margin-bottom: var(--space-sm);
    }

    .cart-empty p {
        color: var(--text-secondary);
        margin-bottom: var(--space-xl);
    }

    /* Order Summary */
    .order-summary {
        background: var(--bg-primary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-xl);
        overflow: hidden;
        position: sticky;
        top: 100px;
    }

    .order-summary-header {
        padding: var(--space-lg) var(--space-xl);
        border-bottom: 1px solid var(--border-light);
        background: var(--bg-secondary);
    }

    .order-summary-header h3 {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .order-summary-header h3 i {
        color: var(--purple-500);
    }

    .order-summary-body {
        padding: var(--space-xl);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: var(--space-md);
    }

    .summary-row .label {
        color: var(--text-secondary);
    }

    .summary-row .value {
        font-weight: var(--font-medium);
    }

    .summary-row.discount .value {
        color: var(--green-600);
    }

    .summary-divider {
        height: 1px;
        background: var(--border-light);
        margin: var(--space-lg) 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: var(--space-lg);
    }

    .summary-total .label {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
    }

    .summary-total .value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--purple-600);
    }

    /* Coupon */
    .coupon-box {
        margin-bottom: var(--space-lg);
    }

    .coupon-input {
        display: flex;
        gap: var(--space-sm);
    }

    .coupon-input input {
        flex: 1;
        padding: var(--space-sm) var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-secondary);
        font-size: var(--text-sm);
    }

    .coupon-input input:focus {
        outline: none;
        border-color: var(--purple-500);
    }

    .coupon-input button {
        padding: var(--space-sm) var(--space-md);
        background: var(--bg-tertiary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        cursor: pointer;
        transition: all var(--transition-fast);
    }

    .coupon-input button:hover {
        border-color: var(--purple-500);
        color: var(--purple-500);
    }

    /* Checkout Button */
    .checkout-btn {
        width: 100%;
        padding: var(--space-md);
        background: var(--gradient-purple);
        color: white;
        border: none;
        border-radius: var(--radius-lg);
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        cursor: pointer;
        transition: all var(--transition-base);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
        text-decoration: none;
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
        color: white;
    }

    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: var(--space-md);
        color: var(--text-secondary);
        text-decoration: none;
        font-size: var(--text-sm);
    }

    .continue-shopping:hover {
        color: var(--purple-500);
    }

    /* Security Note */
    .security-note {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        margin-top: var(--space-lg);
        padding: var(--space-md);
        background: var(--bg-secondary);
        border-radius: var(--radius-md);
        font-size: var(--text-xs);
        color: var(--text-muted);
    }

    .security-note i {
        color: var(--green-500);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .cart-layout {
            grid-template-columns: 1fr;
        }

        .order-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .cart-item {
            grid-template-columns: 80px 1fr;
            gap: var(--space-md);
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
        }

        .cart-item-actions {
            grid-column: 1 / -1;
            flex-direction: row;
            justify-content: space-between;
            margin-top: var(--space-sm);
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
                <h1>Shopping <span class="text-gradient-purple">Cart</span></h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ url('/Product') }}">Products</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">Cart</span>
                </nav>
            </div>
        </div>
    </section>

    {{-- Cart Section --}}
    <section class="cart-section">
        <div class="container">
            @php
                $total = $discount_price = $bag_discount = 0;
            @endphp

            @if (count($cartdata) > 0)
                <div class="cart-layout">
                    {{-- Cart Items --}}
                    <div class="cart-items-container fade-up">
                        <div class="cart-header">
                            <h2><i class="fas fa-shopping-bag"></i> Shopping Bag</h2>
                            <span class="cart-count">{{ count($cartdata) }} Items</span>
                        </div>

                        @foreach ($cartdata as $cart)
                            @php
                                $price = $cart->pro_price;
                                $mrp = $cart->pro_mrp;
                                $discount = $mrp > 0 ? round((($mrp - $price) / $mrp) * 100) : 0;
                                $total += $price;
                                $discount_price += ($mrp - $price);
                            @endphp
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="{{ URL::asset('public/uploads/product_images/product_single_img') }}/{{ $cart->pro_img }}" alt="{{ $cart->pro_name }}">
                                    @if($cart->logo_status == '1' && $cart->image)
                                        <div class="cart-item-logo">
                                            <img src="{{ URL::asset('frontend/portfolio') }}/{{ $cart->image }}" alt="Custom Logo">
                                        </div>
                                    @endif
                                </div>
                                <div class="cart-item-details">
                                    <h3 class="cart-item-name">
                                        <a href="{{ url('digital-business-card-in-jaipur/'.$cart->pro_url) }}">{{ $cart->pro_name }}</a>
                                    </h3>
                                    <div class="cart-item-meta">
                                        NFC Digital Business Card
                                    </div>
                                    <div class="cart-item-price">
                                        <span class="current">₹{{ number_format($price) }}</span>
                                        @if($mrp > $price)
                                            <span class="original">₹{{ number_format($mrp) }}</span>
                                            <span class="discount">{{ $discount }}% OFF</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="cart-item-actions">
                                    <a href="{{ url('cartprodelete/'.$cart->id) }}" class="remove-btn" title="Remove item">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <div class="quantity-control">
                                        <button class="quantity-btn" type="button"><i class="fas fa-minus"></i></button>
                                        <span class="quantity-value">1</span>
                                        <button class="quantity-btn" type="button"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Order Summary --}}
                    <div class="order-summary fade-up">
                        <div class="order-summary-header">
                            <h3><i class="fas fa-receipt"></i> Order Summary</h3>
                        </div>
                        <div class="order-summary-body">
                            <div class="summary-row">
                                <span class="label">Subtotal ({{ count($cartdata) }} items)</span>
                                <span class="value">₹{{ number_format($total + $discount_price) }}</span>
                            </div>
                            @if($discount_price > 0)
                                <div class="summary-row discount">
                                    <span class="label">Discount</span>
                                    <span class="value">- ₹{{ number_format($discount_price) }}</span>
                                </div>
                            @endif
                            <div class="summary-row">
                                <span class="label">Shipping</span>
                                <span class="value">Free</span>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="coupon-box">
                                <div class="coupon-input">
                                    <input type="text" placeholder="Enter coupon code">
                                    <button type="button">Apply</button>
                                </div>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="summary-total">
                                <span class="label">Total</span>
                                <span class="value">₹{{ number_format($total) }}</span>
                            </div>

                            <a href="{{ url('/Checkout') }}" class="checkout-btn">
                                <i class="fas fa-lock"></i>
                                Proceed to Checkout
                            </a>

                            <a href="{{ url('/Product') }}" class="continue-shopping">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>

                            <div class="security-note">
                                <i class="fas fa-shield-alt"></i>
                                <span>Your payment information is secure and encrypted</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty Cart --}}
                <div class="cart-items-container fade-up">
                    <div class="cart-header">
                        <h2><i class="fas fa-shopping-bag"></i> Shopping Bag</h2>
                        <span class="cart-count">0 Items</span>
                    </div>
                    <div class="cart-empty">
                        <div class="cart-empty-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Your cart is empty</h3>
                        <p>Looks like you haven't added any items to your cart yet.</p>
                        <a href="{{ url('/Product') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag"></i> Start Shopping
                        </a>
                    </div>
                </div>
            @endif
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
