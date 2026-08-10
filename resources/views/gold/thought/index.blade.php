@extends('layouts.user_layout')
@section('page_title','My THOUGHT')
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
    padding-left: 12px !important;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>


<div class="container-fluid">
    
    
    
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
        <li class="breadcrumb-item active">My Thought List</li>
      </ol>
      
      
      <a href="thoughtadd" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i></a>
      <!--<a href="profile" class="btn btn-primary mb-3 float-right">View Profile</a>-->
       @include('layouts.flash-message')
		<!-- Example DataTables Card-->
		
		
		<div class="card_responsive_inmobile">
		    <div class="row">
		        <?php $i=0;?>
                  @foreach($thoughts as $settingee)
              <div class="col-md-4">
                  <div class="card_table_data">
                      <div class="card_inner_main">
                          <div class="class_inner_card">
                              <?php $i++;?>
                              {{-- <p>PID: {{$i}}</p> --}}
                              <h6>{{$settingee->thought}}</h6>
                              <p>{{$settingee->description}}</p>
                          </div>
                          {{-- <div class="class_inner_card">
                              <p class="cop">PID: {{$i}}</p>
                              <div class="profile_imgcard">
                                  @if($userdata->profile)
                                   <img src="{{ url('frontend/user_images',$userdata->profile)}}" alt="">
                                  @else
                                    <img src="{{ URL::asset('frontend/images/img_avatar3.png') }}">
                                  @endif
                            
                              </div>
                          </div> --}}
                      </div>
                      
                       <div class="card_ulist">
                              <ul>
                                  <li>
                                      <a href="editthought{{$settingee->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                  </li>
                                  <li><a href="deletethought{{$settingee->id}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
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