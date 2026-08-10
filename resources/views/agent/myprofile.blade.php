@extends('agent.layouts.main')
@section('page_title', 'My Profile ')
@section('main-container')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold"><span class="text-muted fw-light">My Profile</span>  </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">My Profile </h5>
                            <small class="text-muted float-end">Form</small>
                        </div>
                        <div class="card-body">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" 
                                            value="{{ old('name', $agent->name) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="mobile">Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mobile" name="mobile" 
                                            value="{{ old('mobile', $agent->mobile) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="alternative_mobile">Alternative Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alternative_mobile" name="alternative_mobile" 
                                            value="{{ old('alternative_mobile', $agent->alternative_mobile) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="address">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" name="address" 
                                            value="{{ old('address', $agent->address) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="aadhar_front">Aadhar Front</label>
                                    <div class="col-sm-10">
                                        <img src='{{ url("uploads/aadhar/aadhar_front/$agent->aadhar_front") }}' alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 90px; height: 55px;">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="mobile">Aadhar Back</label>
                                    <div class="col-sm-10">
                                        <img src='{{ url("uploads/aadhar/aadhar_back/$agent->aadhar_back") }}' alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 90px; height: 55px;">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" 
                                            value="{{ old('email', $agent->email) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="password" name="password" 
                                            value="{{ old('password', $agent->password) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="agent_code">Franchise Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="agent_code" name="agent_code" 
                                            value="{{ old('agent_code', $agent->agent_code) }}" readonly />
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="commission">Commission (%)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="commission" name="commission" 
                                            value="{{ old('commission', $agent->commission) }}" readonly />

                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="status">Status</label>
                                    <div class="col-sm-10">
                                        
                                        <?php 
                                            if($agent->status ==1){
                                                $agent_status = "Active";
                                            }else{
                                                $agent_status = "Inactive";
                                            }
                                        ?>
                                        <input type="text" class="form-control" id="status" name="status" 
                                            value="{{ old('status', $agent_status) }}" readonly />

                                    </div>
                                </div>
                               
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- / Content -->


    @endsection
