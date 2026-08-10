@extends('layouts.user_layout')
@section('page_title','My Profession')
@section('content')

<div class="container-fluid">
      <!-- Breadcrumbs-->
    
		<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> My Profession Details
          <!--<a href="professoinadd" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i></a>-->
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              
                <tr>
                  <th>Profession Name</th>
                  <td>{{$profession->profession}}</td>
                </tr>
                <tr>
                   <th>Logo</th>
                  <td><a href="{{ url('frontend/profession_logo/'.$profession->logo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{ url('frontend/profession_logo/'.$profession->logo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a></td>
                </tr>
               
                <tr>
                   <th>Phone Number</th>
                  <td>{{$profession->phone}}</td>
                </tr>
                
                <tr>
                   <th>Email</th>
                  <td>{{$profession->email}}</td>
                </tr>
                 
                <tr>
                   <th>Loaction</th>
                  <td>{!! $profession->location !!}</td>
                </tr>
                  
                <tr>
                   <th>Google map loaction</th>
                  <td>{!! $profession->iframe !!}</td>
                </tr>
             
            </table>
          </div>
        </div>
       
      </div>
	  <!-- /tables-->
	  </div>
  

@endsection