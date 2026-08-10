@extends('include.master')
@section('contant')


<div class="page-wrapper">
			<div class="page-content">
				

    <div class="container-fluid">

	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> System Setting</div>
			     <div class="card-body">
				    <form method="POSt" action="admin/updatewebsetting" class="form-horizontal" enctype="multipart/form-data">
@csrf
@include('layouts.flash-message')
<input type="hidden" name="id" value="{{$upadates['id']}}">
					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Company Name</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$upadates['companynames']}}" name="companynames" placeholder="some text" value="">
							  </div>
                             
						  </div>
						</div>
					
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Email</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
							<input type="email" class="form-control" value="{{$upadates['email']}}" name="email" placeholder="Enter email" >
						  </div>
                         
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Mobile Number</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" value="{{$upadates['mobile']}}">
							  </div>
                            
						  </div>
						</div>
						
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Heading 1</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="home_banner_heading_1" placeholder="Enter heading" value="{{$upadates['home_banner_heading_1']}}">
							  </div>
                            
						  </div>
						</div>
						
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Heading 2</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="home_banner_heading_2" placeholder="Enter heading" value="{{$upadates['home_banner_heading_2']}}">
							  </div>
                            
						  </div>
						</div>

       <!--                 <div class="form-group row">-->
						 <!-- <label for="basic-input" class="col-sm-3 col-form-label">Tagline</label>-->
						 <!-- <div class="col-sm-9">-->
							<!--<div class="input-group mb-3">-->
							<!--	<textarea type="textarea" class="form-control" name="tagline" placeholder="some text">{{$upadates['tagline']}}</textarea>-->
							<!--  </div>-->
						 <!-- </div>-->
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Address</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" name="address" value="" placeholder="Enter Address">{{$upadates['address']}}</textarea>
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Logo</label>
						  <div class="col-sm-9">
                          <div class="col-sm-3">
<P> <span><input type="file" name="logo" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="logohidden" value="{{$upadates['logo']}}">
<a href="{{ url('/uploads/system_setting/'.$upadates->logo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$upadates->logo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 35px;"></a>
</div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Favicon</label>
						  <div class="col-sm-9">
                          <div class="col-sm-3">
<P> <span><input type="file" name="favicon" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="faviconhidden" value="{{$upadates['favicon']}}">
<a href="{{ url('/uploads/system_setting/'.$upadates->favicon)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$upadates->favicon)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 35px;"></a>
</div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Footer Logo</label>
						  <div class="col-sm-9">
                          <div class="col-sm-3">
<P> <span><input type="file" name="footerlogo" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="footerlogohidden" value="{{$upadates['footerlogo']}}">
<a href="{{ url('/uploads/system_setting/'.$upadates->footerlogo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$upadates->footerlogo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 35px;"></a>
</div>
						  </div>
						</div>
					
						
                        <div class="form-group row">
                        <label for="basic-input" class="col-sm-3 col-form-label">AboutUs Images</label>
                        <div class="col-sm-9">
                        <div class="col-sm-3">
<P> <span>
    <input type="file" name="Aboutimg[]" class="form-control" autocomplete="nope" multiple="multiple"></span></P>
     @foreach(json_decode($upadates->Aboutimg, true) as $key => $media_gallery)
<input type="hidden" name="Aboutimghidden" value="{{$upadates['Aboutimg']}}">
<a href="{{ url('/uploads/system_setting/'.$media_gallery) }}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$media_gallery)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 35px;"></a>
@endforeach
</div>
                        </div>
                        </div>
	
		<!--				<div class="form-group row">-->
		<!--				  <label for="basic-input" class="col-sm-3 col-form-label">AboutUs title</label>-->
		<!--				  <div class="col-sm-9">-->
		<!--					<div class="input-group mb-3">-->
		<!--						<textarea type="text" class="form-control" name="abouttitle" placeholder="some text">{{$upadates['abouttitle']}}</textarea>-->
		<!--					  </div>-->
		<!--				  </div>-->
		<!--				</div>-->

		<!--<div class="form-group row">-->
		<!--				  <label for="basic-input" class="col-sm-3 col-form-label">Aboutus Description</label>-->
		<!--				  <div class="col-sm-9">-->
		<!--					<div class="input-group mb-3">-->
		<!--						<textarea name="editor" >{{$upadates['Description']}}</textarea>-->
		<!--					  </div>-->
		<!--				  </div>-->
						</div>
						
						
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Facebook</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" name="facebook" placeholder="some url">{{$upadates['facebook']}}</textarea>
							  </div>
						  </div>
						</div>
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Instagram</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control"  name="instagram" placeholder="some url">{{$upadates['instagram']}}</textarea>
							  </div>
						  </div>
						</div>
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Twitter</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control"  name="twitter" placeholder="some url"/>{{$upadates['twitter']}}</textarea>
							  </div>
						  </div>
						</div>
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Pinterest</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" name="Pinterest" placeholder="some url">{{$upadates['pinterest']}}</textarea>
							  </div>
						  </div>
						</div>
                        <div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Linkdin</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control"  name="linkdin" placeholder="some url">{{$upadates['linkdin']}}</textarea>
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Youtube</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control"  name="youtube" placeholder="some url">{{$upadates['youtube']}}</textarea>
								<div class="input-group-append">
							  </div>
						  </div>
						</div>
						</div>
						<hr>
						<h6>Variety of Products Title</h6>
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Title</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control"  name="veriety_of_pro" placeholder="Title">{{$upadates['veriety_of_pro']}}</textarea>
								<div class="input-group-append">
							  </div>
						  </div>
						</div>
						</div>
						<hr>
						<h6>Testimonial Title</h6>
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Title</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control"  name="testimonial_title" placeholder="Title">{{$upadates['testimonial_title']}}</textarea>
								<div class="input-group-append">
							  </div>
						  </div>
						</div>
						</div>
<p class="text-center"><button type="submit" value="submit"  class="btn btn-success" name="submit">Update</button></p>

					</form>
		   
	    </div>
        </div>
								</div><!--end row-->
							</div>
					


   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
@endsection



@stack('footer_script')