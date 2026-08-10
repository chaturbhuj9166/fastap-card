<style>
    
.tabpagenew a.nav-link {
    padding: 0 8px;
    font-size: 12px;
}

.tabpagenew a.nav-link:hover {
    background-color: #000 !important;
    color: #EB1616 !important;
}

/* for view profile & add(+) button */

.btn-primary{
    color: #fff !important;
    background-color: #EB1616 !important;;
    border-color: #EB1616 !important;;
}
.btn-primary:hover{
    color: #fff !important;
    background-color: #c81313 !important;
    border-color: #bc1212 !important;
}


/* anand start code */

.select-option {
    background: #191C24;
    color: white;
    border-color: #EB1616;
    border-radius: 8px;
    padding: 5px;
    text-align: center;
}

.select-option option {
  font-weight: bold;
  text-transform: uppercase;
}

/* anand end code */

/* for view profile & add(+) button */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 23px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.nav .nav-link {
    text-transform: uppercase;
    font-weight: bold;
}


</style>

 @if(Session::get('panel') != 1)
 <style>
 .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 23px;
    display: none;
}
 </style>
@endif

@if(Session::get('theme') == 1)
<style>
   .tabpagenew a.nav-link:hover {
    background-color: #1e96a3 !important;
    color: #fff !important;
} 

.nav-item{
    margin-right: 10px;
}

}
    
</style>
@endif

@php
$profilemenu = DB::table('profile_menu')->select('*')->first();
@endphp

  <div class="tabpagenew tabpagenew_desktop mt-4">
                <ul class="nav">
                  <li class="nav-item">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->profile == 0 ?'checked':''}} onClick="hide_funtion('profile',{{$profilemenu->profile}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->profile == 0)
                    <a class="nav-link active"  id="profile" href="{{ url('userdashboard') }}">My Profile</a>
                    @endif
                  </li>
                  <li class="nav-item">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->quali == 0 ?'checked':''}} onClick="hide_funtion('quali',{{$profilemenu->quali}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->quali == 0)
                    <a class="nav-link"  id="quali" href="{{ url('myqualification') }}">My Qualification</a>
                    @endif
                  </li>
                  <li class="nav-item">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->service == 0 ?'checked':''}} onClick="hide_funtion('service',{{$profilemenu->service}})">
  <span class="slider round"></span>
</label>
                    <!--<a class="nav-link"  href="{{ url('myprofessions') }}">My Profession</a>-->
                    
                    @if($profilemenu->service == 0)
                      <a class="nav-link"  id="service" href="{{ url('myprofessions') }}">My Services</a>
                      @endif
                  </li>
                   <li class="nav-item">
                       <label class="switch">
  <input type="checkbox" {{$profilemenu->thought == 0 ?'checked':''}} onClick="hide_funtion('thought',{{$profilemenu->thought}})">
  <span class="slider round"></span>
</label>

                    @if($profilemenu->thought == 0)
                    <a class="nav-link" id="thouht"  href="{{ url('mythought') }}">My Thought</a>
                    @endif
                  </li>
                   <li class="nav-item">
                       <label class="switch">
  <input type="checkbox" {{$profilemenu->personal == 0 ?'checked':''}} onClick="hide_funtion('personal_photos',{{$profilemenu->personal}})">
  <span class="slider round"></span>
</label>

