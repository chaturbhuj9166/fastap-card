@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Qualifiaction')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">
			   
			     <div class="container-fluid">
	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase"> Qualifiaction</div>
			     <div class="card-body">
				    <form method="POSt" action="savequalifiaction" class="form-horizontal" enctype="multipart/form-data">
                        @csrf

					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Qualifiaction Title</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{old('qualifiaction')}}" name="qualifiaction" placeholder="Qualifiaction">
							  </div>
                              <p style="color:red;">@error('qualifiaction'){{$message}}@enderror</p>
						  </div>
						  
						  
						  {{--<label for="basic-input" class="col-sm-2 col-form-label">Image</label>
						  	  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="file" class="form-control" value="{{old('image')}}" name="image" placeholder="categroy name" value="">
							  </div>
                              <p style="color:red;">@error('image'){{$message}}@enderror</p>
						  </div>
						  </div>--}}

						  <div class="form-group row">
						  
						  <label for="basic-input" class="col-sm-2 col-form-label">Description</label>
						  	  <div class="col-sm-10">
							<div class="input-group mb-3">
                            
								<textarea type="text" class="form-control" value="{{old('description')}}" name="description" placeholder="Description"></textarea>
							  </div>
                              <p style="color:red;">@error('description'){{$message}}@enderror</p>
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







<!--new-->

<!--<div class="content-wrapper">-->
<!--    <div class="container-fluid">-->
      <!-- Breadcrumbs-->
<!--      <ol class="breadcrumb">-->
<!--        <li class="breadcrumb-item">-->
<!--          <a href="#">Dashboard</a>-->
<!--        </li>-->
<!--        <li class="breadcrumb-item active">Add listing</li>-->
<!--      </ol>-->
<!--		<div class="box_general padding_bottom">-->
<!--			<div class="header_box version_2">-->
<!--				<h2><i class="fa fa-file"></i>Basic info</h2>-->
<!--			</div>-->
<!--			<div class="row">-->
<!--				<div class="col-md-6">-->
<!--					<div class="form-group">-->
<!--						<label>Course title</label>-->
<!--						<input type="text" class="form-control" placeholder="Course title">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-6">-->
<!--					<div class="form-group">-->
<!--						<label>Course price</label>-->
<!--						<input type="text" class="form-control" placeholder="Course category">-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<!-- /row-->
<!--			<div class="row">-->
<!--				<div class="col-md-6">-->
<!--					<div class="form-group">-->
<!--						<label>Course start</label>-->
<!--						<input type="text" class="form-control date-pick" placeholder="Course start">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-6">-->
<!--					<div class="form-group">-->
<!--						<label>Course expire</label>-->
<!--						<input type="email" class="form-control date-pick" placeholder="Your email">-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<!-- /row-->
<!--			<div class="row">-->
<!--				<div class="col-md-6">-->
<!--					<div class="form-group">-->
<!--						<label>Teacher name</label>-->
<!--						<input type="text" class="form-control" placeholder="Course teacher">-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<!-- /row-->
<!--			<div class="row">-->
<!--				<div class="col-md-12">-->
<!--					<div class="form-group">-->
<!--						<label>Course picture</label>-->
<!--						<form action="http://www.ansonika.com/file-upload" class="dropzone" ></form>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<!-- /row-->
<!--		</div>-->
		<!-- /box_general-->
		
<!--		<div class="box_general padding_bottom">-->
<!--			<div class="header_box version_2">-->
<!--				<h2><i class="fa fa-file-text"></i>Description</h2>-->
<!--			</div>-->
<!--			<div class="row">-->
<!--				<div class="col-md-12">-->
<!--					<div class="form-group">-->
<!--						<label>Course description</label>-->
<!--						<textarea rows="5" class="form-control" style="height:100px;" placeholder="Description"></textarea>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<!-- /row-->
<!--			<div class="row">-->
<!--				<div class="col-md-12">-->
<!--					<div class="form-group">-->
<!--						<label>Category <a href="#0" data-toggle="tooltip" data-placement="top" title="Separated by commas"><i class="fa fa-fw fa-question-circle"></i></a></label>-->
<!--						<input type="text" class="form-control" placeholder="Ex: Science, Biology...">-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<!-- /row-->
<!--		</div>-->
		<!-- /box_general-->
		
<!--		<div class="box_general padding_bottom">-->
<!--			<div class="header_box version_2">-->
<!--				<h2><i class="fa fa-video-camera"></i>Videos</h2>-->
<!--			</div>-->
<!--			<div class="row">-->
<!--				<div class="col-md-12">-->
<!--					<h6>Item</h6>-->
<!--					<table id="pricing-list-container" style="width:100%;">-->
<!--						<tr class="pricing-list-item">-->
<!--							<td>-->
<!--								<div class="row">-->
<!--									<div class="col-md-4">-->
<!--										<div class="form-group">-->
<!--											<input type="text" class="form-control" placeholder="Video title">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="col-md-3">-->
<!--										<div class="form-group">-->
<!--											<input type="text" class="form-control" placeholder="Video category">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="col-md-3">-->
<!--										<div class="form-group">-->
<!--											<input type="text" class="form-control"  placeholder="Video URL">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="col-md-2">-->
<!--										<div class="form-group">-->
<!--											<a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</td>-->
<!--						</tr>-->
<!--					</table>-->
<!--					<a href="#0" class="btn_1 gray add-pricing-list-item"><i class="fa fa-fw fa-plus-circle"></i>Add Item</a>-->
<!--					</div>-->
<!--			</div>-->
			<!-- /row-->
<!--		</div>-->
		<!-- /box_general-->
<!--		<p><a href="#0" class="btn_1 medium">Save</a></p>-->
<!--	  </div>-->
	  <!-- /.container-fluid-->
<!--   	</div>-->
@endsection