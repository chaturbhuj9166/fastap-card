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
    padding-left: 15px;
    padding-right: 11px !important;
    border-radius: 56px;
    /* border: solid 1px; */
}
.main_fixed_content iframe {
    height: 100%;
    border: none !important;
    border-radius: 35px;
}
</style>

@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
   .them_change{
    background-color:#fff !important;
    
}

.them_change_second{
    background-color:#06163a !important;
   
} 
 ul#exampleAccordion {
    background: #06163a !important;
}  

a {
    /* color: #392779; */
    color: #000000;
    text-decoration: none;
    -moz-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    outline: none;
}
</style>
@endif	
    <div class="container-fluid them_change">
    <div class="row">
        <div class="col-md-8">
             <div class="tabpagenew mt-4">
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link active"  href="{{ url('myorder') }}">All Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="{{ url('trackyourorder') }}">Track Your Order</a>
                  </li>
                 
                </ul>
            </div>
            
            
            
            
             <div class="profile_main_nav mt-5">
           
     
                  
                  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Track Your Order</h2>
			</div>
			<form method="post" enctype="multipart/form-data">  
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Enter Your Order Id</label>
						<input type="text" class="form-control" name="name" placeholder="Order Id">
					</div>
				
				</div>
			
			</div>
		
		
			<button type="button" class="btn btn_1 medium" name="submit" onClick="myFunction()">Submit</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
              
              
            </div>
            

        </div>
        
       
    </div>
     
      
      
	
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
<script>
function myFunction() {
  alert("No Data Found");
}
</script
@endsection