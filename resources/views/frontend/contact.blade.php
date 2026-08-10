@extends('layouts.app')
@section('content')
<style>
.help__box {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    text-align: center;
    height: 100%; /* Ensures equal height */
    padding: 20px;
    background: #fff; /* Adjust based on your design */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.row.g-4 {
    display: flex;
    align-items: stretch; /* Ensures all boxes are the same height */
}

.help__box .cont {
    flex-grow: 1; /* Pushes content evenly */
}

.help__box .cont a {
    word-wrap: break-word; /* Prevents breaking layout for long addresses */
}
</style>
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
                     Contact us
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
                     <li>
                        <a href="javascript:void(0)">
                           Pages
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
                        Contact us
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

<!--Contact Section Start-->
<!--<section class="contact__section bg__white pt-120 pb-120">-->
    
<section class="contact__section bg__white pt__60 pb__60">
   <div class="container">
      <!--<div class="section__header section__center pb__60">-->
      <div class="section__header section__center pb__20">
         <h2>
            Get in touch with us.
         </h2>
         <p>
            Fill up the form and our team will get back to you within 24 hours
         </p>
      </div>
      <div class="row justify-content-center">
         <div class="col-lg-8">
            <div class="form_area">
               <!--<form id="form">-->
                <form id="form" method="POST" action="savecontact">
                      @csrf
                     <div class="row g-4">
                        <div class="col-lg-6">
                           <div class="form-control">
                                 <label for="Name">Name</label>
                                 <input type="text" id="Name" name="name" placeholder="Enter Your Nane..." required>
                                 <small>Error message</small>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-control">
                                 <label for="semail">Email</label>
                                 <input type="email" name="email" id="semail" placeholder="Enter Your Email..." required>
                                 <small>Error message</small>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-control">
                                 <label for="phone">Phone</label>
                                 <input type="number" name="sub" id="phone" placeholder="Enter Your Number..." required>
                                 <small>Error message</small>
                           </div>
                        </div>
                        <!--<div class="col-lg-6">-->
                        <!--   <label id="country">Country</label>-->
                        <!--   <div class="select-wrapper">-->
                        <!--      <select>-->
                        <!--         <option value="1">Country...</option>-->
                        <!--         <option value="1">....</option>-->
                        <!--         <option value="1">....</option>-->
                        <!--         <option value="1">....</option>-->
                        <!--         <option value="1">....</option>-->
                        <!--      </select>-->
                        <!--   </div>-->
                        <!--</div>-->
                        <div class="col-lg-12">
                           <div class="form-control">
                                  <label for="message">Message</label>
                                 <textarea name="msg" id="message" cols="10" rows="5" placeholder="Enter Your Message..." required></textarea>
                                 <small>Error message</small>
                           </div>
                        </div>
                     </div>
                     <div class="submit__btn text-center mt-4">
                        <button type="submit" class="cmn--btn">
                           <span>
                              Send Message
                           </span>
                        </button>
                     </div>
                     <div class="thank_you">
                        <p>Your Message is successfully send !</p>
                     </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!--Contact Section End-->

<!--Contact help section-->

 @php 
    $data = App\Models\websetting::first();
@endphp

<!--<section class="need__help bg__white pt-120 pb-120">-->
    
