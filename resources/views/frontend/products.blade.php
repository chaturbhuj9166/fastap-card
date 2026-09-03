@extends('layouts.product.app')

@section('content')
<!-- Banner Here -->
<section class="banner__section breadcumnd__banner bannerbg">
   <!--Mask-->
   <div class="banner__bgmask">
      <img src="{{url ('frontend/assets/img/elements/box-element.png')}}" alt="mask">
   </div>
   <!--Mask-->
   <!--Container-->
   <div class="container">
      <div class="breadcumnd__wrapper">
         <div class="row g-4  justify-content-between align-items-end">
            <!--col-->
            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8">
               <div class="breadcumnd__content">
                  <h1 class="title">
                    Product
                  </h1>
                  <ul class="breadcumnd__list">
                     <li>
                        <a href="{{url ('/')}}">
                           Home
                        </a>
                     </li>
                     <li>
                        <span class="icon">
                           <i class="material-symbols-outlined">
                              chevron_right
                           </i>
                        </span>
                     </li>
                     <li class="sucess">
                        Product
                     </li>
                  </ul>
               </div>
            </div>
            <!--col-->
            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-8">
               <div class="breadcumnd__thumb">
                  <img src="{{url ('frontend/assets/img/banner/breadcumnd.png')}}" alt="bread">
               </div>
            </div>
            <!--col-->
         </div>
         <!--ai text-->
         <div class="bread__ai">
            <img src="{{url ('frontend/assets/img/elements/t-element.png')}}" alt="img">
         </div>
         <!--ai text-->
      </div>
   </div>
   <!--Container-->
</section>
<!-- Banner End -->

<!--Shop Section-->
<!-- Shop Section -->
<section class="shop__section py-5 bg-white">
  <div class="container">
    <div class="row">
      <!-- Product Grid -->
      <div class="col-lg-8">
        <div class="row g-4">
          @foreach ($product as $item)
  @php
    $category = App\Models\category::find($item->category_id);
  @endphp
  <div class="col-sm-6">
    <div class="card shadow-sm" style="height: 100%; border: 1px solid #eee; transition: 0.3s ease;">
      <a href="{{ url('digital-business-card-in-jaipur/' . $item->url) }}">
        <img src="{{ asset('public/uploads/product_images/product_single_img/'.$item->pro_img) }}"
             class="card-img-top"
             alt="{{ $item->pro_name }}"
             style="height: 220px; object-fit: cover;">
      </a>
      <div class="card-body d-flex flex-column">
        <h5 class="card-title" style="margin-bottom: 5px;">
          <a href="{{ url('digital-business-card-in-jaipur/' . $item->url) }}"
             style="color: #212529; text-decoration: none; font-weight: 600; font-size: 1.1rem; display: block;">
            {{ $item->pro_name }}
          </a>
        </h5>
        <p class="text-muted mb-2" style="font-size: 0.9rem;">
          {{ $category ? $category->categroy : '' }}
        </p>
        <div class="mt-auto">
          <div class="price mb-2" style="font-size: 1rem;">
            <span class="text-muted text-decoration-line-through">₹{{ $item->pro_mrp }}</span>
            <span class="ms-2" style="font-size: 1.1rem; font-weight: bold; color: #0d6efd;">
              ₹{{ $item->pro_price }}
            </span>
          </div>
          <div class="rating mb-3" style="color: #f4c150; font-size: 18px;">
            @for ($i = 1; $i <= 5; $i++)
              <i class="material-symbols-outlined">
                {{ $i <= 4 ? 'star' : 'star_half' }}
              </i>
            @endfor
          </div>
          <a href="{{ url('digital-business-card-in-jaipur/' . $item->url) }}"
             class="btn btn-outline-primary w-100">
            Buy Now
          </a>
        </div>
      </div>
    </div>
  </div>
@endforeach

        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
          {{ $product->links() }}
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <aside class="sidebar px-3">
          <!-- Filter Box -->
          <div class="mb-4">
            <h4 class="fs-5">Filter</h4>
            <form class="d-flex mb-3">
              <input type="text" class="form-control me-2" placeholder="Search" />
              <button class="btn btn-primary"><i class="material-symbols-outlined">search</i></button>
            </form>
          </div>

          <!-- Popular Products -->
          <div>
            <h4 class="fs-5 mb-3">Popular Products</h4>
            @foreach (App\Models\Product::where('status',1)->inRandomOrder()->take(6)->get() as $p)
              <div class="d-flex align-items-center mb-3">
                <a href="{{ url('digital-business-card-in-jaipur/' . $p->url) }}">
                  <img src="{{ asset('public/uploads/product_images/product_single_img/'.$p->pro_img) }}"
                       alt="{{ $p->pro_name }}" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
                </a>
                <div class="flex-grow-1">
                  <a href="{{ url('digital-business-card-in-jaipur/' . $p->id) }}" class="d-block text-dark">
                    {{ $p->pro_name }}
                  </a>
                  <span class="text-muted small">
                    <del>₹{{ $p->pro_mrp }}</del> ₹{{ $p->pro_price }}
                  </span>
                </div>
              </div>
            @endforeach
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
@endsection
<!--Shop Section-->

  
  
  
  <script>
      $(document).ready(function(){
          $('#{{$type}}').click();
      });
      
      
    //----- anand start code //
    jQuery(document).ready(function() {
      jQuery('.pagination').removeClass('pagination').addClass('pagination pt__40 justify-content-center');
     // jQuery('.page-link').removeClass('page-link').addClass('icon');
    });
    //----- anand end code //
  </script>
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>