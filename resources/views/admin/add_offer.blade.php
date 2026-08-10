@extends('include.master')
@section('page_title','Offer')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Offer</div>
			     <div class="card-body">
				    <form method="POSt" action="add_offer" class="form-horizontal" enctype="multipart/form-data">
@csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Add Offer</label>
						  <div class="col-sm-">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{old('offer')}}" name="offer" placeholder="Offer Title" value="">
							  </div>
                              <p style="color:red;">@error('offer'){{$message}}@enderror</p>
						  </div>
						  
						  
					
						  
						 <p class=""><input type="submit" value="submit"  class="btn btn-success" name="submit"></p>
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