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
/* anand end code */

/* for view profile & add(+) button */

</style>

  <div class="tabpagenew tabpagenew_desktop mt-4">
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link active"  href="{{ url('userdashboard') }}">My Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="{{ url('myqualification') }}">My Qualification</a>
                  </li>
                  <li class="nav-item">
                    <!--<a class="nav-link"  href="{{ url('myprofessions') }}">My Profession</a>-->
                      <a class="nav-link"  href="{{ url('myprofessions') }}">My Services</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link"  href="{{ url('mythought') }}">My Thought</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link"  href="{{ url('myportfolio') }}">My Personal Photos</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link"  href="{{ url('professional_photos') }}">My Professional photos</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{ url('myvideos') }}">My Videos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('myproducts') }}">My Products</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{ url('mysocial') }}">My Social Links</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('uploadfile') }}">Upload a file</a>
                  </li>
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
            </select>



            </div>