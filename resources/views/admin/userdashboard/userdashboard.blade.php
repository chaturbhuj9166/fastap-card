@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Account')
@section('contant')

		<!--start page wrapper -->
		<div class="page-wrapper">
		    @include('layouts.flash-message')
			<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
					 <div class="card radius-10 border-start border-0 border-3 border-info">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
							        @php
							        
							            $user_id =session()->get('FRONT_USER_ID');
							            $totlaorder =  DB::table('orders')->where('user_id',$user_id)->count();
							        
							        @endphp
								    <p class="mb-0 text-secondary">Total Orders</p>
									<h4 class="my-1 text-info">{{$totlaorder}}</h4>
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
								</div>
							</div>
						</div>
					 </div>
				   </div>
				   {{--<div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-danger">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Order</p>
								   <h4 class="my-1 text-danger">{{$totlaorder}}</h4>
								   <!--<p class="mb-0 font-13">+5.4% from last week</p>-->
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-success">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Category</p>
								   <h4 class="my-1 text-success"></h4>
								   <!--<p class="mb-0 font-13">-4.5% from last week</p>-->
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="bx bxs-bar-chart-alt-2" ></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-warning">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Customers</p>
								   <h4 class="my-1 text-warning"></h4>
								   <!--<p class="mb-0 font-13">+8.4% from last week</p>-->
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>--}}
				</div><!--end row-->

		  <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase">Profile</div>
			     <div class="card-body">
				    <form method="POSt" action="updateuserprofile" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
					    <div class="form-group row">
					        
					                <label for="basic-input" class="col-sm-2 col-form-label">Name</label>
            					    <div class="col-sm-4">
            							<div class="input-group mb-3">
            								<input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Name" value="">
            							  </div>
                                          <p style="color:red;">@error('name'){{$message}}@enderror</p>
            						</div>
					          
					                <label for="basic-input" class="col-sm-2 col-form-label">Email</label>
            					    <div class="col-sm-4">
            							<div class="input-group mb-3">
            								<input type="email" class="form-control" value="{{$user->email}}" name="email" placeholder="Email" disabled>
            							  </div>
                                          <p style="color:red;">@error('email'){{$message}}@enderror</p>
            						</div>
					            
    						
						  
    						
    						
    						
    						<label for="basic-input" class="col-sm-2 col-form-label">Mobile</label>
    					    <div class="col-sm-4">
    							<div class="input-group mb-3">
    								<input type="number" class="form-control" value="{{$user->mobile}}" name="mobile" placeholder="Mobile" value="">
    							  </div>
                                  <p style="color:red;">@error('mobile'){{$message}}@enderror</p>
    						</div>
    						
    						<label for="basic-input" class="col-sm-2 col-form-label">City</label>
    					    <div class="col-sm-4">
    							<div class="input-group mb-3">
    								<input type="text" class="form-control" value="{{$user->city}}" name="city" placeholder="City" value="">
    							  </div>
                                  <p style="color:red;">@error('city'){{$message}}@enderror</p>
    						</div>
    						
    						<label for="basic-input" class="col-sm-2 col-form-label">State</label>
    					    <div class="col-sm-4">
    							<div class="input-group mb-3">
    								<input type="text" class="form-control" value="{{$user->state}}" name="state" placeholder="State" value="">
    							  </div>
                                  <p style="color:red;">@error('state'){{$message}}@enderror</p>
    						</div>
    						
    					
    						
    						{{--@if(!empty($user->profile))
                                <img src="{{ url('frontend/user_images/',$user->profile)}}" alt="John Doe" class="mr-2 rounded-circle" style="width:60px;">
                            @else
                                <img src="{{ URL::asset('frontend/img_avatar3.png')}}" alt="John Doe" class="mr-2 rounded-circle" style="width:60px;">
                            @endif--}}
                            <label for="basic-input" class="col-sm-2 col-form-label">Profile Image</label>
    					    <div class="col-sm-4">
    							<div class="input-group mb-3">
    							    <input type="file" name="profile" class="form-control" >
    							 </div>
                                 <p style="color:red;">@error('profile'){{$message}}@enderror</p>
    						</div>
                         
						</div>
						 
                          
						 <p class="text-center"><input type="submit" value="submit"  class="btn btn-success" name="submit"></p>
						</div>
						</form>
						  </div>
						</div>
						  </div>

	

			</div>
		</div>
		<!--end page wrapper -->

@endsection

@stack('footer_script')