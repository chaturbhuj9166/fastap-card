@extends('layouts.user_layout')
@section('page_title','My Block')
@section('content')

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
    color: black;
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
    background-color:#1c9caa !important;
   
} 





.card_table_data {
    border: solid 1px #16dff4;
    border-radius: 8px;
    background: #06163a !important;
    padding: 10px 10px 0px;
    box-shadow: 0 0 10px #19a1af;
    margin-bottom: 15px;
    color: #6C7293;
}
</style>
@endif
    <div class="container-fluid them_change_second">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Blogs</h2>
			</div>
			
			
			 <form method="post" action="add_qual_hed" class="mt-3">
          @csrf
          
          @php
            $user_id = Session::get('FRONT_USER_ID');
     
          $heading = DB::table('headings')->where('userid',$user_id)->first();
          @endphp
          <div class="col-md-8">
              <div class="row">
                  <div class="col-6 mb-3">
                      <input type="hidden" name="type" value="10">
                      <input type="text" name="heading" class="form-control" style="background:white !important;color:black !important" value="{{isset($heading) && $heading->logo !='' ? $heading->logo : ''}}" placeholder="Enter Heading">
                  </div>
                  <div class="col-2"><button class="btn btn-success">Add</button></div>
                  
              </div>
              
          </div>
          
      </form>
		
			<form action="saveBlock" method="post" enctype="multipart/form-data">
				 @csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Blogs Title</label>
						<input type="text" class="form-control"  name="Block" placeholder="Block Title" required>
					</div>
					<p style="color:red;">@error('Block'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Image</label>
						<input type="file" class="form-control" value="" name="image" placeholder="Block Title" required>
					</div>
					<p style="color:red;">@error('Block'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" value="" name="description" placeholder="Description" required></textarea>
					</div>
					<p style="color:red;">@error('description'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<button type="submit" class="btn btn_1 savebtn" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
			@php
			$uid = session()->get('FRONT_USER_ID');
			$blocks = DB::table('blocks')->where('uid',$uid)->get();
			@endphp
			<div class="card_responsive_inmobile mt-3">
		    <div class="row">
		         <?php $i=0;?>
                  @foreach($blocks as $b)
              <div class="col-md-4">
                  <div class="card_table_data">
                      <div class="card_inner_main">
                          <div class="class_inner_card ">
                              <?php $i++;?>
                            
                              <h6>{{$b->title}}</h6>
                              <img src="{{asset('images')}}/{{$b->image}}" width="70" height="100">
                              
                          </div>
                         
                      </div>
                      
                       <div class="card_ulist">
                              <ul>
                                  <li>
                                      <a href="edit_blogs/{{$b->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                  </li>
                                  <li><a href="delete_blogs/{{$b->id}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                  <!--<li><a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy Link</a></li>-->
                                    <!--<button class="clipboard"><i class="fa fa-clone"></i> Copy</button>-->
                              </ul>
                          </div>
                  </div>
              </div>
              
               @endforeach
              
            </div>
		</div>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection