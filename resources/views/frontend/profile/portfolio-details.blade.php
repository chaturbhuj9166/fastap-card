@extends('layouts.appprofile')
@section('content')

  <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="{{ url('index') }}">Home</a></li>
            <li><a href="{{ url('index') }}#portfolio">Portfolio</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  <img src="{{ URL::asset('frontend/profile_assets/assets/img/portfolio/portfolio-details-1.jpg')}}" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="{{ URL::asset('frontend/profile_assets/assets/img/portfolio/portfolio-details-2.jpg')}}" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="{{ URL::asset('frontend/profile_assets/assets/img/portfolio/portfolio-details-3.jpg')}}" alt="">
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <ul>
                <li><strong>Category</strong>: Web design</li>
                <li><strong>Client</strong>: ASU Company</li>
                <li><strong>Project date</strong>: 01 March, 2020</li>
                <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>This is an example of portfolio detail</h2>
              <p>
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta incidunt laudantium dolore totam ad repudiandae recusandae velit numquam, provident sit iusto quidem eius distinctio ex debitis quasi temporibus cum beatae.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Portfolio Details Section -->



@endsection