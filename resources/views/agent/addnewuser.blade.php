@extends('agent.layouts.main')

@section('page_title', 'Add New User')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> User Managment /</span> Add New User</h4>

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
                        <div class="card-header" style="border-bottom: 1px solid rgba(0, 0, 0, .125); padding: 0.5rem 1rem;">
                            <i class="fa fa-table" aria-hidden="true"></i>  Upload Bulk Users
                            <div style="display: flex;">

                                {{-- <input type="file" class="form-control" style="width: 30%;margin-left:50%;"> &nbsp;&nbsp;
                                <a style="float: right;"class="btn btn-primary" href="#"><i class="fa fa-upload" aria-hidden="true"></i></a> --}}
                                <!-- bulk-upload.blade.php -->

                                <form action="{{ route('users.bulk-upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <label for="csv_file">CSV File:</label>
                                    <input type="file" id="csv_file" name="csv_file" accept=".csv, .txt" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="text-danger">{{ $errors->first('csv_file') }}</span>
                                    @endif

                                    <button type="submit">Upload</button>
                                </form>

                            </div>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="/admin/addnewuser/store" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3 mt-3">
                                    <label class="col-sm-2 col-form-label" for="name">Name</label><br />
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="{{ old('name') }}" />

                                        @if ($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }} </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Email" value="{{ old('email') }}" />
                                        @if ($errors->has('email'))
                                            <span class="text-danger"> {{ $errors->first('email') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="+91********" value="{{ old('phone') }}" />

                                        @if ($errors->has('phone'))
                                            <span class="text-danger"> {{ $errors->first('phone') }} </span>
                                        @endif

                                    </div>
                                </div>
                                {{-- <div class="row mb-3 ">
                                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Password" value="{{ old('password') }}" />

                                        @if ($errors->has('password'))
                                            <span class="text-danger"> {{ $errors->first('password') }} </span>
                                        @endif
                                    </div>
                                </div> --}}
                                {{-- <div class="row mb-3">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="services">Add Services with
                                            Expiry</label>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Add Service With Expiry"
                                                id="services" name="services" value="{{ old('services') }}">
                                            @if ($errors->has('services'))
                                                <span class="text-danger"> {{ $errors->first('services') }} </span>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" id="services_expiry_date"
                                                name="services_expiry_date" value="{{ old('services_expiry_date') }}">
                                            @if ($errors->has('services_expiry_date'))
                                                <span class="text-danger"> {{ $errors->first('services_expiry_date') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="image">Upload Documents</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image" name="image" />
                                        @if ($errors->has('image'))
                                            <span class="text-danger"> {{ $errors->first('image') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="6" cols="50" id="description" name="description" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk User?" aria-label="Hi, Do you have a moment to talk User?"
                                            aria-describedby="basic-icon-default-message2">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger"> {{ $errors->first('description') }} </span>
                                        @endif
                                    </div>
                                </div>


                                <!-- LAST-INTERACTION TABLE START -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="Last Interaction">last-interaction</label>
                                    <div class="col-sm-10">
                                        <!--    <input type="text" class="form-control" id="last-interaction"-->
                                        <!--        placeholder="Add Services with Expiry" />-->
                                        <!--</div>-->
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-hover table-responsive table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($last_interaction as $last_interaction_List)
                                                        <tr>
                                                            <th scope="row">{{ $last_interaction_List->services_expiry_date }}</th>
                                                            {{-- <td>{{ $last_interaction_List->description }} </td> --}}
                                                            <td>{{ Str::limit($last_interaction_List->description, 20) }} </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                        class="btn p-0 dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="">
                                                                        <a class="dropdown-item" href="edituser/{{ $last_interaction_List->id }}/edit"><i
                                                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                        <a class="dropdown-item" href="viewuser/{{ $last_interaction_List->id }}/view"><i
                                                                                class="fa fa-eye"></i> View</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- LAST-INTERACTION TABLE START END -->

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

    <!-- for add +91 in numbers before -->
    <script>

        $(document).ready(function() {
                $("#phone").keyup(function(){
                var prefix = "+91"
                if(this.value.indexOf(prefix) !== 0 ){
                    this.value = prefix + this.value;
                }
            });
        });
    </script>
    <!-- -->

    @endsection
