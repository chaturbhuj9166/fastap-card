@extends('agent.layouts.main')

@section('page_title','All Users')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Managment /</span> All Users </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header" style="border-bottom: 1px solid rgba(0, 0, 0, .125); padding: 0.5rem 1rem;">
                    <i class="fa fa-table" aria-hidden="true"></i> Users <a style="float: right;"class="btn btn-primary"
                        href="addnewuser">
                        <i class="fa fa-plus-circle" style="margin-right: 0;"aria-hidden="true"></i></a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Ongoing Service</th>
                                    <th>Validity Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($allusers as $allusers_List)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                                                {{ $loop->index + 1 }}</strong></td>
                                        <td>{{ $allusers_List->name }} </td>
                                        <td>{{ $allusers_List->email }} </td>
                                        <td>{{ $allusers_List->phone }} </td>
                                        <td>{{ $allusers_List->services }} </td>


                                        <!---- FOR CONDITION VALIDITY STATUS START 	---->

                                             @if ($allusers_List->status =='NEW')
                                                <td><span class="badge bg-label-success me-1">{{ $allusers_List->status }}</span></td>
                                            @elseif ($allusers_List->status =='NEAR_EXPIRE')
                                                <td><span class="badge bg-label-warning me-1">{{ $allusers_List->status }}</span></td>
                                            @elseif ($allusers_List->status =='EXPIRED')
                                                <td><span class="badge bg-label-danger me-1">{{ $allusers_List->status }}</span></td>
                                            @endif
                                        <!---- FOR CONDITION VALIDITY STATUS END 	---->

                                        <td>
                                            <a class="btn btn-primary" href="edituser/{{ $allusers_List->id }}/edit"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn btn-info" href="viewuser/{{ $allusers_List->id }}/view"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>

                                            <a class="btn btn-dark" href="manageuser/{{ $allusers_List->id }}/manage"><i class="fa fa-tasks" aria-hidden="true"></i>

                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
                {{ $allusers->links() }}
            </div>

            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />


            <!-- / Content -->
        @endsection
