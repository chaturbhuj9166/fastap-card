@extends('agent.layouts.main')

@section('page_title', 'View User')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> User Managment /</span> View User </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <div class="row">
                <!-- Inline text elements -->
                <div class="col">
                    <div class="card">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-header text-uppercase"> View User </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" style="color: white;"
                                    href='{{ url ("admin/edituser/$user->id/edit") }}'>
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Password</th>
                                            <td>{{ $user->password }}</td>
                                        </tr> --}}

                                        <tr>
                                            <th>SERVICES </th>
                                            <td>{{ $user->services }}</td>
                                        </tr>
                                        <tr>
                                            <th>SERVICES EXPIRY Date </th>
                                            <td>{{ $user->services_expiry_date }}</td>
                                        </tr>

                                        <tr>
                                            <th>UPLOAD DOCUMENTS</th>
                                            <td>
                                                <a target="_blank"
                                                    href='{{ url("admin/assets/img/avatars/users/$user->image") }}'
                                                    data-fancybox="images">
                                                    <img src='{{ url("admin/assets/img/avatars/users/$user->image") }}'
                                                        alt="User Image" class="lightbox-thumb img-thumbnail"
                                                        style="width: 140px; height: 70px;">
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Description </th>
                                            <td>{{ $user->description }}</td>
                                        </tr>

                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    @endsection
