@extends('layouts.user_layout')
@section('page_title','My Social Links')
@section('content')


    <div class="container-fluid">
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
			</div>
		
			<!-- /row-->
			<button type="submit" class="btn btn_1 medium" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection