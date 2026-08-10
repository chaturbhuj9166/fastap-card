@extends('layouts.appprofile')
@section('content')

 <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blog Details</h2>
          <ol>
            <li><a href="{{ url('index') }}">Home</a></li>
            <li><a href="{{ url('index') }}#blog">Blog</a></li>
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
                  <img src="{{ URL::asset('frontend/profile_assets/assets/img/blog/01.jpg')}}" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="{{ URL::asset('frontend/profile_assets/assets/img/blog/02.jpg')}}" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="{{ URL::asset('frontend/profile_assets/assets/img/blog/03.jpg')}}" alt="">
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>RECENT POSTS</h3>
              <ul>
                <li><strong>Category</strong></li>
                <li>- Nature Lifestyle</li>
                 <li>- Awesome Layouts</li>
                 <li>- Creative Ideas</li> 
                 <li>- Responsive Templates</li> 
                 <li>- HTML5 / CSS3 Templates</li> 
                 <li>- Creative & Unique</li> 
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>This is an example of Blog detail</h2>
              <p>
               Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vel, qui! Eligendi, veritatis, blanditiis quibusdam itaque consectetur assumenda nisi accusamus impedit tempore adipisci quod neque laboriosam nostrum maiores vero harum incidunt.
              </p>
            </div>
          </div>
          <div class="col-lg-12">
            <form class="email-form">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                  </div>
                  <div class="form-group">
                  <input class="form-control" id="contact-email" type="email" name="email" placeholder="Email" required="">
                  </div>
                  <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                  </div>
                </div>
                <div class="col-md-6">
              <div class="form-group">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
              </div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Portfolio Details Section -->



@endsection