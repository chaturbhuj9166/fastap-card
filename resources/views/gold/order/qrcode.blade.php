@extends('layouts.user_layout')
@section('page_title','My Profile')
@section('content')

  <script
  src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
  integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
  crossorigin="anonymous"></script>
  
  
  
<style>
    .content-wrapper {
    min-height: calc(100vh - 62px);
    padding-top: 0.4rem;
    }



.main_fixed_content {
    background-image: url({{ URL::asset('frontendnew/images/iphonepng-f.gif')}}) !important;
     background-size: 100% 100% !important;
    padding-top: 14px;
    padding-bottom: 17px;
    padding-left: 12px;
    padding-right: 11px !important;
    border-radius: 56px;
    /* border: solid 1px; */
}

.main_fixed_content iframe {
    height: 100%;
    border: none !important;
    border-radius: 50px;
    width: 100% !important;
}
.sticky-footer .box_general  img {
    width: 220px;
}
</style>

@php

$qualification = App\Models\Profession::first();

@endphp

    <div class="container-fluid">
    <div class="row">
        
        <div class="col-md-12">
             <div class="profile_main_nav">
        
            <!-- Tab panes --> 
            <div class="tab-content mt-4">
              <div class="tab-pane container active" id="myprofile">
                  
                  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>My Profile</h2>
			</div>
			<form action="" id="form" method="" enctype="multipart/form-data">  
				 @csrf
		
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<!--<label>Url</label>-->
						<!--<input type="text" id="content" class="form-control date-pick" value="https://www.profilemeet.com/profile/{{$user->mobile}}" disabled placeholder="">-->
				   <!--<input type="hidden" class="form-control"  fixed value="https://www.profilemeet.com/profile/{{$user->mobile}} {{old('mobile')}}" required id="input-text" disabled>-->
				   
				   		<!--<input type="hidden" class="form-control"  fixed value="https://www.tap.gtsrobotics.com/profile/{{$user->mobile}} {{old('mobile')}}" required id="input-text" disabled>-->

				   		<!--<input type="hidden" class="form-control"  fixed value="https://tap.gtsrobotics.com/profile/{{$user->mobile}} {{old('mobile')}}" required id="input-text" disabled>-->

                        <input type="hidden" class="form-control"  fixed value="http://fastap.in/profile/{{$user->mobile}} {{old('mobile')}}" required id="input-text" disabled>


					</div> 
					<!--<p style="color:red;">@error('mobile'){{$message}}@enderror</p>-->
					<!--<div class="form-group">-->
					<!--	<label>Mobile</label>-->
					<!--	<input type="number" class="form-control date-pick" value="" name="mobile" placeholder="Mobile">-->
					<!--</div>-->
					<!--<p style="color:red;">@error('mobile'){{$message}}@enderror</p>-->
					
				</div>
			</div>
			<!-- /row-->
		
			<button type="submit" class="btn btn_1 medium d-block ml-auto mr-auto align-center"  name="">Generate Your QR Code</button>
		
			</form>
		</div>
                  
              </div>
            
            </div>
            </div>
            
        </div>
        
        <div class="col-md-12">
             <div class="profile_main_nav">
        
            <!-- Tab panes --> 
            <div class="tab-content mt-4">
              <div class="tab-pane container active" id="myprofile">
                  
               <div class="box_general padding_bottom">
			<div class="header_box version_2 d-flex justify-content-center">
			<h4 class="">QR Code</h4>
			</div>
			 <div class="text-center">
			  <section>
            <img id="qr-code" src="" alt="" class="mx-auto d-none">
            <canvas id="img-canvas" class="d-none" width="150" height="150"></canvas>
        </section>
         <div class="d-block" id="result">
                <p id="qr-code-for" class="mr-auto"></p>
                <a type="button" class="btn btn-success text-white" id="download">
              Download <i class="fa fa-download"></i>
            </a>
            </div>
        <footer class="container-fluid text-center">
            <p>Created using <a href="https://quickchart.io/" target="_blank">QuickChart API</a></p>
        </footer>
         	</div>
         	
		</div>
                  
              </div>
            
            </div>
            </div>
            
        </div>
        
<!--         @php-->


<!--$qualification = App\Models\Profession::first();-->

<!--@endphp-->








	
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  
<!--  <a href="/images/myw3schoolsimage.jpg" download>-->
      
<!--  <img src="/images/myw3schoolsimage.jpg" alt="W3Schools" width="104" height="142">-->
  
