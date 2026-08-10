@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Social')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Social Edit</div>
			     <div class="card-body">
				    <form method="POSt" action="" class="form-horizontal" enctype="multipart/form-data">
                      

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">YouTube</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" name="title" placeholder="YouTube">
							  </div>
                             
						  </div>
						  <label for="basic-input" class="col-sm-2 col-form-label">Snapchat</label>
						  	   <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" name="title" placeholder="Snapchat">
							  </div>
                             
						  </div>
						  
						  
						   <label for="basic-input" class="col-sm-2 col-form-label">Facebook</label>
						  	   <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" name="title" placeholder="Facebook">
							  </div>
                             
						  </div>
						  
						   <label for="basic-input" class="col-sm-2 col-form-label">Instagram </label>
						  	   <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" name="title" placeholder="Instagram">
							  </div>
                             
						  </div>
						  
						   <label for="basic-input" class="col-sm-2 col-form-label">Twitter</label>
						  	   <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" name="title" placeholder="Twitter">
							  </div>
                             
						  </div>
						  
						   <label for="basic-input" class="col-sm-2 col-form-label">Linkedin</label>
						  	   <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" name="title" placeholder="Linkedin">
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