@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Portfolio')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Portfolio</div>
			     <div class="card-body">
				    <form method="POSt" action="saveportfolio" class="form-horizontal" enctype="multipart/form-data">
                        @csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Portfolio Title</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="title">
							  </div>
                              <p style="color:red;">@error('portfolio'){{$message}}@enderror</p>
						  </div>
						  
						 
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Image</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="file" class="form-control" value="{{old('image')}}" name="image">
							  </div>
                              <p style="color:red;">@error('image'){{$message}}@enderror</p>
						  </div>
						  </div>

						  {{--<div class="form-group row">
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Description</label>
						  	  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<textarea type="text" class="form-control" value="{{old('description')}}" name="description" placeholder="Description"></textarea>
							  </div>
                              <p style="color:red;">@error('description'){{$message}}@enderror</p>
						  </div>
						  </div>--}}
						  

						  
						  
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







<!--new design-->

@endsection