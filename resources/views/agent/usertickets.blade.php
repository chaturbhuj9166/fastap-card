@extends('agent.layouts.main')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tickets Managment /</span> User Tickets </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">User Tickets</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SR NO</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Priority</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Resolve</th>
                                <th>Last Reply</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr class="odd" role="row">
                                <td>1</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td class="sorting_1">22</td>
                                <td>perferendis</td>
                                <td>2012/03/29</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm">Unresolved </a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even" role="row">
                                <td>2</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td class="sorting_1">23</td>
                                <td>molestiae</td>
                                <td>2008/12/13</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm">Unresolved </a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd" role="row">
                                <td> 3 </td>

                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td class="sorting_1">33</td>
                                <td>repudiandae </td>
                                <td>2008/11/28</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm">Unresolved </a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even" role="row">
                                <td class="">
                                    4
                                </td>

                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td class="sorting_1">39</td>
                                <td>repudiandae</td>
                                <td>2009/09/15</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm">Unresolved </a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd" role="row">
                                <td class="">
                                  5
                                </td>

                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td class="sorting_1">55</td>
                                <td>molestiae</td>
                                <td>2010/10/14</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success btn-sm">Resolved</a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even" role="row">
                                <td class="">
                                   6
                                </td>

                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td class="sorting_1">59</td>
                                <td>repudiandae</td>
                                <td>2012/08/06</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success btn-sm">Resolved</a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd" role="row">
                                <td class="">
                                  7
                                </td>

                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td class="sorting_1">61</td>
                                <td>molestiae </td>
                                <td>2011/04/25</td>
                                <td>
                                    <span class="badge badge-info">Inprogress</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success btn-sm">Resolved</a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even" role="row">
                                <td class="">
                                 8
                                </td>

                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td class="sorting_1">61</td>
                                <td>commodi</td>
                                <td>2012/12/02</td>
                                <td>
                                    <span class="badge badge-warning">On-Hold</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success btn-sm">Resolved</a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd" role="row">
                                <td class="">
                                   9
                                </td>

                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td class="sorting_1">63</td>
                                <td>perferendis </td>
                                <td>2011/07/25</td>
                                <td>
                                    <span class="badge badge-secondary">Re-Open</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success btn-sm">Resolved</a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even" role="row">
                                <td class="">
                                 10

                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td class="sorting_1">66</td>
                                <td>commodi</td>
                                <td>2009/01/12</td>
                                <td>
                                    <span class="badge badge-danger"> New </span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success btn-sm">Resolved</a>
                                </td>
                                <td>9 years ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />



            <!-- / Content -->
        @endsection
