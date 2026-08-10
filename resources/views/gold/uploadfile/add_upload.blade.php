@extends('layouts.user_layout')
@section('page_title','My Profile')
@section('content')
<style>
    .content-wrapper {
    min-height: calc(100vh - 62px);
    padding-top: 0.4rem;
    }



.main_fixed_content {
    background-image: url({{ URL::asset('frontendnew/images/iphonepng-f.gif')}}) !important;
     background-size: 100% 100% !important;
    padding-top: 14px;
    padding-bottom: 17px;
    padding-left: 12px;
    padding-right: 11px !important;
    border-radius: 56px;
    /* border: solid 1px; */
}

.main_fixed_content iframe {
    height: 100%;
    border: none !important;
    border-radius: 50px;
    width: 100% !important;
}


.tabpagenew a.nav-link {
    padding: 0 8px;
    font-size: 12px;
}


.tabpagenew a.nav-link:hover {
    background: #392779 !important;
    color: #fff !important;
}
</style>


    <div class="container-fluid">
    <div class="row">
        

        
        
        <div class="col-md-8">
            
          <!-- anand start code -->
  
          @include('userdashboard.profilemenu')
          
         <!-- anand end code --> 
         
             <div class="profile_main_nav">
                   
            <!-- Tab panes --> 
            <div class="tab-content mt-4">
              <div class="tab-pane container active" id="myprofile">
                  
                  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>My Upload</h2>
				
				    @isset($error)
				    <div class='alert alert-danger'>
				    {{$error}}
				    </div>
				    @endisset
			
			</div>
			
			<form action="{{route('uploaddoc')}}" method="post" enctype="multipart/form-data">  
				@csrf
			<div class="row">
					<div class="col-md-12">
					<div class="form-group">
						<!--<label>Upload (PDF) <small class='text-primary'>Maximum 4 doc allow with maximum 400kb each</small></label>-->
							<label>Upload (PDF) <small class='text-primary'>Maximum 4 doc </small></label>
						<input type="file" class="form-control" name="profile[]" placeholder="file" accept="application/pdf" required multiple>
					</div>
				
				</div>
			</div>
			<button type="submit" class="btn btn_1 medium" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		
		</div>
		@if($errors->any())
    {{ implode('', $errors->all('<div class="col-12">:message</div>')) }}
@endif
                  	@isset($myfiles)
			<!--<div class='card'>-->
				<div class='card_table_data'>
			    <div class='card-header'>
			        My Files
			    </div>
			    <div class='card-body'>
			        <div class='row'>
			            @foreach(json_decode($myfiles) as $files)
    			            <div class='col-3 text-center mt-2'>
    			               <a href="{{asset($files)}}" title='{{$files}}' download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
    			            </div>
			            @endforeach
			             <div class="col-9 mt-5">
			                 <a href="{{url('deletefile',$userid)}}"> <i class="fa fa-trash fa-1x" aria-hidden="true"> delete</i></a>
			                </div>
			        </div>
			    </div>
			</div>
			@endisset
              </div>
              <!--<div class="tab-pane container fade" id="myqualification">menu1.</div>-->
              <!--<div class="tab-pane container fade" id="myprofession">menu2</div>-->
              <!-- <div class="tab-pane container fade" id="mythought">home</div>-->
              <!--<div class="tab-pane container fade" id="myphotos">menu1.</div>-->
              <!--<div class="tab-pane container fade" id="mysocial">menu2</div>-->
            </div>
            </div>
  
        </div>
        
         @php


$qualification = App\Models\Profession::first();

@endphp
        <div class="col-md-4">
            	<div class="mobile_main_relative">
            	   
            	    <div class="main_fixed_content">
            	                    <iframe src="{{url('profile')}}" title="description"></iframe>
            	      
            	    </div>
            	</div>
            	
        </div>
    </div>
	  </div>
	  <!-- /.container-fluid-->
  

@endsection