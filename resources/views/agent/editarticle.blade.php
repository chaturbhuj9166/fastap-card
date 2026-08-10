@extends('agent.layouts.main')

@section('page_title', ' Edit Article')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Website Managment /</span> Edit Article</h4>

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
                            <h5 class="mb-0"> Article </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admin/editarticle/{{ $article->id }}/update" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="title">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Internal Title"
                                            value="{{ old('title', $article->title) }}" />
                                        @if ($errors->has('title'))
                                            <span class="text-danger"> {{ $errors->first('title') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="image">Article Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" class="form-control" id="image"  />
                                        @if ($errors->has('image'))
                                            <span class="text-danger"> {{ $errors->first('image') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <a target="_blank"
                                            href='{{ url("frontend/assets/images/blog/inner/style1/$article->image") }}'
                                            data-fancybox="images">
                                            <img src='{{ url("frontend/assets/images/blog/inner/style1/$article->image") }}'
                                                alt="Article Image" class="lightbox-thumb img-thumbnail"
                                                style="width: 140px; height: 70px;">
                                        </a>
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="short_desc">Short
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" cols="50" id="short_desc" name="short_desc" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2">{{ old('short_desc', $article->short_desc) }}</textarea>
                                        @if ($errors->has('short_desc'))
                                            <span class="text-danger"> {{ $errors->first('short_desc') }} </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="long_desc">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="long_desc" id="long_desc">{{old('long_desc', $article->long_desc)}}</textarea>

                                        @if($errors->has('long_desc'))
                                        <span class="text-danger"> {{ $errors->first('long_desc') }} </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="post_date">Post Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="post_date" id="post_date"
                                            placeholder="Enter Internal Title"
                                            value="{{ old('post_date', $article->post_date) }}" />
                                        @if ($errors->has('post_date'))
                                            <span class="text-danger"> {{ $errors->first('post_date') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="post_by">Post By</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="post_by" id="post_by"
                                            placeholder="Enter Post By" value="{{ old('post_by',$article->post_by) }}" />
                                        @if ($errors->has('post_by'))
                                            <span class="text-danger"> {{ $errors->first('post_by') }} </span>
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
        jQuery(document).ready(function () {
            jQuery('.ckeditor').ckeditor();
        });
    </script>

    <!-- -->
    @endsection