<section class="need__help bg__white pt__60 pb__60">
   <!--container-->
   <div class="container">
      <div class="section__header section__center pb__60">
         <h2>
            Need more help?
         </h2>
         <p>
            Queries, complaints and feedback. We will be happy to serve you
         </p>
      </div>
        <div class="row g-4">
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="help__box">
               <div class="icon">
                  <i class="material-symbols-outlined">
                     add_call
                  </i>
               </div>
               <div class="cont">
                  <h5>
                     Call Now
                  </h5>
                  <a href="javacript:void(0)">
                       {{$data->mobile}}
                  </a>
                  <!--<a href="javacript:void(0)">-->
                  <!--   (252) 555-0126-->
                  <!--</a>-->
               </div>
            </div>
         </div>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="help__box">
               <div class="icon icon2">
                  <i class="material-symbols-outlined">
                     mark_as_unread
                  </i>
               </div>
               <div class="cont">
                  <h5>
                     Email Address
                  </h5>
                  <a href="javascript:void(0)">
                    {{$data->email}}
                  </a>
               </div>
            </div>
         </div>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="help__box">
               <div class="icon icon3">
                  <i class="material-symbols-outlined">
                     pin_drop
                  </i>
               </div>
               <div class="cont">
                  <h5>
                     Location
                    <a href="javacript:void(0)">
                     {{$data->address}}
                    </a>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--container-->
</section>
<!--Contact help section-->



//   <script>
//       const form = document.getElementById("form");
//       const Name = document.getElementById("Name");
//       const semail = document.getElementById("semail");
//       const phone = document.getElementById("phone");
//       const message = document.getElementById("message");
//       const error = document.getElementsByClassName('error')
//       const thank = document.querySelector('.thank_you p')



//       //Error Message
//       function errorMessage(input, message) {
//       const inputElement = input.parentElement;
//       inputElement.className = "form-control error";
//       const small = inputElement.querySelector("small");
//       small.innerText = message;
//       }

//       //Success message

//       function successMessage(input) {
//          const inputElement = input.parentElement;
//          inputElement.className = "form-control success";
//       }



//       //Check Input Elements
//       function checkInputElement(inputArr) {
//       inputArr.forEach(function (input) {
//          if (input.value.trim() == "") {
//             errorMessage(input, `${inputFieldName(input)} is requerd`);
//          } else {
//             successMessage(input);
//          }
//       });
//       }

//       //Check Input inputElementNone
//       function inputElementValueEmpty(inputArr) {
//       inputArr.forEach(function (input) {
//       input.value = "";

//       const inputElement = input.parentElement;
//       inputElement.classList.remove("success");
//       });
//       }

//       //Check length
//       function checkLength(input, min, max) {
//       if (input.value.length < min) {
//          errorMessage(
//             input,
//             `${inputFieldName(input)} `
//          );
//       } else if (input.value.length > max) {
//          errorMessage(
//             input,
//             `${inputFieldName(input)} must be less than ${max} `
//          );
//       } else {
//          successMessage(input);
//       }
//       }
//       function checkNumber(input, min, max) {
//       if (input.value.length < min) {
//          errorMessage(
//             input,
//             `${inputFieldName(input)} Number `
//          );
//       } else if (input.value.length > max) {
//          errorMessage(
//             input,
//             `${inputFieldName(input)} must be less than ${max} `
//          );
//       } else {
//          successMessage(input);
//       }
//       }

//       //Check semail
//       function checksemail(semail) {
//       const regx =
//          /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//       if (regx.test(semail.value.trim())) {
//          successMessage(semail);
//       } else {
//          errorMessage(semail, "Enter Your Email");
//       }
//       }


//       //Input fields name
//       function inputFieldName(input) {
//       return input.id.charAt(0).toUpperCase() + input.id.slice(1);
//       }


//       //add event listener
//       form.addEventListener("submit", function (e) {
//       e.preventDefault();

//       checkInputElement([Name,phone,message,semail]);
//       checkLength(Name, 3, 25);
//       checkLength(message, 10, 10000000);
//       checksemail(semail);
//       checkNumber(phone,2,1000000);
//       if (error.length === 0) {
//          inputElementValueEmpty([Name,phone,message,semail]);
//          thank.style.display = "block";
//          const myTimeout = setTimeout(()=>{
//             thank.style.display = "none";
//          }, 2000);
//       }
//       });
//   </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
   
     
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@if ($message = Session::get('message_contact'))
      <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'success',
            title: '<h6>Thanks for Enquiry...</h6>'
          })
</script>
@endif

   
   
   
   
   
   
   
   
  @endsection