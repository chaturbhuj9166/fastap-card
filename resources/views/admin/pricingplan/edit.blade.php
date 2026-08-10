@extends('include.master')
@section('page_title','pricing_plan')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Pricing Plan</div>
			     <div class="card-body">
				    <form method="POSt" action="updatetesprice" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label"> Card Name</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$price->name}}" name="name" placeholder="name" value="">
							  </div>
                              <p style="color:red;">@error('name'){{$message}}@enderror</p>
						  </div>
						  <label for="basic-input" class="col-sm-2 col-form-label">Card price</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$price->price}}" name="price" placeholder="price" value="">
							  </div>
                              <p style="color:red;">@error('name'){{$message}}@enderror</p>
						  </div>
						  <input type="hidden" name="id" value="{{$price->id}}">
						  
						  
						  	 
						  </div>



<div class="form-group row">
        <label for="basic-input" class="col-sm-2 col-form-label">Product Image</label>
        <div class="col-sm-4">
        <div class="col-sm-12">
<P> <span><input type="file" name="image" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="logohidden" value="{{$price['image']}}">
<img src="{{('../uploads/price/'.$price->image)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 90px; height: 55px;">
</div>
        </div>

   <!--     <label for="basic-input" class="col-sm-2 col-form-label">Product Images</label>-->
   <!--     <div class="col-sm-4">-->
   <!--     <div class="col-sm-12">-->
   <!--         <P> <span><input type="file" name="pro_multi_img[]" multiple="multiple" class="form-control" autocomplete="nope" ></span></P>-->

   <!--    @foreach($price as $media_gallery)-->
   <!--<a href="{{ url('../uploads/price/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">-->
   <!--<img src="{{ url('../uploads/price/'.$media_gallery) }}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 90px; height: 55px;">-->
   <!--</a>-->
   <!--@endforeach-->
   <!--     </div>-->
   <!--   </div>-->
      </div>
      






						    <div class="form-group row">
						  
						    <label for="basic-input" class="col-sm-2 col-form-label">Short Description</label>
						  	  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<!--<textarea type="text" class="form-control" value="" name="short_des" placeholder="short_des" value="">{{$price->short_des}}</textarea>-->
										<textarea type="text"  class="form-control" placeholder="Enter price plan Your Product Short Description" name="editor1" rows="5" >{{$price->short_des}}</textarea>

							  </div>
                              <p style="color:red;">@error('description'){{$message}}@enderror</p>
						  </div>
						  
						   <label for="basic-input" class="col-sm-2 col-form-label">Long Description</label>
						  	  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<!--<textarea type="text" class="form-control" value="" name="editor" placeholder="Description" value="">{{$price->long_des}}</textarea>-->
		<textarea type="text"  class="form-control" value="" placeholder="Enter Your price plan Short Description" name="editor" rows="5" >{{$price->long_des}}</textarea>

							  </div>
                              <p style="color:red;">@error('long_des'){{$message}}@enderror</p>
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