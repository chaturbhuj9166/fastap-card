@extends('agent.layouts.main')

@section('page_title', 'Home About')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Website Managment /</span> Home About </h4>

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
                                <h5 class="card-header text-uppercase"> Home About </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" style="color: white;"
                                    href="edithomeabout/{{ $homeabout->id }}/edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>About Us Image</th>
                                            <td>
                                                <a target="_blank"
                                                    href='{{ url("frontend/assets/images/about/home3/$homeabout->image") }}'
                                                    data-fancybox="images">
                                                    <img src='{{ url("frontend/assets/images/about/home3/$homeabout->image") }}'
                                                        alt="About Us Image" class="lightbox-thumb img-thumbnail"
                                                        style="width: 140px; height: 70px;">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $homeabout->title }}</td>
                                        </tr>

                                        <tr>
                                            <th>Description </th>
                                            <td>{!! $homeabout->description !!}</td>
                                        </tr>

                                        <tr>
                                            <th> Internal Title 1 </th>
                                            <td> {{ $homeabout->internal_title1 }}</td>
                                        </tr>
                                        <tr>
                                            <th> Internal Description 1 </th>
                                            <td>{{ $homeabout->internal_desc1 }} </td>
                                        </tr>
                                        <tr>
                                            <th> Internal Title 2 </th>
                                            <td>{{ $homeabout->internal_title2 }} </td>
                                        </tr>
                                        <tr>
                                            <th> Internal Description 2 </th>
                                            <td>{{ $homeabout->internal_desc2 }}</td>
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
