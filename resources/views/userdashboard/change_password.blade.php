@extends('layouts.user_layout')
@section('page_title','Change Password')
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
    border: solid 1px #16dff4;
    border-radius: 8px;
    background: #06163a !important;
    padding: 10px 10px 0px;
    box-shadow: 0 0 10px #19a1af;
    margin-bottom: 15px;
    color: #6C7293;
}
</style>
@endif
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
			<button type="submit" class="btn btn_1 savebtn" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection