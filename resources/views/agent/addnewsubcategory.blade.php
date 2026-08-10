@extends('agent.layouts.main')

@section('page_title', 'Add New SubCategory')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Category Managment /</span> Add New Sub-Category</h4>

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
                            <h5 class="mb-0"> Sub-Category </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="/admin/addsubcategory/store" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="category_id">Select Category</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <label class="input-group-text" for="category_id"> Category</label>
                                            <select class="form-select" id="category_id" name="category_id">
                                                <option selected value="select">Select Category type...</option>

                                                @foreach ($allcategory as $allcategoryList)
                                                    <option value="{{ $allcategoryList->id, old('category_id') }}">
                                                        {{ $allcategoryList->category }} </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        @if ($errors->has('category_id'))
                                            <span class="text-danger"> {{ $errors->first('category_id') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="sub_category">Add Sub Categroy</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sub_category" name="sub_category"
                                            placeholder="Sub Category Name" value="{{ old('sub_category') }}" />
                                        @if ($errors->has('sub_category'))
                                            <span class="text-danger"> {{ $errors->first('sub_category') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="sub_category_slug">Add Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="slug" name="sub_category_slug"
                                            placeholder="Enter Slug Name" value="{{ old('sub_category_slug') }}" />
                                        @if ($errors->has('sub_category_slug'))
                                            <span class="text-danger"> {{ $errors->first('sub_category_slug') }} </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_title">Internal Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="internal_title" name="internal_title"
                                            placeholder="Internal Title" value="{{ old('internal_title') }}" />
                                        @if ($errors->has('internal_title'))
                                            <span class="text-danger"> {{ $errors->first('internal_title') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_desc">Internal Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="8" cols="50" id="internal_desc" name="internal_desc" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2">{{ old('internal_desc') }}</textarea>
                                        @if ($errors->has('internal_desc'))
                                            <span class="text-danger"> {{ $errors->first('internal_desc') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="overview_desc">Overview Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="overview_desc" id="overview_desc">{{old('overview_desc')}}</textarea>

                                        @if($errors->has('overview_desc'))
                                        <span class="text-danger"> {{ $errors->first('overview_desc') }} </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="overview_image">Overview Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="overview_image" name="overview_image" />
                                        @if ($errors->has('overview_image'))
                                            <span class="text-danger"> {{ $errors->first('overview_image') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">Pros</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="pros" id="pros">{{old('pros')}}</textarea>

                                        @if($errors->has('pros'))
                                        <span class="text-danger"> {{ $errors->first('pros') }} </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">Cons</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="cons" id="cons">{{old('cons')}}</textarea>

                                        @if($errors->has('cons'))
                                        <span class="text-danger"> {{ $errors->first('cons') }} </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="why_how_desc">Why How Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="why_how_desc" id="why_how_desc">{{old('why_how_desc')}}</textarea>

                                        @if($errors->has('why_how_desc'))
                                        <span class="text-danger"> {{ $errors->first('why_how_desc') }} </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="why_how_image">Why How Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="why_how_image" name="why_how_image" />
                                        @if ($errors->has('why_how_image'))
                                            <span class="text-danger"> {{ $errors->first('why_how_image') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Status</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <label class="input-group-text" for="status">Select Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option selected value="2">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                        @if ($errors->has('status'))
                                            <span class="text-danger"> {{ $errors->first('status') }} </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- / Content -->

    <!-- for ck editor -->
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    <!-- -->

    @endsection
