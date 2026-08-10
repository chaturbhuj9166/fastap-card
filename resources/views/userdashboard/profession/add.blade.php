@extends('layouts.user_layout')
@section('page_title','My Profession')
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
				<h2>Profession</h2>
			</div>
			<form action="saveprofessions" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Profession Title</label>
						<input type="text" required class="form-control" value="{{old('professions')}}" name="profession" placeholder="Professions">
					</div>
					<p style="color:red;">@error('professions'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" value="{{old('phone')}}" name="phone" placeholder="Phone">
					</div>
					<p style="color:red;">@error('phone'){{$message}}@enderror</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Location</label>
						<input type="text" class="form-control" value="{{old('location')}}" name="location" placeholder="Location">
					</div>
					<p style="color:red;">@error('location'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email">
					</div>
					<p style="color:red;">@error('email'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
		
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Designation</label>
						<input required type="text" class="form-control" value="{{old('designation')}}" name="designation">
					</div>
					<p style="color:red;">@error('image'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
				    <div class="form-group">
				        <label>Website</label>
				        <input type="text" class="form-control" value="{{old('website')}}" name="website">
				    </div>
				</div>
				
			</div>
			
				<div class="row">
				    <div class="col-md-6">
					<div class="form-group">
						<label>Google map location</label>
						<input class="form-control" value="{{old('iframe')}}" name="iframe" placeholder="Paste Your Google Location Here" type="url">
					</div>
				</div>
			<div class="col-md-6">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" value="{{old('description')}}" name="description" placeholder="description"></textarea>
					</div>
				</div>
				
				@if(Session::get('panel') == 1)
					<div class="col-md-6">
					<div class="form-group">
						<label>Upload Icons</label>
						<input type="file" name="icon" class="form-control">
						<p style="color:red;">@error('icon'){{$message}}@enderror</p>
					</div>
				</div>
				@endif
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