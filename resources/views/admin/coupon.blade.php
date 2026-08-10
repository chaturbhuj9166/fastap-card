@extends('include.master')
@section('page_title','Coupon')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Coupon</div>
			     <div class="card-body">
				    <form method="POSt" action="add_coupon" class="form-horizontal" enctype="multipart/form-data">
@csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Coupon Name</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Coupon name" value="">
							  </div>
                              <p style="color:red;">@error('name'){{$message}}@enderror</p>
						  </div>
						  
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Coupon Discount</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="number" class="form-control" value="{{old('discount')}}" name="discount" placeholder="Coupon Discount" value="">
							  </div>
                              <p style="color:red;">@error('discount'){{$message}}@enderror</p>
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