@extends('agent.layouts.main')

@section('page_title', 'Edit Notification')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> User Managment /</span> Manage User / Notification Edit </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <div class="row">
                <!-- Inline text elements -->
                <div class="col">
                    <div class="card">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-header text-uppercase"> Notification Edit </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" style="color: white;"
                                    href='{{ url("admin/manageuser/$user->id/manage") }}'>
                                    Back
                                </a>
                            </div>

                        </div>

                        <div class="card-body">
                            <h5 class="pb-1 mb-4">Notification Card</h5>
                            <div class="row mb-5">


                                <form method="POST" action="/admin/editnotification/{{ $notification->id }}/update">

                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="title"> Title</label><br />
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Title" value="{{ old('title' , $notification->title) }}" />

                                                <input type="hidden" name="user_id" value="{{$user->id}}"/>

                                            @if ($errors->has('title'))
                                                <span class="text-danger"> {{ $errors->first('title') }} </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="description">Description</label>
                                        <div class="col-sm-10">
                                            <textarea rows="6" cols="50" id="description" name="description" class="form-control"
                                                placeholder="Hi, Do you have a moment to talk User?" aria-label="Hi, Do you have a moment to talk User?"
                                                aria-describedby="basic-icon-default-message2">{{ old('description',$notification->description) }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger"> {{ $errors->first('description') }} </span>
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
        </div>
        <!-- / Content -->
    @endsection
