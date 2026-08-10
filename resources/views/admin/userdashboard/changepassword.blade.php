@extends('userdashboardinclude.userdashmaster')
@section('page_title','change password')
@section('contant')

<div class="page-wrapper">
    @include('layouts.flash-message')
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Change Password</div>
			     <div class="card-body">
				    <form method="POSt" action="updatepassword" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Old Password</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="password" class="form-control" value="{{old('old_password')}}" name="old_password" placeholder="Old password">
							  </div>
                              <p style="color:red;">@error('old_password'){{$message}}@enderror</p>
						  </div>
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">New Password</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="password" class="form-control" value="{{old('new_password')}}" name="new_password" placeholder="New password">
							  </div>
                              <p style="color:red;">@error('new_password'){{$message}}@enderror</p>
						  </div>
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Confirm Password</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="password" class="form-control" value="{{old('confirm_pass')}}" name="confirm_pass" placeholder="Confirm password">
							  </div>
                              <p style="color:red;">@error('confirm_pass'){{$message}}@enderror</p>
						  </div>
						 
						  </div>

						 <p class="text-center"><input type="submit" value="submit"  class="btn btn-success" name="submit"></p>
						</div>
						</form>
						  </div>
						</div>
						  </div>
						</div>
			   
			    </div>
</div>
</div>
@endsection