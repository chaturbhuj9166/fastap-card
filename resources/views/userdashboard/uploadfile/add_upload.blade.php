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



@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
  .box_general.padding_bottom {
    padding-bottom: 20px;
    background-color: #06163a !important;
    color: #6C7293;
}

.form-control {
    font-size: 14px;
    font-size: 0.875rem;
    padding: 0.65rem;
    background-color: #ffffff;
    border: 1px solid #06163a;
    border-radius: 5px;
    color: white;
}

.form-control:focus {
    /* color: #495057; */
    /* background-color: #fff; */
    /* border-color: #EB1616; */
    /* outline: none; */
    /* box-shadow: none; */
    color: #6C7293;
    background-color: #06163a;
    border-color: #f58b8b;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(235,22,22,0.25);
    color: white;
}

.savebtn {
    color: #fff;
    /* background-color: #bc1212; */
    /* border-color: #b01111; */
    background-image: linear-gradient(45deg, #13b0c1, transparent) !important;
}

.nav-link{
    /* color: #392779; */
    color: #000000 !important;
    
}

.them_change{
    background-color:#fff !important;
    
}

.them_change_second{
    background-color:#daa520 !important;
   
} 


.card_table_data {
    border: solid 1px #EB1616;
    border-radius: 8px;
    background: #06163a !important;
    padding: 10px 10px 0px;
    box-shadow: 0 0 10px #EB1616;
    margin-bottom: 15px;
    color: #6C7293;
}
</style>
@endif

    <div class="container-fluid them_change">
    <div class="row">
        

        
        
        <div class="col-md-8">
            
          <!-- anand start code -->
  
          @include('userdashboard.profilemenu')
          
         <!-- anand end code --> 
         
             <div class="profile_main_nav">
                   <form method="post" action="add_qual_hed" class="mt-3">
          @csrf
          
          @php
            $user_id = Session::get('FRONT_USER_ID');
     
          $heading = DB::table('headings')->where('userid',$user_id)->first();
          @endphp
          <div class="col-md-8">
              <div class="row">
                  <div class="col-6 mb-3">
                      <input type="hidden" name="type" value="8">
                      <input type="text" name="heading" class="form-control" style="background:white !important;color:black !important" value="{{isset($heading) && $heading->pdf !='' ? $heading->pdf : ''}}">
                  </div>
                  <div class="col-2"><button class="btn btn-success">Add</button></div>
                  
              </div>
              
          </div>
          
      </form>
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
							<label>Upload (PDF) <small class='text-primary'>Maximum 12 doc </small></label>
						<input type="file" class="form-control" name="profile[]" placeholder="file" accept="application/pdf" required multiple>
						 @error('profile.*')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
					</div>
				</div>
			</div>
			
			  @if(session()->has('success'))
                       <div class="alert alert-success">
                       {{ session()->get('success') }}
                       </div>
                        @endif
			<button type="submit" class="btn btn_1 savebtn" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
<!--	@if($errors->any())-->
<!--    {!! implode('', $errors->all('<div class="col-12 text-danger">:message</div>')) !!}-->
<!--@endif-->
                  	@isset($myfiles)
			<!--<div class='card'>-->
				<div class='card_table_data '>
			    <div class='card-header'>
			        My Files
			    </div>
			    <div class='card-body'>
			        <div class='row'>
			            @foreach(json_decode($myfiles ?? '[]') as $files)
                        @php
                            $filePath = ltrim($files, '/'); // Remove leading slash if present
                            $fileName = basename($files);  // Extract file name
                            $encodedFile = urlencode($files); // Encode file path safely
                        @endphp
                        <div class="col-3 text-center mt-2">
                            <a href="{{ asset('public/' . ltrim($files, '/')) }}" title="{{ $fileName }}" download="{{ $fileName }}">
                    
                                <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i>
                            </a>
                            <p class="mt-1" style="font-size: 12px;">{{ $fileName }}</p>
                              <!-- Delete Link -->
                                <a href="{{ url('deletefile', [$userid, $encodedFile]) }}"
                                   onclick="return confirm('Are you sure you want to delete this file?');"
                                   class="btn btn-sm btn-outline-danger mt-1">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                        </div>
                         @endforeach
			            
			             <!--<div class="col-9 mt-5">-->
			             <!--    <a href="{{url('deletefile',$userid)}}"> <i class="fa fa-trash fa-1x" aria-hidden="true"> delete</i></a>-->
			             <!--</div>-->
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