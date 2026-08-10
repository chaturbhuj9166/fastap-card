@extends('agent.layouts.main')

@section('page_title', 'Dashboard')
@section('main-container')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
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
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Orders</p>
                                    <h4 class="my-1 text-success">{{ $TotalOrders->count() }}</h4>
                                    <!--<p class="mb-0 font-13">-4.5% from last week</p>-->
                                </div>
                                <div style="margin-left:30px"><i class="bx bxs-bar-chart-alt-2" style="font-size:28px"></i>
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
                                        @php
                                            $relatedOrderMeta = $order_meta->where('order_id', $order->id);
                                        @endphp
            
                                        @foreach ($relatedOrderMeta as $orderMetaItem)
                                            <?php
                                                $totalAmount = $order->total_amount; // Replace with your actual total amount
                                                $percentage = $order->agent_commission; // Replace with the percentage you want to calculate
                                                
                                                $calculatedPercentage = ($percentage / 100) * $totalAmount;
                                                $totalCalculatedPercentage += $calculatedPercentage; // Increment the total with the current calculated value
                                            ?>
                                        @endforeach
                                        
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

    </div>
    <!-- / Content -->

    @endsection