@if($profilemenu->personal == 0)
                    <a class="nav-link"  id="per_photo" href="{{ url('myportfolio') }}">My Personal Photos</a>
                    @endif
                  </li>
                   <li class="nav-item">
                       <label class="switch">
  <input type="checkbox" {{$profilemenu->profess == 0 ?'checked':''}} onClick="hide_funtion('proffesional',{{$profilemenu->profess}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->profess == 0)
                    <a class="nav-link"  id="pro_photo" href="{{ url('professional_photos') }}">My Professional photos</a>
                    @endif
                  </li>
                   <li class="nav-item">
                       <label class="switch">
  <input type="checkbox" {{$profilemenu->videos == 0 ?'checked':''}} onClick="hide_funtion('videos',{{$profilemenu->videos}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->videos == 0)
                    <a class="nav-link" id="videos" href="{{ url('myvideos') }}">My Videos</a>
                    @endif
                  </li>
                  <li class="nav-item  mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->product == 0 ?'checked':''}} onClick="hide_funtion('products',{{$profilemenu->product}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->product == 0)
                    <a class="nav-link" id="poducts" href="{{ url('myproducts') }}">My Products</a>
                    @endif
                  </li>
                   <li class="nav-item mt-3">
                       <label class="switch">
  <input type="checkbox" {{$profilemenu->social_link == 0 ?'checked':''}} onClick="hide_funtion('social_link',{{$profilemenu->social_link}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->social_link == 0)
                    <a class="nav-link" id="social_link" href="{{ url('mysocial') }}">My Social Links</a>
                    @endif
                  </li>
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->upload_file == 0 ?'checked':''}} onClick="hide_funtion('upload_file',{{$profilemenu->upload_file}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->upload_file == 0)
                    <a class="nav-link" id="upload_file" href="{{ url('uploadfile') }}">Upload a file</a>
                    @endif
                  </li>
                  
                  
                  @if(Session::get('panel') == 1)
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->client == 0 ?'checked':''}} onClick="hide_funtion('client',{{$profilemenu->client}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->client == 0)
                    <a class="nav-link" id="client" href="{{ url('add_logo') }}">Add Logo</a>
                    @endif
                  </li>
                  
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->block == 0 ?'checked':''}} onClick="hide_funtion('block',{{$profilemenu->block}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->block == 0)
                    <a class="nav-link" id="block" href="{{ url('add_block') }}">Add Blogs</a>
                    @endif
                  </li>
                  
                  
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->google_map == 0 ?'checked':''}} onClick="hide_funtion('google_map',{{$profilemenu->google_map}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->google_map == 0)
                    <a class="nav-link" id="block" href="{{ url('add_google_map') }}">Add Map</a>
                    @endif
                  </li>
                  
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->download == 0 ?'checked':''}} onClick="hide_funtion('download',{{$profilemenu->download}})">
  <span class="slider round"></span>
</label>
@if($profilemenu->download == 0)
                    <a class="nav-link" id="block" href="{{ url('add_download') }}">Add 
                    Resume</a>
                    @endif
                  </li>
                  
                  
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->achievment == 0 ?'checked':''}} onClick="hide_funtion('achievment',{{$profilemenu->achievment}})">
  <span class="slider round"></span>
</label>
                   @if($profilemenu->achievment == 0)
                    <a class="nav-link" id="block" href="{{ url('add_achievment') }}">Add Achievment</a>
                    @endif
                  </li>
                  
                  @if(Session::get('panel') == 1)
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->ou_client == 0 ?'checked':''}} onClick="hide_funtion('ou_client',{{$profilemenu->ou_client}})">
  <span class="slider round"></span>
</label>
                   @if($profilemenu->ou_client == 0)
                    <a class="nav-link" id="block" href="{{ url('add_client') }}">Add Client</a>
                    @endif
                  </li>
                  @endif
                  @endif
                  
                  
                  @if(Session::get('panel') == 1)
                  <li class="nav-item mt-3">
                      <label class="switch">
  <input type="checkbox" {{$profilemenu->animation == 0 ?'checked':''}} onClick="hide_funtion('animation',{{$profilemenu->animation}})">
  <span class="slider round"></span>
