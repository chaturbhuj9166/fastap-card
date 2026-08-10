@extends('layouts.user_layout')
@section('page_title','My Photos')
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

    <div class="container-fluid them_change_second">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
      <!--fds-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Photos Edit</h2>
			</div>
			<form action="updatethought" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{$thought->id}}" />
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Portfolio Title</label>
						<input type="text" value="{{$thought->thought}}" name="thought" class="form-control" placeholder="Portfolio Title">
					</div>
					<p style="color:red;">@error('$thought'){{$message}}@enderror</p>
				</div>
				
				<!-- <div class="col-md-6">
					<div class="form-group">
						<label>Image</label>
						<input type="file" class="form-control" >
					</div>
					
				</div> -->
			</div>

			<div class="row">
				
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" value="{{$thought->description}}" name="description" placeholder="Description">{{$thought->description}}</textarea>
					</div>
					<p style="color:red;">@error('description'){{$message}}@enderror</p>
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