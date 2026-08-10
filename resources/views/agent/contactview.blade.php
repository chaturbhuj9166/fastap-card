@extends('agent.layouts.main')

@section('page_title', 'View Contact')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Website Managment /</span> Contact View </h4>


            <!-- Basic Bootstrap Table -->
            <div class="card">

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-header text-uppercase"> Contact View </h5>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$contactview->name}}</td>
                                </tr>


                                <tr>
                                    <th>Mobile Number </th>
                                    <td>{{$contactview->mobile}}</td>
                                </tr>
                                <tr>
                                    <th>E-mail </th>
                                    <td>{{$contactview->email}}</td>
                                </tr>

                                <tr>
                                    <th>Address </th>
                                    <td>{{$contactview->address}}</td>
                                </tr>

                                <tr>
                                    <th>Message</th>
                                    <td>{{$contactview->message}}</td>
                                </tr>

                            </thead>
                        </table>
                    </div>

                </div>
            </div>

            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />


            <!-- / Content -->
        @endsection
