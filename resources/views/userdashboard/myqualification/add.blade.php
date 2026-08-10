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
</style>
@endif

    <div class="container-fluid them_change them_change">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
			    <!--<i class="fa fa-file"></i>-->
				<h2>QUALIFIACTION</h2>
			</div>
			<form action="savequalifiaction" method="post" enctype="multipart/form-data">
				 @csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Qualifiaction Title</label>
						<input type="text" class="form-control" value="{{old('qualifiaction')}}" name="qualifiaction" placeholder="Qualifiaction" required>
					</div>
					 <p style="color:red;">@error('qualifiaction'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" value="{{old('description')}}" name="description" placeholder="Description" required></textarea>
					</div>
					<p style="color:red;">@error('description'){{$message}}@enderror</p>
				</div>
			</div>
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