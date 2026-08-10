<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="M_Adnan">
  <title>Profile-Meet</title>

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/rs-plugin/css/settings.css')}}" media="screen" />
  <!-- Bootstrap Core CSS caresol testimonial -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
  <!-- Bootstrap logo CSS caresol testimonial -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>

  <!-- Bootstrap Core CSS -->
  <link href="{{ URL::asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{{ URL::asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('frontend/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('frontend/css/main.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('frontend/css/style.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caladea&family=DM+Sans&family=Poppins:wght@100&family=Roboto:wght@300&display=swap"
rel="stylesheet">
  <!-- JavaScripts -->
  <script src="{{ URL::asset('frontend/js/modernizr.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <!-- Online Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>

  

  <style>
    .card {
      margin-top: 40px;

    }

    /* .card-img:hover {
  -ms-transform: scale(1.1); 
  -webkit-transform: scale(1.1); 
  transform: scale(1.1); 
  box-shadow: rgb(0 0 0 / 27%) 0px 9px 23px, rgb(0 0 0 / 20%) 0px 8px 9px;
  border-radius: 22px;
} */

    .card-img {
      box-shadow: rgb(0 0 0 / 27%) 0px 9px 23px, rgb(0 0 0 / 20%) 0px 8px 9px;
      border-radius: 18px;
    }
  </style>
</head>

<body>

  <!-- LOADER -->
  <div id="loader">
    <div class="position-center-center">
      <div class="ldr"></div>
    </div>
  </div>

  <!-- Wrap -->
  <div id="wrap">

     @include('frontend.header')

    @yield('content')

  <!--======= FOOTER =========-->
   @include('frontend.footer')
  </div>
  <script src="{{ URL::asset('frontend/js/jquery-1.11.3.min.js')}}"></script>
  <script src="{{ URL::asset('frontend/js/bootstrap.min.js')}}"></script>
  <script src="{{ URL::asset('frontend/js/own-menu.js')}}"></script>
  <script src="{{ URL::asset('frontend/js/jquery.lighter.js')}}"></script>
  <script src="{{ URL::asset('frontend/js/owl.carousel.min.js')}}"></script>
  <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
  <script type="text/javascript" src="{{ URL::asset('frontend/rs-plugin/js/jquery.tp.t.min.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('frontend/rs-plugin/js/jquery.tp.min.js')}}"></script>
  <script src="{{ URL::asset('frontend/js/main.js')}}"></script>
  
  <script type="text/javascript">
          $(document).ready(function(){
             
              $(document).on( "input","#tentacles", function(){
            
              var quantity = parseInt($(this).parents('.quantity_parent').find('.quantity').val());
              var price = parseInt($(this).parents('.quantity_parent').find('.pro_price').val());
              var product_id = parseInt($(this).parents('.quantity_parent').find('.product_id').val());
              $this = $(this);
              $.ajax({
                type:'POST',
                dataType:'json',
                url:"{{ route('cartupdate') }}",
                data:{
                    quantity:quantity,
                    product_id:product_id,
                    _token:'{{ csrf_token() }}'
                },
                success:function(response){
                    if(response.status){
                         window.location.href = "{{ url('cart')}}"; 
                        //  var total = parseInt(quantity*price);
              
                        //   $this.parent('.quantity_parent').find('.single_total').val(total);
                        //  console.log(total);
                        //   var count = 0;
                        //   $(".single_total").each(function( index ) {
                        //     console.log( index + ": " + $this.val() );
                        //     count = parseInt(count) + parseInt($this.val());
                        //     $('.subtotal').text("$"+count);
                        //   });
                    }
                }
            });
              
            //   if (quantity1 > quantity) {
            //   $(this).parent('.quantity_parent').find('.quantity').val(quantity + 1);
            //   }
            //   var price = parseInt($(this).parent('.quantity_parent').find('.ticket_price').val());
             
            //   var updatedquantity = parseInt($(this).parent('.quantity_parent').find('.quantity').val());
            //   var total = parseInt((updatedquantity*price));
              
            //   $(this).parent('.quantity_parent').find('.single_total').val(total);
             
            //   var count = 0;
            //   $(".single_total").each(function( index ) {
            //     console.log( index + ": " + $( this ).val() );
            //     count = parseInt(count) + parseInt($(this).val());
            //     $('.subtotal').text("Subtotal $"+count);
            //   });
        
            // });
        
            // $('.decrement').on( "click", function(){
            //   var quantity = parseInt($(this).parent('.quantity_parent').find('.quantity').val());
            //   var quantity1 = parseInt($(this).parent('.quantity_parent').find('.seats').val());
            //   if(quantity >0 ){
            //     $(this).parent('.quantity_parent').find('.quantity').val(quantity - 1);
            //     var price = parseInt($(this).parent('.quantity_parent').find('.ticket_price').val());
            //     var updatedquantity = parseInt($(this).parent('.quantity_parent').find('.quantity').val());
            //     var total = parseInt((updatedquantity*price));
            //     $(this).parent('.quantity_parent').find('.single_total').val(total);
            //   }
            //   var count = 0;
            //   $(".single_total").each(function( index ) {
            //     console.log( index + ": " + $( this ).val() );
            //     count = parseInt(count) + parseInt($(this).val());
            //     $('.subtotal').text("Subtotal $"+count);
            //   });
        
            });
          });
        
          
        
        </script>
  <script>
    $(document).ready(function () {
      var silder = $(".owl-carousel");
      silder.owlCarousel({
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: false,
        items: 1,
        stagePadding: 20,
        center: true,
        nav: false,
        margin: 50,
        dots: true,
        loop: true,
        responsive: {
          0: { items: 1 },
          480: { items: 2 },
          575: { items: 2 },
          768: { items: 2 },
          991: { items: 3 },
          1200: { items: 3 }
        }
      });
    });
  </script>
<script>
var textWrapper = document.querySelector('.ml10 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml10 .letter',
    rotateY: [-90, 0],
    duration: 1300,
    delay: (el, i) => 45 * i
  }).add({
    targets: '.ml10',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
</script>



</body>
</html>