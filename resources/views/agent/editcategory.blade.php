@extends('agent.layouts.main')

@section('page_title' ,'Edit Category')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Category Managment /</span> Edit Category</h4>

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

                            <form method="POST" action="/admin/editcategory/{{ $category->id }}/update">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="category">Edit Categroy</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="category" id="category"
                                            placeholder="Category Name" value="{{old('category' , $category->category)}}"/>

                                            @if($errors->has('category'))
                                            <span class="text-danger"> {{ $errors->first('category') }} </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="status">Status</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <label class="input-group-text" for="status">Select Status</label>
                                            <select class="form-select" id="status" name="status" id="status">
                                              <option  value="2">Choose...</option>
                                              <option value="1" {{$category->status == 1  ? 'selected' : ''}}>Active</option>
                                              <option value="0" {{$category->status == 0  ? 'selected' : ''}}>Inactive</option>
                                            </select>

                                          </div>
                                          @if($errors->has('status'))
                                          <span class="text-danger"> {{ $errors->first('status') }} </span>
                                      @endif
                                    </div>

                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
