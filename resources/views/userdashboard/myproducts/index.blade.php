@extends('layouts.user_layout')
@section('page_title','My Products')
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
    border-radius: 35px;
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


button.clipboard {
    border: none;
}




</style>
@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
    .them_change{
    background-color:#fff !important;
    
}

.breadcrumb {
    background-color: #06163a !important;
    color: #6C7293;
}

.card_table_data {
    border: solid 1px #06163a;
    border-radius: 8px;
    background: #06163a !important;
    box-shadow: 0 0 10px #06163a;
    margin-bottom: 15px;
    color: #6C7293;
}

.them_change_second{
    background-color:#06163a !important;
   
} 

.nav-link{
    /* color: #392779; */
    color: #000000 !important;
    
}


</style>
@endif


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

<div class="container-fluid them_change">
    
    
    
    
     <div class="row">
        <div class="col-md-8">
            <!-- anand start code -->
      
              @include('userdashboard.profilemenu')
              
             <!-- anand end code --> 
            
            
             <div class="profile_main_nav">
                      <!-- Nav pills -->
            <!--<ul class="nav nav-pills">-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link active" data-toggle="pill" href="#myprofile">My Profile</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#myqualification">My Qualification</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#myprofession">My Profession</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#mythought">My Thought</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#myphotos">My Photos</a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" data-toggle="pill" href="#mysocial">My Social Link</a>-->
            <!--  </li>-->
            <!--</ul>-->
            
            <!-- Tab panes --> 
            <div class="tab-content mt-4">
              <div class="tab-pane container active" id="myprofile">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Products</li>
      </ol>
      
      <form method="post" action="add_qual_hed">
          @csrf
          
          @php
            $user_id = Session::get('FRONT_USER_ID');
     
          $heading = DB::table('headings')->where('userid',$user_id)->first();
          @endphp
          <div class="col-md-8">
              <div class="row">
                  <div class="col-6 mb-3">
                      <input type="hidden" name="type" value="6">
                      <input type="text" name="heading" class="form-control" style="background:white !important;color:black !important" value="{{isset($heading) && $heading->prdoducts !='' ? $heading->prdoducts : ''}}">
                  </div>
                  <div class="col-2"><button class="btn btn-success">Add</button></div>
                  
              </div>
              
          </div>
          
      </form>
      
      
      
      <a href="addmyproduct" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i></a>
      
      @if(Session::get('panel') == 1)
      <a  href="javascript::void(0)" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-download" aria-hidden="true"></i> </a>
      @endif
      <!--<a href="profile" class="btn btn-primary mb-3 float-right">View Profile</a>-->
       @include('layouts.flash-message')
		<!-- Example DataTables Card-->
		
		
		<div class="card_responsive_inmobile">
    <div class="row">
        @foreach($myproducts as $settingee)
            @php
                $img = json_decode($settingee->images);
            @endphp
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <div class="card_table_data text-center border p-2">
                    <div class="card_inner_main">
                        <a href="editmyproduct{{$settingee->id}}">
                            <img src="{{ asset('public/frontend/myproducts') }}/{{$img[0] }}"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </a>
                        <h6 class="mt-2">{{ $settingee->title }}</h6>
                    </div>
                   <div class="mt-2">
                        <a href="{{ url('editmyproduct' . $settingee->id) }}" class="btn btn-sm btn-outline-primary me-1">
                            Edit
                        </a>
                        <a href="{{ url('deletemyproduct' . $settingee->id) }}"
                           onclick="return confirm('Are you sure?')"
                           class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

		
		
		     
              </div>
              <div class="tab-pane container fade" id="myqualification">menu1.</div>
              <div class="tab-pane container fade" id="myprofession">menu2</div>
               <div class="tab-pane container fade" id="mythought">home</div>
              <div class="tab-pane container fade" id="myphotos">menu1.</div>
              <div class="tab-pane container fade" id="mysocial">menu2</div>
            </div>
            </div>
            
 
        </div>
        <div class="col-md-4">
            	<div class="mobile_main_relative">
            	    <div class="main_fixed_content">
            	                    <iframe src="{{url('profile')}}" title="description"></iframe>
            	    </div>
            	</div>
        </div>
    </div>
     
		
		
	

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_function()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="print_cata">
        <table class="table">
  <thead class="text-white color_canged" style="background: #06163a;color:white !important;">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
      <?php $n = 1;?>
      
      @if(isset($myproducts) && $myproducts!='')
      @foreach($myproducts as $settingee)
      <?php 
     
      $images = json_decode($settingee->images);
      
      ?>
    <tr>
      <th scope="row">{{$n++}}</th>
      <td><img src="{{asset('frontend/myproducts')}}/{{$images[0]}}" width="100" width="100"></td>
      <td>{{$settingee->price}}</td>
      <td>{{$settingee->sd}}</td>
    </tr>
   @endforeach
   @endif
  </tbody>
</table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="close_function()">Close</button>
        <button type="button" class="btn btn-primary" onclick="printDiv('print_cata')">Generate PDF</button>
      </div>
    </div>
  </div>
</div>	
		
		
		
		
		
	
	  </div>
  
<script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
let switchery = new Switchery(html,  { size: 'small' });
});</script>

<script>

success: function (data) {
toastr.options.closeButton = true;
toastr.options.closeMethod = 'fadeOut';
toastr.options.closeDuration = 100;
toastr.success(data.message);
}
</script>



<script>
    var $temp = $("<input>");
var $url = $(location).attr('href');

$('.clipboard').on('click', function() {
  $("body").append($temp);
  $temp.val($url).select();
  document.execCommand("copy");
  $temp.remove();
  $(".cop").text("URL copied!");
})



function printDiv(divName){
   
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
			

		}
		
		function close_function(){
		    
		  location.reload();
		}
</script>



<style>

.w-5 {
display: none;
}

.h-5{
display: none;
}

</style>
@endsection