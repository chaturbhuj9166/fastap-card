@extends('include.master')
@section('page_title', 'View Agent')
@section('contant')



    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">

                <div class="col-xl-12 mx-auto">

                    <h6 class="mb-4 text-uppercase">View Franchise</h6>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong> {{ $message }} </strong>
                        </div>
                    @endif
                    
                    <hr />

                    <div class="card">

                        <div class="card-body">

                            <div class="p-4 border rounded">
                                
                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                                    <div class="col">
                                        <div class="card radius-10 border-start border-0 border-3 border-info" style="margin-bottom:40px">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary">Earning This Month </p>
                                                        <h4 class="my-1 text-info">₹{{$earningThisMonth}}</h4>
                    
                                                        <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                    </div>
                                                    <div style="margin-left: 30%;"><i class="bx bxs-cart" style="font-size: 28px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary">Orders This Month</p>
                                                        <h4 class="my-1 text-danger">{{$totalOrdersThisMonth}}</h4>
                                                        <!--<p class="mb-0 font-13">+5.4% from last week</p>-->
                                                    </div>
                                                    <div style="margin-left:30px"><i class="bx bxs-wallet" style="font-size:28px"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="card radius-10 border-start border-0 border-3 border-info" style="margin-bottom:40px">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <p class="mb-0 text-secondary">Total Orders </p>
                                                        <h4 class="my-1 text-info">{{ $TotalOrders->count() }}</h4>
                    
                                                        <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                    </div>
                                                    <div style="margin-left: 30%;"><i class="bx bxs-bar-chart-alt-2" style="font-size: 28px;"></i>
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
                                    <!-- Calculate Total Earning code Start--> 
                                        @php
                                                $totalCalculatedPercentage = 0; // Initialize the variable to store the total calculated percentage
                                        @endphp
                                        
                                        
                                        @foreach($TotalOrders as $order)
                                        
                                          <!-- Fetch related order_meta records -->
                                            <?php
                                                $totalAmount = $order->total_amount; // Replace with your actual total amount
                                                $percentage = $order->agent_commission; // Replace with the percentage you want to calculate
                                                
                                                $calculatedPercentage = ($percentage / 100) * $totalAmount;
                                                $totalCalculatedPercentage += $calculatedPercentage; // Increment the total with the current calculated value
                                            ?>
                                       
                                        
                                        @endforeach
                                    <!-- Calculate Total Earning code end --> 
                                        
                                    <p class="mb-0 text-secondary">Total Earning</p>
                                    <h4 class="my-1 text-warning">
                                        ₹ {{ $totalCalculatedPercentage }}
                                    </h4>
                                    <!--<p class="mb-0 font-13">+8.4% from last week</p>-->
                                </div>
                                <div style="margin-left:25px"><i class="bx bxs-group" style="font-size: 28px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        
                            <!-- Notification section start -->
                            
                            <div class="card-body">
                            <h5 class="pb-1 mb-4"><mark>Notification Card </mark></h5>
                            <div class="row mb-5">


                                <form method="POST" action="/admin/manageagent/storenotification">
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="title"> Title</label><br />
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Title" value="{{ old('title') }}" />

                                            <input type="hidden" name="agent_id" value="{{ $agent->id }}" />

                                            @if ($errors->has('title'))
                                                <span class="text-danger"> {{ $errors->first('title') }} </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="description">Description</label>
                                        <div class="col-sm-10">
                                            <textarea rows="6" cols="50" id="description" name="description" class="form-control"
                                                placeholder="Hi, Do you have a moment to talk User?" aria-label="Hi, Do you have a moment to talk User?"
                                                aria-describedby="basic-icon-default-message2">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger"> {{ $errors->first('description') }} </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- LAST-INTERACTION TABLE START -->
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label text-success" for="Last Interaction">last-interaction</label> --}}
                                        <label class="col-sm-2 col-form-label text-success" for="Last Interaction">Manage Notification</label>
                                        <div class="col-sm-10">
                                            <!--    <input type="text" class="form-control" id="last-interaction"-->
                                            <!--        placeholder="Add Services with Expiry" />-->
                                            <!--</div>-->
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-hover table-responsive table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($notification as $notificationList)
                                                            <tr>
                                                                <td>{{ $notificationList->created_at }}</td>
                                                                <td>{{ $notificationList->title }}</td>
                                                                <td>{{ Str::limit($notificationList->description, 20) }}
                                                                </td>
                                                                <td style="display:flex">
                                                                    <a href="/admin/editnotification/{{ $notificationList->id }}/edit/{{ $agent->id }}"><i
                                                                            class="bx bx-edit-alt me-1"></i>
                                                                        Edit</a> &nbsp;&nbsp;
                                                                    <a onclick="return window.confirm('Are you sure you want to delete this notification?')" href="/admin/deletenotification/{{ $notificationList->id }}/delete"><i
                                                                            class="fa fa-trash-o"></i> Delete </a>
                                                                      
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            {{ $notification->links() }}
                                        </div>
                                    </div>
                                    <!-- LAST-INTERACTION TABLE START END -->

                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>
                            
                            <!-- Notification section end -->
                            
                            
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    @push('footer_script')
    @endpush





@endsection
