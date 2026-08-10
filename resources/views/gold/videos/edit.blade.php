@extends('layouts.user_layout')
@section('page_title','My Video Links')
@section('content')


    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Video</h2>
			</div>
			<form method="post" action="updatemyvideo">
				@csrf
				<input type="hidden" name="id" value="{{ $video->id }}"></input>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>YouTube</label>
						<input type="url"  pattern="https://.*" class="form-control" value="{{$video->video_link}}" name="video_link" placeholder="Video Link">
					</div>
				<p style="color:red;">@error('youtube'){{$message}}@enderror</p>
				</div>
				

			</div>
			<!-- /row-->
			<button type="submit" class="btn btn_1 medium" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection