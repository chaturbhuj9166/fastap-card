@extends('agent.layouts.main')

@section('page_title' , 'Add Faq')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Website Managment /</span> Add New FAQ</h4>

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
                            <h5 class="mb-0"> Service </h5>
                            <span class="text-muted float-end">Form</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admin/addfaq/store">
                                @csrf

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="internal_title">Internal Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="internal_title" id="internal_title"
                                            placeholder="Enter Internal Title" value="{{ old('internal_title') }}" />
                                        @if ($errors->has('internal_title'))
                                            <span class="text-danger"> {{ $errors->first('internal_title') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Internal
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="6" cols="50" id="basic-default-message" id="internal_description" name="internal_description" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2">{{ old('internal_description') }}</textarea>
                                        @if ($errors->has('internal_description'))
                                            <span class="text-danger"> {{ $errors->first('internal_description') }} </span>
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
    @endsection
