@extends('layouts.user_layout')
@section('page_title','My Profile')
@section('content')
<style>
    .content-wrapper {
    min-height: calc(100vh - 62px);
    padding-top: 0.4rem;
    }



.main_fixed_content {
    background-image: url({{ URL::asset('frontendnew/images/iphonepng-f.gif')}}) !important;
     background-size: 100% 100% !important;
    padding-top: 14px;
    padding-bottom: 17px;
    padding-left: 12px;
    padding-right: 11px !important;
    border-radius: 56px;
    /* border: solid 1px; */
}

.main_fixed_content iframe {
    height: 100%;
    border: none !important;
    border-radius: 35px;
    width: 100% !important;
}

</style>


    <div class="container-fluid">
    <div class="row">
        

        
        
        <div class="col-md-8">
          
          <!-- anand start code -->
  
          @include('userdashboard.profilemenu')
          
         <!-- anand end code --> 
            
            
             <div class="profile_main_nav">
                      <!-- Nav pills -->
            <!--<ul class="nav nav-pills">-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link active" data-toggle="pill" href="#myprofile">My Profile</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#myqualification">My Qualification</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#myprofession">My Profession</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#mythought">My Thought</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#myphotos">My Photos</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#mysocial">My Social Link</a>-->
            <!--  </li>-->
            <!--</ul>-->
            
            <!-- Tab panes --> 
            <div class="tab-content mt-4">
              <div class="tab-pane container active" id="myprofile">
                  
                  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>My Profile</h2>
			</div>
			
			 @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif
			
			<form action="updateuserprofile" method="post" enctype="multipart/form-data">  
				 @csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Name"requird>
					</div>
					<p style="color:red;">@error('name'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" value="{{$user->email}}" name="email" placeholder="Email"  required>
					</div>
					<p style="color:red;">@error('email'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Mobile</label>
						<input type="number" class="form-control date-pick" disabled value="{{$user->mobile}}" name="mobile" placeholder="Mobile" requird>
					</div>
					<p style="color:red;">@error('mobile'){{$message}}@enderror</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="form-control date-pick" value="{{$user->city}}" name="city" placeholder="City" requird>
					</div>
					 <p style="color:red;">@error('city'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>State</label>
						<input type="text" class="form-control" value="{{$user->state}}" name="state" placeholder="State" requird>
						<p style="color:red;">@error('state'){{$message}}@enderror</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Profile Image</label>
						<input type="file" class="form-control" name="profile" placeholder="file" requird>
					</div>
					<p style="color:red;">@error('profile'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label>About us</label>
						<!--<input type="text" class="form-control" value="{{$user->title1}}" name="title1" placeholder="Title 1" requird>-->
						
						 <textarea rows="6" cols="50"  id="title1" name="title1" class="form-control" placeholder="200 Words" >{{old('title1',$user->title1)}}</textarea>
						 
						<p style="color:red;">@error('title1'){{$message}}@enderror</p>
					</div>
				</div>
				
				<!--<div class="col-md-6">-->
				<!--	<div class="form-group">-->
				<!--		<label>Title 2</label>-->
				<!--		<input type="text" class="form-control" value="{{$user->title2}}" name="title2" placeholder="Title 2" requird>-->
				<!--		<p style="color:red;">@error('title2'){{$message}}@enderror</p>-->
				<!--	</div>-->
				<!--</div>-->
				
				<!--<div class="col-md-6">-->
				<!--	<div class="form-group">-->
				<!--		<label>Title 3</label>-->
				<!--		<input type="text" class="form-control" value="{{$user->title3}}" name="title3" placeholder="Title 3" requird>-->
				<!--		<p style="color:red;">@error('title3'){{$message}}@enderror</p>-->
				<!--	</div>-->
				<!--</div>-->
				
				<!--<div class="col-md-6">-->
				<!--	<div class="form-group">-->
				<!--		<label>Title 4</label>-->
				<!--		<input type="text" class="form-control" value="{{$user->title4}}" name="title4" placeholder="Title 4" requird>-->
				<!--		<p style="color:red;">@error('title4'){{$message}}@enderror</p>-->
				<!--	</div>-->
				<!--</div>-->
				
			</div>
			<button type="submit" class="btn btn_1 medium" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
                  
              </div>
              <div class="tab-pane container fade" id="myqualification">menu1.</div>
              <div class="tab-pane container fade" id="myprofession">menu2</div>
               <div class="tab-pane container fade" id="mythought">home</div>
              <div class="tab-pane container fade" id="myphotos">menu1.</div>
              <div class="tab-pane container fade" id="mysocial">menu2</div>
            </div>
            </div>
            
  <!--          <div class="box_general padding_bottom">-->
		<!--	<div class="header_box version_2">-->
		<!--		<h2>My Profile</h2>-->
		<!--	</div>-->
		<!--	<form action="updateuserprofile" method="post" enctype="multipart/form-data">-->
		<!--		 @csrf-->
		<!--	<div class="row">-->
		<!--		<div class="col-md-6">-->
		<!--			<div class="form-group">-->
		<!--				<label>Name</label>-->
		<!--				<input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Name">-->
		<!--			</div>-->
		<!--			<p style="color:red;">@error('name'){{$message}}@enderror</p>-->
		<!--		</div>-->
		<!--		<div class="col-md-6">-->
		<!--			<div class="form-group">-->
		<!--				<label>Email</label>-->
		<!--				<input type="text" class="form-control" value="{{$user->email}}" name="email" placeholder="Email" disabled>-->
		<!--			</div>-->
		<!--			<p style="color:red;">@error('email'){{$message}}@enderror</p>-->
		<!--		</div>-->
		<!--	</div>-->
			<!-- /row-->
		<!--	<div class="row">-->
		<!--		<div class="col-md-6">-->
		<!--			<div class="form-group">-->
		<!--				<label>Mobile</label>-->
		<!--				<input type="number" class="form-control date-pick" value="{{$user->mobile}}" name="mobile" placeholder="Mobile">-->
		<!--			</div>-->
		<!--			<p style="color:red;">@error('mobile'){{$message}}@enderror</p>-->
		<!--		</div>-->
		<!--		<div class="col-md-6">-->
		<!--			<div class="form-group">-->
		<!--				<label>City</label>-->
		<!--				<input type="text" class="form-control date-pick" value="{{$user->city}}" name="city" placeholder="City">-->
		<!--			</div>-->
		<!--			 <p style="color:red;">@error('city'){{$message}}@enderror</p>-->
		<!--		</div>-->
		<!--	</div>-->
			<!-- /row-->
		<!--	<div class="row">-->
		<!--		<div class="col-md-6">-->
		<!--			<div class="form-group">-->
		<!--				<label>State</label>-->
		<!--				<input type="text" class="form-control" value="{{$user->state}}" name="state" placeholder="State">-->
		<!--				<p style="color:red;">@error('state'){{$message}}@enderror</p>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--			<div class="col-md-6">-->
		<!--			<div class="form-group">-->
		<!--				<label>Profile Image</label>-->
		<!--				<input type="file" class="form-control" name="profile" placeholder="file">-->
		<!--			</div>-->
		<!--			<p style="color:red;">@error('profile'){{$message}}@enderror</p>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--	<button type="submit" class="btn btn_1 medium" name="submit">Save</button>-->
			<!--<p><a href="#0" class="">Save</a></p>-->
		<!--	</form>-->
		<!--</div>-->
        </div>
        
         @php


$qualification = App\Models\Profession::first();

@endphp

        <div class="col-md-4>
            	<div class="mobile_main_relative">
            	   
            	    <div class="main_fixed_content">
            	                    <iframe src="{{url('profile')}}" title="description"></iframe>
            	      
            	    </div>
            	</div>
        </div>
    </div>
     
      
      
	
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  

@endsection