@extends('include.master')
@section('page_title','testimonial')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Testimonial</div>
			     <div class="card-body">
				    <form method="POSt" action="{{'/admin/faq-update/'.$edit_info->id}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Edit Testimonial</label>
						  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$edit_info->name}}" name="name" placeholder="name" value="">
							  </div>
                              <p style="color:red;">@error('name'){{$message}}@enderror</p>
						  </div>
						  <input type="hidden" name="id" value="{{$edit_info->id}}">
						  
						   {{-- <label for="basic-input" class="col-sm-2 col-form-label">Image</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="file" class="form-control" value="{{old('image')}}" name="image" placeholder="categroy name" value="">
							  </div>
								<img src="{{url('uploads/faq/'.$edit_info->image)}}"  class="lightbox-thumb img-thumbnail" style="width: 150px; height: 100px;">
                              <p style="color:red;">@error('image'){{$message}}@enderror</p>
						  </div> --}}
						  </div>

						    <div class="form-group row">
						  
						    <label for="basic-input" class="col-sm-2 col-form-label">Description</label>
						  	  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<textarea type="text" class="form-control" value="" name="description" placeholder="Description" value="">{{$edit_info->description}}</textarea>
							  </div>
                              <p style="color:red;">@error('description'){{$message}}@enderror</p>
						  </div>
						  </div>
						  
<!--						  <div class="form-group row">-->
<!--<label for="basic-input" class="col-sm-5 col-form-label"> Status</label>-->
<!--<div class="col-sm-7">-->
<!--<div class="row">-->
<!--<div class="icheck-primary col-md-6">-->
<!--<input type="radio" id="primary" name="status" value="1"  checked=checked >-->
<!--<label for="primary">Active</label>-->
<!--</div>-->

<!--<div class="icheck-primary col-md-6">-->
<!--<input type="radio" id="primary1" name="status" value="0"   >-->
<!--<label for="primary1">Inactive</label>-->
<!--</div>-->
<!--</div>-->

<!--</div>-->
<!--</div>-->
						  
						  
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