@extends('agent.layouts.main')

@section('page_title', 'Home Why Us')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Website Managment /</span> Home Why us? </h4>

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
                                <h5 class="card-header text-uppercase"> Home Why Us </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" style="color: white;"
                                    href="edithomewhy/{{ $homewhy->id }}/edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Why Us Image</th>
                                            <td>
                                                <a target="_blank"
                                                    href='{{ url("frontend/assets/images/video/$homewhy->image") }}'
                                                    data-fancybox="images">
                                                    <img src='{{ url("frontend/assets/images/video/$homewhy->image") }}'
                                                        alt="Why Us Image" class="lightbox-thumb img-thumbnail"
                                                        style="width: 140px; height: 70px;">
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Video Link </th>
                                            <td>{{ $homewhy->video_link }}</td>
                                        </tr>

                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $homewhy->title }}</td>
                                        </tr>


                                        <tr>
                                            <th>Description </th>
                                            <td>{!! $homewhy->description !!}</td>
                                        </tr>

                                        <tr>
                                            <th> Skillbar Title 1 </th>
                                            <td> {{ $homewhy->skillbar_title1 }}</td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Percent 1 </th>
                                            <td>{{ $homewhy->skillbar_percent1 }} %</td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Title 2 </th>
                                            <td> {{ $homewhy->skillbar_title2 }} </td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Percent 2 </th>
                                            <td>{{ $homewhy->skillbar_percent2 }} %</td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Title 3 </th>
                                            <td>{{ $homewhy->skillbar_title3 }}</td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Percent 3 </th>
                                            <td>{{ $homewhy->skillbar_percent3 }} %</td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Title 4 </th>
                                            <td>{{ $homewhy->skillbar_title4 }}</td>
                                        </tr>
                                        <tr>
                                            <th> Skillbar Percent 4 </th>
                                            <td>{{ $homewhy->skillbar_percent4 }} % </td>
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
