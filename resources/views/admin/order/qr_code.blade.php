@extends('include.master')
@section('contant')


<style>
    
    .active{
            font-size: 14px;
    background-image: linear-gradient(to right, rgb(218, 34, 255) 0%, rgb(151, 51, 238) 51%, rgb(218, 34, 255) 100%);
        
    }
    
    
    .inactive{
         font-size: 14px;
        background-image: linear-gradient(to right, rgb(255, 81, 47) 0%, rgb(240, 152, 25) 51%, rgb(255, 81, 47) 100%);
    }
  
  
  
  .qr_main a.btn {
    width: 80%;
    margin: 0 auto;
}  

.qr_main {
    margin-top:20px;
}  
</style>

<div class="page-wrapper">
<div class="page-content">

<h3 class="mt-3 mb-3">QR Code/ NFC</h3>
<div class="qr_main">
<div class="row">
    <div class="col-md-6">
                {{--<div class="col-lg-3 col-md-3 qr_div">
                    @php
                        $usermobiled = $data['mobile'];
                        $qrcode = url('profile',$usermobiled);
                    @endphp
                    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->generate($qrcode))}}">
                    <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->generate($qrcode))}}"
                        class="btn btn-primary d-block"
                        data-placement="top" title="Download" download>
                        Generate QR Code
                    </a>
                </div>--}}
        <!--<a href="#" class="btn btn-primary d-block"></a>-->
    </div>
     <div class="col-md-6">
         <a href="#" class="btn btn-primary d-block">NFC</a>
         </div>
</div>
</div>
</div>
</div>


@endsection
@stack('footer_script')