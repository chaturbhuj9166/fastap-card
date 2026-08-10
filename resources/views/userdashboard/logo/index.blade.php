@extends('layouts.user_layout')
@section('page_title','My Qualification')
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
    color: white;
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
    background-color:#daa520 !important;
   
} 
</style>
@endif
@php
$user_id = session()->get('FRONT_USER_ID');
$logo  = DB::table('logo')->select('*')->where('uid',$user_id)->first();
@endphp
    <div class="container-fluid them_change">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
		<div class="box_general padding_bottom">
		    
		    <form method="post" action="add_qual_hed" class="mt-3">
          @csrf
          
          @php
            $user_id = Session::get('FRONT_USER_ID');
     
          $heading = DB::table('headings')->where('userid',$user_id)->first();
          @endphp
          <div class="col-md-8">
              <div class="row">
                  <div class="col-6 mb-3">
                      <input type="hidden" name="type" value="9">
                      <input type="text" name="heading" class="form-control" style="background:white !important;color:black !important" value="{{isset($heading) && $heading->logo !='' ? $heading->logo : ''}}" placeholder="Enter Heading">
                  </div>
                  <div class="col-2"><button class="btn btn-success">Add</button></div>
                  
              </div>
              
          </div>
          
      </form>
		    
			<div class="header_box version_2">
			    <!--<i class="fa fa-file"></i>-->
				<h2>ADD LOGO</h2>
			</div>
			<form action="save_logo" method="post" enctype="multipart/form-data">
				 @csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Logo</label>
						<input type="file" class="form-control"  name="logo" required>
						<input type="hidden" class="form-control"  name="oldlogo" value="{{isset($logo->logo) && $logo->logo !='' ? $logo->logo : ''}}">
					   <input type="hidden" class="form-control"  name="id" value="{{isset($logo->id) && $logo->logo !='' ? $logo->id : ''}}">

					</div>
					 <p style="color:red;">@error('logo'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<img src="{{asset('/images')}}/{{isset($logo->logo) && $logo->logo !='' ? $logo->logo : ''}}" width="100" height="100"><br><br>
			<!-- /row-->
			<button type="submit" class="btn btn_1 savebtn">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection