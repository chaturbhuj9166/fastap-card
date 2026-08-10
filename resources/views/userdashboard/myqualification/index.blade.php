@extends('layouts.user_layout')
@section('page_title','My Qualification')
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
    padding: 10px 10px 0px;
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




<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->


<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>






    <style>


button.clipboard {
    border: none;
}


/*<!--@import url('https://fonts.googleapis.com/css?family=Karla:400,700');-->*/

/*<!--body {-->*/
/*<!--  padding: 20px;-->*/
/*<!--  margin: 0;-->*/
/*<!--  color: #04048c;-->*/
/*<!--  font-family: 'Karla', sans-serif;-->*/
/*<!--}-->*/
  
/*<!--  .background {-->*/
/*<!--    background-image: linear-gradient( 135deg, #ABDCFF 10%, #0396FF 100%);-->*/
/*<!--    height: calc(100vh - 20px * 2);-->*/
/*<!--    border-radius: 5px;-->*/
/*<!--    display: flex;-->*/
/*<!--    align-items: center;-->*/
/*<!--    justify-content: center;-->*/
/*<!--  }-->*/
  
/*<!--  .clipboard {-->*/
/*<!--    border: 0;-->*/
/*<!--    padding: 15px;-->*/
/*<!--    border-radius: 3px;-->*/
/*<!--    background-image: linear-gradient( 135deg, #FDEB71 10%, #F8D800 100%);-->*/
/*<!--    cursor: pointer;-->*/
/*<!--    color: #04048c;-->*/
/*<!--    font-family: 'Karla', sans-serif;-->*/
/*<!--    font-size: 16px;-->*/
/*<!--    position: relative;-->*/
/*<!--    top: 0;-->*/
/*<!--    transition: all .2s ease;-->*/
    /* :hover {
      top: 2px;
    } */
/*<!--  }-->*/
  
/*<!--  p {-->*/
/*<!--    font-weight: 700;-->*/
/*<!--  }-->*/


    </style>


<div class="container-fluid them_change">
    <div class="row">
        <div class="col-md-8">
            
            <!-- anand start code -->
      
              @include('userdashboard.profilemenu')
              
             <!-- anand end code --> 
         
             <div class="profile_main_nav">
            
            <!-- Tab panes --> 
            <div class="tab-content mt-4">
              <div class="tab-pane container active" id="myprofile">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Qualification List</li>
        
      </ol>
      <form method="post" action="add_qual_hed">
          @csrf
          
          @php
          $user_id = Session::get('FRONT_USER_ID');
     
          $heading =DB::table('headings')->where('userid',$user_id)->first();
          @endphp
          <div class="col-md-8">
              <div class="row">
                  <div class="col-6">
                      <input type="hidden" name="type" value="0">
                      <input type="text" name="heading" class="form-control" style="background:white !important;color:black !important" value="{{isset($heading) && $heading->qual !='' ? $heading->qual : ''}}">
                  </div>
                  <div class="col-2"><button class="btn btn-success">Add</button></div>
                  
              </div>
              
          </div>
          
      </form>
      <a href="addqualification" class="btn btn-primary newbtn mb-3 mt-3"><i class="fa fa-plus" aria-hidden="true"></i></a>
      <!--<a href="profile" class="btn btn-primary mb-3 float-right">View Profile</a>-->
       @include('layouts.flash-message')
		<!-- Example DataTables Card-->
		
		
		<div class="card_responsive_inmobile">
		    <div class="row">
		        <?php $i=0;?>
                  @foreach($qualifications as $settingee)
              <div class="col-md-4">
                  <div class="card_table_data">
                      <div class="card_inner_main">
                          <div class="class_inner_card">
                              <?php $i++;?>
                             {{-- <p>PID: {{$i}}</p> --}}
                              <h6>{{$settingee->qualifiaction}}</h6>
                              <p>{{$settingee->description}}</p>
                          </div>
                          {{-- <div class="class_inner_card">
                              <p class="cop">PID: {{$settingee->id}}</p>
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
                                      <a href="editqualification{{$settingee->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                  </li>
                                  <li><a href="deletequalification{{$settingee->id}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                  <!--<li><a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy Link</a></li>-->
                                         <!--<button class="clipboard"><i class="fa fa-clone"></i> Copy</button>-->
                                          <!--<p>Have you already clicked?</p>-->
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
        @php


$qualification = App\Models\Profession::first();

@endphp
        <div class="col-md-4">
            	<div class="mobile_main_relative">
            	    <!--<div class="main_fixed_nav">-->
            	    <!--    <a href="#" class="btn"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$qualification->email}}</a><a href="#" class="btn float-right"><i class="fa fa-clone" aria-hidden="true"></i> Copy Link</a>-->
            	    <!--</div>-->
            	    <div class="main_fixed_content">
            	                    <iframe src="{{url('profile')}}" title="description"></iframe>
            	      
            	    </div>
            	</div>
        </div>
    </div>
     
      
      		                                  <div class="background">

 

</div>
		

	  <!-- /tables-->
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