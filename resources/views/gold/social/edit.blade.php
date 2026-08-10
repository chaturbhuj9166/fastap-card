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
			<form method="post" action="updatesocial" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{ $social->id }}"></input>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>YouTube</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$social->youtube}}" name="youtube" placeholder="Youtube">
					</div>
				<p style="color:red;">@error('youtube'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Snapchat</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$social->snapchat}}" name="snapchat" placeholder="Snapchat">
					</div>
					<p style="color:red;">@error('snapchat'){{$message}}@enderror</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Facebook</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$social->facebook}}" name="facebook" placeholder="Facebook">
					</div>
				<p style="color:red;">@error('facebook'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Instagram</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$social->instagram}}" name="instagram" placeholder="Instagram">
					</div>
					<p style="color:red;">@error('instagram'){{$message}}@enderror</p>
				</div>
			</div>
			
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Twitter</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$social->twitter}}" name="twitter" placeholder="Twitter">
					</div>
				<p style="color:red;">@error('twitter'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Linkedin</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$social->linkdin}}" name="linkdin" placeholder="Linkedin">
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