</label>
                   @if($profilemenu->animation == 0)
                    <a class="nav-link" id="block" href="javascipt:void(0)">Animation</a>
                    @endif
                  </li>
                  @endif
                 
                  
                </ul>
            </div>
            
            
            <div class="tabpagenew tabpagenew_mobile mt-4" style="margin-top:25% !important;">
                <!--<ul class="nav">-->
                <!--  <li class="nav-item">-->
                <!--    <a class="nav-link active"  href="{{ url('userdashboard') }}">My Profile</a>-->
                <!--  </li>-->
                <!--  <li class="nav-item">-->
                <!--    <a class="nav-link"  href="{{ url('myqualification') }}">My Qualification</a>-->
                <!--  </li>-->
                <!--  <li class="nav-item">-->
                <!--    <div class="dropdown">-->
                <!--          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">-->
                <!--            More-->
                <!--          </button>-->
                <!--          <div class="dropdown-menu">-->
                            <!--<a class="dropdown-item" href="{{ url('myprofessions') }}">My Profession</a></a>-->
                <!--              <a class="dropdown-item" href="{{ url('myprofessions') }}">My Services</a></a>-->
                <!--            <a class="dropdown-item" href="{{ url('mythought') }}">My Thought</a>-->
                <!--            <a class="dropdown-item" href="{{ url('myportfolio') }}">My Personal Photos</a>-->
                <!--             <a class="dropdown-item" href="{{ url('professional_photos') }}">My Professional Photos</a>-->
                <!--             <a class="dropdown-item" href="{{ url('myvideos') }}">My Videos</a>-->
                <!--            <a class="dropdown-item" href="{{ url('mysocial') }}">My Social Links</a>-->
                <!--            <a class="dropdown-item" href="{{ url('uploadfile') }}">Upload a file test</a>-->
                <!--          </div>-->
                <!--        </div>-->
                <!--  </li>-->
                <!--</ul>-->
                
            <select class="form-select select-option" onchange="location = this.value;" >
                  <option value="{{ url('userdashboard') }}" {{ Request::is('userdashboard') ? 'selected' : '' }}>My Profile</option>
                  <option value="{{ url('myqualification') }}" {{ Request::is('myqualification') ? 'selected' : '' }}>My Qualification</option>
                  <option value="{{ url('myprofessions') }}" {{ Request::is('myprofessions') ? 'selected' : '' }}>My Services</option>
                  <option value="{{ url('mythought') }}" {{ Request::is('mythought') ? 'selected' : '' }}>My Thought</option>
                  <option value="{{ url('myportfolio') }}" {{ Request::is('myportfolio') ? 'selected' : '' }}>My Personal Photos</option>
                  <option value="{{ url('professional_photos') }}" {{ Request::is('professional_photos') ? 'selected' : '' }}>My Professional photos</option>
                  <option value="{{ url('myvideos') }}" {{ Request::is('myvideos') ? 'selected' : '' }}>My Videos</option>
                  <option value="{{ url('mysocial') }}" {{ Request::is('mysocial') ? 'selected' : '' }}>My Social Links</option>
                  <option value="{{ url('uploadfile') }}" {{ Request::is('uploadfile') ? 'selected' : '' }}>Upload a file</option>
                  <option value="{{ url('myproducts') }}" {{ Request::is('myproducts') ? 'selected' : '' }}>My Product</option>
                  <option value="{{ url('add_logo') }}" {{ Request::is('add_logo') ? 'selected' : '' }} class="switch">Add Logo</option>
                  <option value="{{ url('add_block') }}" {{ Request::is('add_block') ? 'selected' : '' }} class="switch">Add Blogs</option>
                  <option value="{{ url('add_google_map') }}" {{ Request::is('add_google_map') ? 'selected' : '' }} class="switch">Add Map</option>
                  <option value="{{ url('add_download') }}" {{ Request::is('add_download') ? 'selected' : '' }} class="switch">Add Resume</option>
                  <option value="{{ url('add_achievment') }}" {{ Request::is('add_achievment') ? 'selected' : '' }} class="switch">Add Achievment</option>
            </select>



            </div>
            
            <script>
           
            
               function hide_funtion(id,status){
                   
                    
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
                   
                  $.ajax({
        url: '/update_menu',
        method: 'post',
        data: {
            id:id,
            status:status,
           
        },
        success: function(response) {
            location.reload();
        }
    });
               }
                    
                
                
            </script>