@extends('layouts.user_layout')
@section('page_title','Change Password')
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
				<h2><i class="fa fa-file"></i>Change Password</h2>
				 @include('layouts.flash-message')
			</div>
			<form method="post" action="updatepassword" enctype="multipart/form-data">
				 @csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Old Password</label>
						<input type="password" value="{{old('old_password')}}" name="old_password" class="form-control" placeholder="Old Password">
					</div>
					<p style="color:red;">@error('old_password'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>New Password</label>
						<input type="password" value="{{old('new_password')}}" name="new_password" class="form-control" placeholder="New Password">
					</div>
					<p style="color:red;">@error('new_password'){{$message}}@enderror</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" value="{{old('confirm_pass')}}" name="confirm_pass" placeholder="Confirm Password">
					</div>
					<p style="color:red;">@error('confirm_pass'){{$message}}@enderror</p>
				</div>
			
			</div>
			<!-- /row-->
		
		
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