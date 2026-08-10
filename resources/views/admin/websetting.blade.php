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
				    <form method="POSt" action="admin/websetting" class="form-horizontal" enctype="multipart/form-data">
@csrf
@include('layouts.flash-message')
					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Company Name</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{old('companynames')}}" name="companynames" placeholder="some text" value="">
							  </div>
                              <p style="color:red;">@error('companynames'){{$message}}@enderror</p>
						  </div>
						</div>
					
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Email</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
							<input type="text" class="form-control" value="{{old('email')}}" name="email" placeholder="Enter email" >
						  </div>
                          <p style="color:red;">@error('email'){{$message}}@enderror</p>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Mobile Number</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" value="{{old('mobile')}}">
							  </div>
                              <p style="color:red;">@error('mobile'){{$message}}@enderror</p>
						  </div>
						</div>

                        <div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Tagline</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="textarea" class="form-control" name="tagline" placeholder="some text"></textarea>
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Address</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Enter Address"></textarea>
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Logo</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<input type="file" class="form-control"  name="logo">
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Favicon</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">

								<input type="file" class="form-control"  name="favicon">
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Footer Logo</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
				
								<input type="file" class="form-control"  name="footerlogo">
							  </div>
						  </div>
						</div>
					
						
                        <div class="form-group row">
                        <label for="basic-input" class="col-sm-3 col-form-label">AboutUs Images</label>
                        <div class="col-sm-9">
                        <div class="input-group mb-3">
                        <input type="file" class="form-control"  name="Aboutimg[]" multiple="multiple">
                        </div>
                        </div>
                        </div>
	
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">AboutUs title</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" name="abouttitle" placeholder="some text">{{old('abouttitle')}}</textarea>
							  </div>
						  </div>
						</div>

		<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Aboutus Description</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea name="description" value="{{old('description')}}"></textarea>
							  </div>
						  </div>
						</div>
						
						
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Facebook</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" value="{{old('facebook')}}" name="facebook" placeholder="some url"></textarea>
							  </div>
						  </div>
						</div>
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Instagram</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" value="{{old('instagram')}}" name="instagram" placeholder="some url"></textarea>
							  </div>
						  </div>
						</div>
						
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Twitter</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" value="{{old('twitter')}}" name="twitter" placeholder="some url"/></textarea>
							  </div>
						  </div>
						</div>
							<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Pinterest</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" value="{{old('Pinterest')}}" name="Pinterest" placeholder="some url"></textarea>
							  </div>
						  </div>
						</div>
                        <div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Linkdin</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" value="{{old('linkdin')}}" name="linkdin" placeholder="some url"></textarea>
							  </div>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Youtube</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea type="text" class="form-control" value="{{old('youtube')}}" name="youtube" placeholder="some url"></textarea>
								<div class="input-group-append">
							  </div>
						  </div>
						</div>
						</div>
						<hr>
						<h5>Brands Logos</h5>
<p class="text-center">
    <input type="submit" value="submit"  class="btn btn-success" name="submit"></p>

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