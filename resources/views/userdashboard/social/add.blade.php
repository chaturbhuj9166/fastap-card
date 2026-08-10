@extends('layouts.user_layout')
@section('page_title','My Social Links')
@section('content')
@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
  .box_general.padding_bottom {
    padding-bottom: 20px;
    background-color: #06163a !important;
    color: #6C7293;
}

.form-control {
    font-size: 14px;
    font-size: 0.875rem;
    padding: 0.65rem;
    background-color: #ffffff;
    border: 1px solid #06163a;
    border-radius: 5px;
    color: black;
}

.form-control:focus {
    /* color: #495057; */
    /* background-color: #fff; */
    /* border-color: #EB1616; */
    /* outline: none; */
    /* box-shadow: none; */
    color: #6C7293;
    background-color: #06163a;
    border-color: #f58b8b;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(235,22,22,0.25);
    color: white;
}

.savebtn {
    color: #fff;
    /* background-color: #bc1212; */
    /* border-color: #b01111; */
    background-image: linear-gradient(45deg, #13b0c1, transparent) !important;
}

.nav-link{
    /* color: #392779; */
    color: #000000 !important;
    
}

.them_change{
    background-color:#fff !important;
    
}

.them_change_second{
    background-color:#1c9caa !important;
   
} 


.card_table_data {
    border: solid 1px #EB1616;
    border-radius: 8px;
    background: #06163a !important;
    padding: 10px 10px 0px;
    box-shadow: 0 0 10px #EB1616;
    margin-bottom: 15px;
    color: #6C7293;
}
</style>
@endif

    <div class="container-fluid them_change_second">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Social</h2>
			</div>
			<form method="post" action="savesocial" enctype="multipart/form-data">
				@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>YouTube</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('youtube')}}" name="youtube" placeholder="https://youtube.com">
					</div>
				<p style="color:red;">@error('youtube'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Snapchat</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('snapchat')}}" name="snapchat" placeholder="https://Snapchat.com">
					</div>
					<p style="color:red;">@error('snapchat'){{$message}}@enderror</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Facebook</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('facebook')}}" name="facebook" placeholder="https://Facebook.com">
					</div>
				<p style="color:red;">@error('facebook'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Instagram</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('instagram')}}" name="instagram" placeholder="https://Instagram.com">
					</div>
					<p style="color:red;">@error('instagram'){{$message}}@enderror</p>
				</div>
			</div>
			
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Twitter</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('twitter')}}" name="twitter" placeholder="https://Twitter.com">
					</div>
				<p style="color:red;">@error('twitter'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Linkedin</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('linkdin')}}" name="linkdin" placeholder="https://Linkedin.com">
					</div>
					<p style="color:red;">@error('linkdin'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Pinterest</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('pinterest')}}" name="pinterest" placeholder="https://Pinterest.com">
					</div>
					<p style="color:red;">@error('pinterest'){{$message}}@enderror</p>
				</div>
				
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Google Review</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{old('google_review')}}" name="google_review" placeholder="https://google_review.com">
					</div>
					<p style="color:red;">@error('google_review'){{$message}}@enderror</p>
				</div>
			</div>
		
			<!-- /row-->
			<button type="submit" class="btn btn_1 savebtn" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection