@extends('include.master')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">

	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase">Sub Categroy</div>
			     <div class="card-body">
				    <form method="POSt" action="add-subcategroy" class="form-horizontal" enctype="multipart/form-data">
@csrf

					    <div class="form-group row">
					        
					        	  <label for="basic-input" class="col-sm-2 col-form-label">Select Categroy</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
					        
<select class="form-select form-control mb-2 single-select " name="catagory_id" aria-label="Default select example">
        <option value="">--Select Categroy type--</option>
 @foreach($selectcategorys as $settingee)
 
 
                    <option  value = "{{ $settingee->id }}">{{ $settingee->categroy }} </option>
             @endforeach
             <p style="color:red;">@error('catagory_id'){{$message}}@enderror</p>
</select>
							  </div>
                              
						  </div>
					        
					        
					        
						  <label for="basic-input" class="col-sm-2 col-form-label">Add Sub Categroy</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{old('subcategroy')}}" name="subcategroy" placeholder="Sub categroy name" value="">
							  </div>
                              <p style="color:red;">@error('subcategroy'){{$message}}@enderror</p>
						  </div>
						  
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Image</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="file" class="form-control" value="{{old('image')}}" name="image" placeholder="categroy name" value="">
							  </div>
                              <p style="color:red;">@error('image'){{$message}}@enderror</p>
						  </div>
						  
						  
						 
						  <label for="basic-input" class="col-sm-2 col-form-label">Status</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
<select name="status" class="form-control single-select">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select> 
</div>
<p style="color:red;">@error('status'){{$message}}@enderror</p>
</div>

						  		  
						 <!-- <label for="basic-input" class="col-sm-3 col-form-label">Status</label>-->
						 <!-- 	  <div class="col-sm-3">-->
							<!--<div class="input-group mb-3">-->
       <!--                     <div class="checkbox">-->
							<!--	   <input type="checkbox" name="status" id="status" checked />-->
							<!--  </div>-->
							<!--      <input type="hidden" name="hidden_status" id="hidden_status" value="1" />-->


					
							<!--  </div>-->


                             
						 <!-- </div>-->
						  
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Description</label>
						  	  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<textarea type="text" class="form-control" value="{{old('editor')}}" name="editor" placeholder="Description" value=""></textarea>
							  </div>
                              <p style="color:red;">@error('editor'){{$message}}@enderror</p>
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


<!--<div class="col-sm-7">-->
<!--	<div class="form-check form-switch">-->
<!--									<input style="width: 4em; height: 2em;" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>-->
<!--								</div>-->
<!--</div>-->
    
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

@push('footer_script')

// <script>
// $(document).ready(function(){
 
//  $('#status').bootstrapToggle({
//   data-on: 'Active',
//   data-off: 'Inactive',
//   data-onstyle: 'success',
//   data-offstyle: 'danger'
//  });

//  $('#status').change(function(){
//   if($(this).prop('checked'))
//   {
//   $('#hidden_status').val('1');
//   }
//   else
//   {
//   $('#hidden_status').val('0');
//   }
//  });
// </script>

@endpush
