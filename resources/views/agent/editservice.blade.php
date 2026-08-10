@extends('agent.layouts.main')

@section('page_title', 'Edit Service')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->



        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Services Managment /</span> Edit Service</h4>

            @if($message = Session::get('success'))
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
                            <h5 class="mb-0"> Service </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="/admin/ediservice/{{ $service->id }}/update">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="category_id">Select Category</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <label class="input-group-text" for="category_id"> Category</label>
                                            <select class="form-select" id="category_id" name="category_id">
                                                <option selected value="select">Select Category type...</option>


                                                @foreach ($allcategory as $allcategoryList)
                                                    @if ($service->category_id == $allcategoryList->id)
                                                        <option selected
                                                            value="{{ $allcategoryList->id, old('category_id') }}">
                                                            {{ $allcategoryList->category }} </option>
                                                    @else
                                                        <option value="{{ $allcategoryList->id, old('category_id') }}">
                                                            {{ $allcategoryList->category }} </option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        </div>

                                        @if ($errors->has('category_id'))
                                            <span class="text-danger"> {{ $errors->first('category_id') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="sub_category_id">Select Sub Category</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <label class="input-group-text" for="sub_category_id">Sub Category</label>
                                            <select class="form-select" id="sub_category_id" name="sub_category_id">
                                                <option selected value="select_sub">Select Sub Category type...</option>

                                                @foreach ($allsubcategory as $allsubcategoryList)
                                                    @if ($service->sub_category_id == $allsubcategoryList->id)
                                                        <option selected
                                                            value="{{ $allsubcategoryList->id, old('sub_category_id') }}">
                                                            {{ $allsubcategoryList->sub_category }} </option>
                                                    @else
                                                        <option value="{{ $allsubcategoryList->id, old('sub_category_id') }}">
                                                            {{ $allsubcategoryList->sub_category }} </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        @if ($errors->has('sub_category_id'))
                                        <span class="text-danger"> {{ $errors->first('sub_category_id') }} </span>
                                    @endif
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="service_name">Service Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  name="service_name" id="service_name"
                                            placeholder="Enter Service Name" value="{{old('service_name',$service->service_name)}}"/>

                                            @if ($errors->has('service_name'))
                                            <span class="text-danger"> {{ $errors->first('service_name') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="service_slug">Service Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  name="service_slug" id="service_slug"
                                            placeholder="Enter Service Slug" value="{{old('service_slug',$service->service_slug)}}"/>

                                            @if ($errors->has('service_slug'))
                                            <span class="text-danger"> {{ $errors->first('service_slug') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="market_price">Market Price </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control"  name="market_price" id="market_price"
                                            placeholder="Enter Market Price" value="{{old('market_price',$service->market_price)}}"/>

                                            @if ($errors->has('market_price'))
                                            <span class="text-danger"> {{ $errors->first('market_price') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="total_price">Total Price </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control"  name="total_price" id="total_price"
                                            placeholder="Enter Total Price" value="{{old('total_price',$service->total_price)}}"/>

                                            @if ($errors->has('total_price'))
                                            <span class="text-danger"> {{ $errors->first('total_price') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="total_profit">Total Profit </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control"  name="total_profit" id="total_profit"
                                            placeholder="Enter Total Profit" value="{{old('total_profit',$service->total_profit)}}"/>

                                            @if ($errors->has('total_profit'))
                                            <span class="text-danger"> {{ $errors->first('total_profit') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Internal
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="6" cols="50"  id="internal_desc" name="internal_desc" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2">{{old('internal_desc',$service->internal_desc)}}</textarea>
                                        @if ($errors->has('internal_desc'))
                                            <span class="text-danger"> {{ $errors->first('internal_desc') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="step1">Step 1</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="step1" name="step1"
                                            placeholder="Enter Step 1" value="{{old('step1',$service->step1)}}"/>

                                            @if ($errors->has('step1'))
                                            <span class="text-danger"> {{ $errors->first('step1') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="step2">Step 2</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="step2" name="step2"
                                            placeholder="Enter Step 2" value="{{old('step2',$service->step2)}}"/>

                                            @if ($errors->has('step2'))
                                            <span class="text-danger"> {{ $errors->first('step2') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="step3">Step 3</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="step3" name="step3"
                                            placeholder="Enter Step 3" value="{{old('step3',$service->step3)}}"/>

                                            @if ($errors->has('step3'))
                                            <span class="text-danger"> {{ $errors->first('step3') }} </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" name="description" id="description">{{old('description',$service->description)}}</textarea>

                                        @if($errors->has('description'))
                                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                                    @endif
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message"> Document
                                        Require</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                    </div>
                                </div> --}}

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="document_require">Document Require</label>
                                    <div class="col-sm-10">
                                        <textarea class="ckeditor form-control" id="document_require" name="document_require">{{old('document_require',$service->document_require)}}</textarea>
                                    </textarea>

                                        @if($errors->has('document_require'))
                                        <span class="text-danger"> {{ $errors->first('document_require') }} </span>
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


        <!-- for show subcategory in add new service page when click category -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script>
            jQuery(document).ready(function() {
                jQuery('#category_id').change(function() {
                    let category_id = jQuery(this).val();
                    var token = "{{ csrf_token() }}";
                    jQuery.ajax({
                        url: '/admin/getSubcat',
                        type: 'post',
                        data: {
                            _token: token,
                            category_id: category_id,
                        },
                        success: function(result) {
                            jQuery("#sub_category_id").html(result);
                        }
                    });

                });
            });
        </script>
        <!-- -->

        <!-- for ck editor -->
        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.ckeditor').ckeditor();
            });
        </script>

        <!-- -->


    @endsection
