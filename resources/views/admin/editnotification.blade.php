@extends('include.master')
@section('page_title', 'Edit Notification')
@section('contant')



    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">

                <div class="col-xl-12 mx-auto">

                    <h6 class="mb-4 text-uppercase">Notification</h6>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong> {{ $message }} </strong>
                        </div>
                    @endif
                    
                    <hr />

                    <div class="card">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-header text-uppercase"> Notification Edit </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" style="color: white;"
                                    href='{{ url("admin/viewagent/$agent->id/viewagent") }}'>
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

                                                <input type="hidden" name="agent_id" value="{{$agent->id}}"/>

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

    </div>
    @push('footer_script')
    @endpush





@endsection
