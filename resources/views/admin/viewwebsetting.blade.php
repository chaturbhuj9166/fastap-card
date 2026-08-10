@extends('include.master')
@section('contant')

<div class="page-wrapper">
			<div class="page-content">

            <div class="container-fluid">
 

 <div class="row">
@foreach($viewwebsettings as $setting)
	<div class="col-lg-12">
          <div class="card">

          <div class="row">
          <div class="col-md-6"> <h5 class="card-header text-uppercase"> {{$setting['companynames']}} Details </h5></div>
           <?php $catupdate= Crypt::encrypt($setting->id);?>
          <div class="col-md-6 text-end"> <button type="button" class="btn btn-primary"><a style="color: white;" href="update{{$catupdate}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a></button></div>
          
          </div>
		 
         
            <div class="card-body">
              
			<div class="table-responsive">
	          <table class="table table-bordered">
            <thead>
              <tr>
                <th>User Name</th>
                <td>{{$setting['companynames']}}</td>
              </tr>

			  
			  <tr>
                <th>Mobile Number </th>
                <td>{{$setting['mobile']}}</td>
              </tr>
              <tr>
                <th>E-mail </th>
                <td>{{$setting['email']}}</td>
              </tr>
              
              
              <!-- <tr>-->
              <!--  <th>Tagline </th>-->
              <!--  <td>{{$setting['tagline']}}</td>-->
              <!--</tr>-->

              <tr>
                <th>Address </th>
                <td>{{$setting['address']}}</td>
              </tr>

              <tr>
                <th>Logo</th>
                <td>             <a href="{{('../uploads/system_setting/'.$setting->logo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$setting->logo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a></td>
              </tr>


              <tr>
                <th>Favicon</th>
                <td>             <a href="{{('../uploads/system_setting/'.$setting->favicon)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$setting->favicon)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a></td>
              </tr>


              <tr>
                <th>Footer Logo </th>
                <td>             <a href="{{('../uploads/system_setting/'.$setting->footerlogo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{('../uploads/system_setting/'.$setting->footerlogo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a></td>
              </tr>


              <tr>
                <th>Aboutus image </th>
                <td>            @foreach(json_decode($setting->Aboutimg, true) as $key => $media_gallery)
<a href="{{ url('/uploads/system_setting/'.$media_gallery) }}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{ url('/uploads/system_setting/'.$media_gallery) }}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a>
@endforeach</td>
              </tr>


              <!--<tr>-->
              <!--  <th>Aboutus title </th>-->
              <!--  <td>{{$setting['abouttitle']}}</td>-->
              <!--</tr>-->


              <!--<tr>-->
              <!--  <th>Aboutus Description </th>-->
              <!--  <td>{{$setting['Description']}}</td>-->
              <!--</tr>-->
              
              
               <tr>
                <th>Heading 1 </th>
                <td>{{$setting['home_banner_heading_1']}}</td>
              </tr>
              
              
               <tr>
                <th>Heading 2 </th>
                <td>{{$setting['home_banner_heading_2']}}</td>
              </tr>


              <tr>
                <th>Facebook </th>
                <td>{{$setting['facebook']}}</td>
              </tr>

              <tr>
                <th>Instagram </th>
                <td>{{$setting['instagram']}}</td>
              </tr>

              <tr>
                <th>Twitter </th>
                <td>{{$setting['twitter']}}</td>
              </tr>


              <tr>
                <th>Pinterest </th>
                <td>{{$setting['pinterest']}}</td>
              </tr>


              <tr>
                <th>Linkdin </th>
                <td>{{$setting['linkdin']}}</td>
              </tr>


              <tr>
                <th>Youtube </th>
                <td>{{$setting['youtube']}}</td>
              </tr> 
              <tr>
                <th>Variety of Products Title </th>
                <td>{{$setting['veriety_of_pro']}}</td>
              </tr> 
              <tr>
                <th>Testimonial title </th>
                <td>{{$setting['testimonial_title']}}</td>
              </tr>


             

    
			  
          </thead>
          </table>
        </div>
@endforeach

			</div>
            </div>
          </div>     
          </div>
          	</div>  
              </div>
             </div>
	 
	

            @endsection



@stack('footer_script')