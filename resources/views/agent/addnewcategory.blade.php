@extends('agent.layouts.main')

@section('page_title' ,'Add New Category')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Category Managment /</span> Add New Category</h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0"> Category </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="/admin/addcategory/store">
                                @csrf

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="category">Add Categroy</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="category" id="category"
                                            placeholder="Category Name" value="{{old('category')}}"/>

                                            @if($errors->has('category'))
                                            <span class="text-danger"> {{ $errors->first('category') }} </span>
                                        @endif

                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="basic-default-company"
                                            placeholder="ACME Inc." />
                                    </div>
                                </div> --}}
                                 <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="status">Status</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <label class="input-group-text" for="status">Select Status</label>
                                            <select class="form-select" id="status" name="status" id="status">
                                              <option selected value="2">Choose...</option>
                                              <option value="1">Active</option>
                                              <option value="0">Inactive</option>
                                            </select>

                                          </div>
                                          @if($errors->has('status'))
                                          <span class="text-danger"> {{ $errors->first('status') }} </span>
                                      @endif
                                    </div>

                                </div>

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                    </div>
                                </div> --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- / Content -->
    @endsection
