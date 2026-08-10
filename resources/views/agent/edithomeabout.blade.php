@extends('agent.layouts.main')

@section('page_title', ' Edit Home About')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Website Managment /</span> Edit Home About</h4>

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
                            <h5 class="mb-0"> Home Home About </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admin/edithomeabout/{{ $homeabout->id }}/update"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="image"> ABOUT US IMAGE</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image" id="image" />
                                        @if ($errors->has('image'))
                                            <span class="text-danger"> {{ $errors->first('image') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <a target="_blank"
                                            href='{{ url("frontend/assets/images/about/home3/$homeabout->image") }}'
                                            data-fancybox="images">
                                            <img src='{{ url("frontend/assets/images/about/home3/$homeabout->image") }}'
                                                alt="About Us Image" class="lightbox-thumb img-thumbnail"
                                                style="width: 140px; height: 70px;">
                                        </a>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="title"> Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Title" value="{{ old('title', $homeabout->title) }}" />

                                        @if ($errors->has('title'))
                                            <span class="text-danger"> {{ $errors->first('title') }} </span>
                                        @endif

                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="description" id="description">{{old('why_how_desc',$homeabout->description)}}</textarea>

                                        @if($errors->has('description'))
                                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                                    @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_title1">Internal Title 1 </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="internal_title1"
                                            id="internal_title1" placeholder="Enter Internal Title 1"
                                            value="{{ old('internal_title1', $homeabout->internal_title1) }}" />

                                        @if ($errors->has('internal_title1'))
                                            <span class="text-danger"> {{ $errors->first('internal_title1') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_desc1"> Internal Desc 1</label>
                                    <div class="col-sm-10">
                                        <textarea rows="6" cols="50" id="internal_desc1" name="internal_desc1" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2">{{ old('internal_desc1', $homeabout->internal_desc1) }}</textarea>
                                        @if ($errors->has('internal_desc1'))
                                            <span class="text-danger"> {{ $errors->first('internal_desc1') }} </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_title2"> Internal Title 2 </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="internal_title2"
                                            id="internal_title2" placeholder="Enter Title 2"
                                            value="{{ old('internal_title2', $homeabout->internal_title2) }}" />

                                        @if ($errors->has('internal_title2'))
                                            <span class="text-danger"> {{ $errors->first('internal_title2') }} </span>
                                        @endif

                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_desc2"> Internal Desc 2</label>
                                    <div class="col-sm-10">
                                        <textarea rows="6" cols="50" id="internal_desc2" name="internal_desc2" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2">{{ old('internal_desc2', $homeabout->internal_desc1) }}</textarea>
                                        @if ($errors->has('internal_desc2'))
                                            <span class="text-danger"> {{ $errors->first('internal_desc2') }} </span>
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

            <!-- for ck editor -->
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    <!-- -->

    @endsection
