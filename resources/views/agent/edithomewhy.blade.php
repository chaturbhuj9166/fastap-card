@extends('agent.layouts.main')

@section('page_title', ' Edit Home Why')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Website Managment /</span> Edit Home About </h4>

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
                            <h5 class="mb-0"> Home Why Us </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admin/edithomewhy/{{ $homewhy->id }}/update" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="image"> Why Us IMAGE</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image" id="image" />
                                        @if ($errors->has('image'))
                                            <span class="text-danger"> {{ $errors->first('image') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" > </label>
                                    <div class="col-sm-10">
                                        <a target="_blank" href='{{ url("frontend/assets/images/video/$homewhy->image") }}'
                                            data-fancybox="images">
                                            <img src='{{ url("frontend/assets/images/video/$homewhy->image") }}'
                                                alt="Why Us Image" class="lightbox-thumb img-thumbnail"
                                                style="width: 140px; height: 70px;">
                                        </a>
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="video_link"> Video Link</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="video_link" id="video_link"
                                            placeholder="Enter Video Link"
                                            value="{{ old('video_link', $homewhy->video_link) }}" />

                                        @if ($errors->has('video_link'))
                                            <span class="text-danger"> {{ $errors->first('video_link') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="title"> Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Title" value="{{ old('title', $homewhy->title) }}" />

                                        @if ($errors->has('title'))
                                            <span class="text-danger"> {{ $errors->first('title') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="description" id="description">{{old('description',$homewhy->description)}}</textarea>

                                        @if($errors->has('description'))
                                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_title1">Skillbar Title 1 </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_title1"
                                            id="skillbar_title1" placeholder="Enter Skillbar Title 1"
                                            value="{{ old('skillbar_title1', $homewhy->skillbar_title1) }}" />

                                        @if ($errors->has('skillbar_title1'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_title1') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_percent1">Skillbar Percent 1
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_percent1"
                                            id="skillbar_percent1" placeholder="Enter Skillbar Percent 1"
                                            value="{{ old('skillbar_percent1', $homewhy->skillbar_percent1) }}" />

                                        @if ($errors->has('skillbar_percent1'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_percent1') }} </span>
                                        @endif

                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_title2"> Skillbar Title 2 </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_title2"
                                            id="skillbar_title2" placeholder="Enter Skillbar Title 1"
                                            value="{{ old('skillbar_title2', $homewhy->skillbar_title2) }}" />

                                        @if ($errors->has('skillbar_title2'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_title2') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_percent2">Skillbar Percent
                                        2</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_percent2"
                                            id="skillbar_percent2" placeholder="Enter Skillbar Percent 2"
                                            value="{{ old('skillbar_percent2', $homewhy->skillbar_percent2) }}" />

                                        @if ($errors->has('skillbar_percent2'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_percent2') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_title3">Skillbar Title 3</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_title3"
                                            id="skillbar_title3" placeholder="Enter Skillbar Title 3"
                                            value="{{ old('skillbar_title3', $homewhy->skillbar_title3) }}" />

                                        @if ($errors->has('skillbar_title3'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_title3') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_percent3">Skillbar Percent
                                        3</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_percent3"
                                            id="skillbar_percent3" placeholder="Enter Skillbar Percent 3"
                                            value="{{ old('skillbar_percent3', $homewhy->skillbar_percent3) }}" />

                                        @if ($errors->has('skillbar_percent3'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_percent3') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_title4">Skillbar Title 4</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_title4"
                                            id="skillbar_title4" placeholder="Enter Skillbar Title 4"
                                            value="{{ old('skillbar_title4', $homewhy->skillbar_title4) }}" />

                                        @if ($errors->has('skillbar_title4'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_title4') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="skillbar_percent4">Skillbar Percent
                                        4</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skillbar_percent4"
                                            id="skillbar_percent4" placeholder="Enter Skillbar Percent 4"
                                            value="{{ old('skillbar_percent4', $homewhy->skillbar_percent4) }}" />

                                        @if ($errors->has('skillbar_percent4'))
                                            <span class="text-danger"> {{ $errors->first('skillbar_percent4') }} </span>
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
