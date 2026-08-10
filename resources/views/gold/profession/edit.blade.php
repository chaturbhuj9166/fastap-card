@extends('layouts.user_layout')
@section('page_title','My Profession')
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
        					<textarea class="form-control" name="iframe" placeholder="Paste Your Google Location Here">{{$profession->iframe}}</textarea>
        				</div>
        		    </div>
        			<div class="col-md-6">
    					<div class="form-group">
    						<label>Description</label>
    						<textarea class="form-control" value="{{old('description')}}" name="description" placeholder="description">{{$profession->description}}</textarea>
    					</div>
    				</div>
				</div>
			<!-- /row-->
			<button type="submit" class="btn btn_1 medium" name="submit">Update</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection