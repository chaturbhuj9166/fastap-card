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
				<h2>Profession Edit</h2>
			</div>
			<form  action="updateprofessions" method="post" enctype="multipart/form-data">
				 @csrf
				  <input type="hidden" name="id" value="{{$profession->id}}"></input>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Professions Title</label>
						<input type="text" class="form-control" value="{{$profession->profession}}" name="profession" placeholder="Professions">
					</div>
					<p style="color:red;">@error('professions'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" value="{{$profession->phone}}" name="phone" placeholder="Phone">
					</div>
					 <p style="color:red;">@error('phone'){{$message}}@enderror</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Location</label>
						<input type="text" class="form-control" value="{{$profession->location}}" name="location" placeholder="Location">
					</div>
					<p style="color:red;">@error('location'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" value="{{$profession->email}}" name="email" placeholder="Email">
					</div>
					<p style="color:red;">@error('email'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
		
			<div class="row">
				<div class="col-md-6">
						<div class="form-group">
						<label>Designation</label>
						<input type="text" class="form-control" value="{{$profession->designation??''}}" name="designation">
					</div>
					<p style="color:red;">@error('designation'){{$message}}@enderror</p>
				</div>
				
				
					<div class="col-md-6">
				    <div class="form-group">
				        <label>Website</label>
				        <input type="text" class="form-control" value="{{$profession->website}}" name="website">
				    </div>
				    <p style="color:red;">@error('website'){{$message}}@enderror</p>
				</div>
			</div>
			
				<div class="row">
			    	<div class="col-md-6">
        				<div class="form-group">
        					<label>Google map location</label>
        					<input class="form-control" name="iframe" placeholder="Paste Your Google Location Here" value="{{$profession->iframe}}" type=="url">
        				</div>
        		    </div>
        			<div class="col-md-6">
    					<div class="form-group">
    						<label>Description</label>
    						<textarea class="form-control" value="{{old('description')}}" name="description" placeholder="description">{{$profession->description}}</textarea>
    					</div>
    				</div>
    				
    				<div class="col-md-6">
					<div class="form-group">
						<label>Upload Icons</label>
						<input type="file" name="icon" class="form-control">
					</div>
				</div>
				</div>
			<!-- /row-->
			<button type="submit" class="btn btn_1 savebtn" name="submit">Update</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection