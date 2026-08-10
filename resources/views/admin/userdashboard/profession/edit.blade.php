@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Professions')
@section('contant')

<div class="page-wrapper">
	<div class="page-content">
			   
		<div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase">Edit Professions</div>
			     <div class="card-body">
				    <form method="POSt" action="updateprofessions" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$profession->id}}"></input>
					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Professions Title</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$profession->profession}}" name="profession" placeholder="Professions">
							  </div>
                              <p style="color:red;">@error('professions'){{$message}}@enderror</p>
						  </div>
						  
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Phone</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$profession->phone}}" name="phone" placeholder="phone">
							  </div>
                              <p style="color:red;">@error('phone'){{$message}}@enderror</p>
						  </div>
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Location</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$profession->location}}" name="location" placeholder="location">
							  </div>
                              <p style="color:red;">@error('location'){{$message}}@enderror</p>
						  </div>
						  
						
						  
						   <label for="basic-input" class="col-sm-2 col-form-label">Email</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$profession->email}}" name="email" placeholder="email">
							  </div>
                              <p style="color:red;">@error('email'){{$message}}@enderror</p>
						  </div>
						  
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Logo</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="file" class="form-control" value="{{old('image')}}" name="image">
							  </div>
                              <p style="color:red;">@error('image'){{$message}}@enderror</p>
						  </div>
						  
						   
						   <label for="basic-input" class="col-sm-2 col-form-label">Google map location</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<textarea type="text" class="form-control" name="iframe">{{$profession->iframe}}</textarea>
							  </div>
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