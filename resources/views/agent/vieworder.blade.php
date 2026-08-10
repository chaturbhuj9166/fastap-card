@extends('agent.layouts.main')

@section('page_title', 'All Ordes')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Order Managment /</span> View Order </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header" style="border-bottom: 1px solid rgba(0, 0, 0, .125); padding: 0.5rem 1rem;">
                    <i class="fa fa-table" aria-hidden="true"></i> View Orders
                </div>

                <div class="card-body">
                    <div class="page-wrapper">
                        <div class="page-content">
                            <div class="col-sm-12">
                                <div class="container pt-5">

                                    <div class="bg-white">

                                        <div class="row">
                                            <div class="col-4">

                                                <h5>Billing # Detail</h5>

                                                <ul>
                                                    <li>Billing Detail</li>
                                                    <li>First Name: <span>{{ $order_meta->fname }}</span></li>
                                                    <li>Last Name: <span>{{ $order_meta->lname }}</span></li>
                                                    <li>Company Name: <span>{{ $order_meta->company_name }}</span></li>
                                                    <li>Email: <span>{{ $order_meta->email }}</span></li>
                                                    <li>Phone: <span>{{ $order_meta->phone }}</span></li>
                                                    <li>City: <span>{{ $order_meta->city }}</span></li>
                                                    <li>Addres: <span>{{ $order_meta->address }}</span></li>
                                                    <!--<li>Card Type:<span></span></li>-->
                                                </ul>

                                            </div>
                                            <!--     <div class="col-4">-->
                                            <!--        <h5>Shipping # Detail</h5>-->

                                            <!--  <ul>-->
                                            <!--      <li>Shipping Detail</li>-->
                                            <!--      <li>First Name: <SPAN>VIKAS</SPAN></li>-->
                                            <!--      <li>Last Name: <span>MAHESHWARI</span></li>-->
                                            <!--      <li>Company Name: <span>VIKASHMAHESHWARI FILMS</span></li>-->
                                            <!--      <li>Email: <span>vikashkabra1990@gmail.com</span></li>-->
                                            <!--      <li>Phone: <span>9799338808</span></li>-->
                                            <!--      <li>City: <span>jaipur</span></li>-->
                                            <!--      <li>Addres: <span>YASH APARTMENT FLATE NO 109 3RD FLOOR  NEAR RAHEJA HOMES PATARKAR COLONEY MANSAROVER</span></li>-->
                                            <!--  </ul>-->
                                            <!--</div>-->
                                            <div class="col-4">
                                                <p>Date: {{ $order_meta->created_at }}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="card mt-5">


                <div class="card-body">
                    <div class="page-wrapper">
                        <div class="page-content">


                            <div class="col-sm-12">
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">

                                                <div class="">
                                                    <div class="table-responsive">
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <div class="table-responsive">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Service Name</th>
                                                                    <th>Amount</th>
                                                                    <th>Name</th>
                                                                    <th>Mobile</th>
                                                                    <th>Additional Information</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        @foreach ($service as $service_List)
                                                                            @if ($order->order_id == $service_List->id)
                                                                                {{$service_List->service_name}}
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>₹{{$order->amount}}</td>
                                                                    <td>{{$order_meta->fname}} {{$order_meta->lname}}</td>

                                                                    <td>{{$order_meta->phone}}</td>
                                                                    <td>{{ Str::limit($order_meta->additional_information, 20) }}</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Total:</th>
                                                                    <td class="d-flex justify-content-end mx-5">
                                                                        <p style="margin-right: 90px"> ₹{{$order->amount}}</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />


            <!-- / Content -->
        @endsection
