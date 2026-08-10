@extends('agent.layouts.main')

@section('page_title' ,'All Sub Category')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category Managment /</span> All Sub Category </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header" style="border-bottom: 1px solid rgba(0, 0, 0, .125); padding: 0.5rem 1rem;">
                    <i class="fa fa-table" aria-hidden="true"></i> Category <a style="float: right;"class="btn btn-primary"
                        href="addnewsubcategory">
                        <i class="fa fa-plus-circle" style="margin-right: 0;"aria-hidden="true"></i></a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($allsubcategory as $allsubcategoryList)
                                    <tr>
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $loop->index + 1 }}</strong>
                                        </td>

                                        @foreach ($allcategory as $allcategoryList)

                                            @if($allcategoryList->id == $allsubcategoryList->category_id)

                                            <td>{{$allcategoryList->category}} </td>
                                            {{-- <td>{{ $allsubcategoryList->category_id }} </td> --}}

                                            @endif

                                        @endforeach

                                        <td>{{ $allsubcategoryList->sub_category }} </td>

                                        @if($allsubcategoryList->status ==1)
                                        <td><span class="badge bg-label-success me-1">Active</span></td>
                                        @else
                                        <td><span class="badge bg-label-danger me-1">In Active</span></td>
                                        @endif

                                        <td>
                                            <a class="btn btn-primary" href="editsubcategory/{{ $allsubcategoryList->id }}/edit"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn btn-danger" href="allsubcategory/{{ $allsubcategoryList->id }}/delete"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
                {{ $allsubcategory->links() }}
            </div>

            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />


            <!-- / Content -->
        @endsection