<!--</a>-->
  
  
  
  
  

    <style>
        img#qr-code {
            display: block !important;
        }
    </style>

    <!--<header class="jumbotron">-->
    <!--    <div class="container">-->
    <!--        <h1 class="text-center">-->
    <!--            QR Code Generator-->
    <!--        </h1>-->
    <!--    </div>-->
    <!--</header>-->
    <!--<section class="container">-->
    <!--    <form action="" id="form">-->
    <!--        <label for="input-text">Enter some text below to generate QR code:</label>-->
    <!--        <input type="text" class="form-control" placeholder="Enter any text" name="input-text" required autocomplete="off" id="input-text" oninput="setCustomValidity('')">-->
    <!--        <div class="text-center">-->
    <!--            <button type="submit" class="btn btn-primary mt-3 align-center">Submit</button>-->
    <!--        </div>-->
    <!--    </form>-->
    <!--    <section>-->
    <!--        <div class="d-block" id="result">-->
    <!--            <p id="qr-code-for" class="mr-auto"></p>-->
    <!--            <a type="button" class="btn btn-primary" id="download">-->
    <!--          Export-->
    <!--        </a>-->
    <!--        </div>-->
    <!--        <img id="qr-code" src="" alt="" class="mx-auto d-block">-->
    <!--        <canvas id="img-canvas" class="d-block" width="150" height="150"></canvas>-->
    <!--    </section>-->
    <!--    <footer class="container-fluid text-center">-->
    <!--        <p>Created using <a href="https://quickchart.io/" target="_blank">QuickChart API</a></p>-->
    <!--    </footer>-->



        <script>
            const textEl = document.getElementById("input-text");
            const formEl = document.getElementById('form');
            const qrCodeEl = document.getElementById('qr-code');
            const qrCodeForEl = document.getElementById('qr-code-for');
            const resultEl = document.getElementById('result');

            const downloadBtn = document.getElementById('download');

            const canvasEl = document.getElementById("img-canvas");
            const ctx = canvasEl.getContext("2d");
            const MIME_TYPE = "image/png";

            const URL = "https://quickchart.io/qr?text=";

            window.onload = function() {
                textEl.focus();
            };

            form.addEventListener('submit', generateQRCode);

            function generateQRCode(e) {
                //reset qr code
                qrCodeEl.src = '';
                qrCodeEl.alt = '';
                qrCodeForEl.innerHTML = '';
                resultEl.classList.remove('d-flex');
                resultEl.classList.add('d-block');
                //prevent default
                e.preventDefault();
                if (textEl.value == "" || textEl.value == null) return;
                let reg = new RegExp(/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g);
                let res = reg.test(textEl.value);
                if (res == true) {
                    textEl.setCustomValidity("Invalid field value.");
                    textEl.reportValidity();
                    return;
                }
                let input = encodeURI(textEl.value);
                //create qr code
                let qrcodeUrl = URL + input;
                //set qr code and heading
                // qrCodeForEl.innerHTML = `QR Code Generated for: <strong>${textEl.value}</strong>`;
                resultEl.classList.remove('d-block');
                // resultEl.classList.add('d-flex');
                downloadBtn.addEventListener("click", download);
                qrCodeEl.src = qrcodeUrl;
                qrCodeEl.alt = textEl.value;
                qrCodeEl.setAttribute('crossorigin', 'anonymous')
                    //clear input
                textEl.value = null;
                //focus input
                textEl.focus();
            }

            function download() {
                ctx.drawImage(qrCodeEl, 0, 0);
                var imgBase64 = canvasEl.toDataURL();
                var imgURL = "data:image/" + imgBase64;
                var dlLink = document.createElement('a');
                dlLink.download = 'qrdownload.png';
                dlLink.href = imgURL;
                dlLink.dataset.downloadurl = [MIME_TYPE, dlLink.download, dlLink.href].join(':');
                document.body.appendChild(dlLink);
                dlLink.click();
                document.body.removeChild(dlLink);
            }
        </script>


  
  
  
  
  
  
<!--<style>-->
      
<!--.qr-code {-->
<!--  max-width: 200px;-->
<!--  margin: 10px;-->
<!--}-->
  
<!--</style>-->
  
<!--  <script>-->
<!-- function htmlEncode (value){-->
<!--  return $('<div/>').text(value).html();-->
<!--}-->

<!--$(function() {-->
<!--  $("#generate").click(function() {-->
<!--    $(".qr-code").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + htmlEncode($("#content").val()) + "&chs=160x160&chld=L|0");-->
<!--  });-->
<!--});-->
<!--  </script>-->
  
  

@endsection