@extends('agent.layouts.main')

@section('page_title', 'Manage User')
@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> User Managment /</span> Manage User </h4>

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
                                <h5 class="card-header text-uppercase"> Manage User </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" style="color: white;" href='{{ url('admin/allusers') }}'>
                                    Back </a>
                            </div>

                        </div>


                        <div class="card-body" style="overflow: scroll;height: 660px;">
                            <h5 class="pb-1 mb-4"><mark>Services Card </mark></h5>
                            <div class="row mb-5">
                                @foreach ($buyservice as $buyservice_List)
                                    @foreach ($service as $service_List)
                                        @if ($buyservice_List->service_id == $service_List->id)
                                            <div class="col-md-6 col-lg-4 mb-3">
                                                <div class="card">
                                                    {{-- <div class="card-header">{{ $service_List->created_at }}</div> --}}

                                                    <div class="card-header">

                                                        {{-- @if($expiredDate->isNotEmpty())
                                                            <div class="alert alert-danger">
                                                                Some records have expired.
                                                            </div>

                                                        @elseif ($nearExpireDate->isNotEmpty())
                                                            <div class="alert alert-warning">
                                                                Some records are near expiration.
                                                            </div>

                                                        @elseif ($newDate->isNotEmpty())
                                                            <div class="alert alert-info">
                                                                Some new records have been added.
                                                            </div>
                                                        @endif --}}

                                                        <form method="POST"
                                                            action="/admin/validity_date/{{ $buyservice_List->id }}/update">

                                                            @csrf
                                                            @method('PUT')

                                                            <label for="vol">Change Validity Date</label>
                                                            <div  style="display:flex">
                                                                {{-- <input class="form-control" type="date" name="validity_date" value="{{ old('validity_date', $buyservice_List->validity_date) }}"><br/><br/> --}}
                                                                <input type="date" class="form-control" id="validity_date"
                                                name="validity_date" value="{{ old('validity_date' , $buyservice_List->validity_date) }}"><br/><br/>
                                                                <button style="background: #ffc107;border: none; margin-left: 5px;" type="submit" class="btn btn-dark btn-sm">Change</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="card-body">
                                                        <h5 class="card-title"> {{ $service_List->service_name }} </h5>
                                                        <p class="card-text">
                                                            {{ Str::limit($service_List->internal_desc, 200) }}
                                                        </p>
                                                        <form method="POST"
                                                            action="/admin/workprgress/{{ $buyservice_List->id }}/update">

                                                            @csrf
                                                            @method('PUT')

                                                            <div class="range-slider">
                                                                <label for="vol">Work Progress Bar</label>
                                                                <input class="range-slider__range" type="range"
                                                                    min="0" max="100" name="work_prgress"
                                                                    value="{{ old('work_prgress', $buyservice_List->work_prgress) }}">
                                                                <span class="range-slider__value">0</span> <br />
                                                                <button type="submit" class="btn btn-primary">Send</button>
                                                            </div>
                                                        </form>

                                                        {{-- <div class="alert alert-danger" id="error" style="display: none;"></div>


                                                        <div class="" id="phone_number_div">

                                                            <div class="card-body">
                                                                <div class="alert alert-success" id="sentSuccess"
                                                                    style="display: none;">
                                                                </div>
                                                                <form>
                                                                    <figcaption class="blockquote-footer">
                                                                        Please Fill Up Admin Number and Clear Dues!
                                                                      </figcaption>
                                                                    <label>Phone Number:</label>
                                                                    <input type="text" id="number"
                                                                        class="form-control" placeholder="+91********"> <br>
                                                                    <div id="recaptcha-container"></div>
                                                                    <button type="button" class="btn btn-success"
                                                                        onclick="phoneSendAuth();">Send OTP</button>
                                                                    <span class="text-danger"> {{ session('error') }}
                                                                    </span>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="" style="margin-top: 10px;display:none"
                                                            id="varification_code_div">
                                                            <div class="card-header">
                                                                Enter Verification code
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="alert alert-success" id="successRegsiter"
                                                                    style="display: none;"></div>
                                                                <form>
                                                                    <input type="text" id="verificationCode"
                                                                        class="form-control"
                                                                        placeholder="Enter verification code"><br>
                                                                    <button type="button" class="btn btn-success"
                                                                        onclick="codeverify();">Verify code</button>
                                                                    <span class="text-danger"> {{ session('error') }}
                                                                    </span>
                                                                </form>
                                                            </div>
                                                        </div> --}}

                                                        <br>
                                                        <div class="btn-group clear-due-btn-manageuser">
                                                            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                                Clear Dues
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end w-px-300"
                                                                style="">
                                                                <div class="alert alert-danger" id="error" style="display: none;"></div>


                                                        <div class="" id="phone_number_div">

                                                            <div class="card-body">
                                                                <div class="alert alert-success" id="sentSuccess"
                                                                    style="display: none;">
                                                                </div>
                                                                <form>
                                                                    <figcaption class="blockquote-footer">
                                                                        Please Fill Up Admin Number and Clear Dues!
                                                                      </figcaption>
                                                                    <label>Phone Number:</label>
                                                                    <input type="text" id="number"
                                                                        class="form-control" placeholder="+91********"> <br>
                                                                    <div id="recaptcha-container"></div>
                                                                    <button type="button" class="btn btn-success"
                                                                        onclick="phoneSendAuth();">Send OTP</button>
                                                                    <span class="text-danger"> {{ session('error') }}
                                                                    </span>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="" style="margin-top: 10px;display:none"
                                                            id="varification_code_div">
                                                            <div class="card-header">
                                                                Enter Verification code
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="alert alert-success" id="successRegsiter"
                                                                    style="display: none;"></div>
                                                                <form>
                                                                    <input type="text" id="verificationCode"
                                                                        class="form-control"
                                                                        placeholder="Enter verification code"><br>
                                                                    <button type="button" class="btn btn-success"
                                                                        onclick="codeverify();">Verify code</button>
                                                                    <span class="text-danger"> {{ session('error') }}
                                                                    </span>
                                                                </form>
                                                            </div>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                    <p><b>Sales:</b> {{ $service_List->total_profit}} </p>
                                                        {{-- <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- <p> No Card Buy in this user </p> --}}
                                        @endif
                                    @endforeach
                                @endforeach

                            </div>

                        </div>


                        <div class="card-body" style="height: 1100px; overflow: scroll;margin-top:50px">
                            <h5 class="pb-1 mb-4"><mark>Documents Card</mark></h5>
                            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">

                                @foreach ($mydocument as $mydocument_List)
                                    <div class="col">
                                        <div class="card h-100">
                                            <img class="card-img-top"
                                                src='{{ url("user/assets/img/avatars/my_documents/$mydocument_List->documents") }}'
                                                alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $mydocument_List->name }}</h5>
                                                <p class="card-text">
                                                    {{ $mydocument_List->created_at }}
                                                </p>
                                                <a href="{{ url("user/assets/img/avatars/my_documents/$mydocument_List->documents") }}"
                                                    download="{{ $mydocument_List->name }}" class="btn btn-primary">
                                                    Download </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="card-body">
                            <h5 class="pb-1 mb-4"><mark>Notification Card </mark></h5>
                            <div class="row mb-5">


                                <form method="POST" action="/admin/manageuser/storenotification">
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="title"> Title</label><br />
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Title" value="{{ old('title') }}" />

                                            <input type="hidden" name="user_id" value="{{ $user->id }}" />

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
                                                aria-describedby="basic-icon-default-message2">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger"> {{ $errors->first('description') }} </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- LAST-INTERACTION TABLE START -->
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label text-success" for="Last Interaction">last-interaction</label> --}}
                                        <label class="col-sm-2 col-form-label text-success" for="Last Interaction">Manage Notification</label>
                                        <div class="col-sm-10">
                                            <!--    <input type="text" class="form-control" id="last-interaction"-->
                                            <!--        placeholder="Add Services with Expiry" />-->
                                            <!--</div>-->
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-hover table-responsive table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($notification as $notificationList)
                                                            <tr>
                                                                <td>{{ $notificationList->created_at }}</td>
                                                                <td>{{ $notificationList->title }}</td>
                                                                <td>{{ Str::limit($notificationList->description, 20) }}
                                                                </td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button"
                                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="">
                                                                            <a class="dropdown-item"
                                                                                href="/admin/editnotification/{{ $notificationList->id }}/edit/{{ $user->id }}"><i
                                                                                    class="bx bx-edit-alt me-1"></i>
                                                                                Edit</a>
                                                                            <a class="dropdown-item"
                                                                                href="/admin/deletenotification/{{ $notificationList->id }}/delete"><i
                                                                                    class="fa fa-trash"></i> Delete </a>
                                                                            {{-- <a class="dropdown-item" href="viewuser/{{ $notificationList->id }}/view"><i
                                                                                    class="fa fa-eye"></i> View</a> --}}
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            {{ $notification->links() }}
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
        </div>
        <!-- / Content -->

        <!-- for show vlaue in work progress -->
        <script>
            var rangeSlider = function() {
                var slider = $('.range-slider'),
                    range = $('.range-slider__range'),
                    value = $('.range-slider__value');


                slider.each(function() {

                    value.each(function() {
                        var value = $(this).prev().attr('value');
                        $(this).html(value);

                    });

                    range.on('input', function() {
                        $(this).next(value).html(this.value + '%');
                    });
                });
            };

            rangeSlider();
        </script>
        <!-- -->

        <!-- for add +91 in numbers before -->
        <script>

            $(document).ready(function() {
                 $("#number").keyup(function(){
                    var prefix = "+91"
                    if(this.value.indexOf(prefix) !== 0 ){
                        this.value = prefix + this.value;
                    }
                });
            });
        </script>
        <!-- -->

        <!-- For OTP login -->

        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
        <script>
            var firebaseConfig = {
                apiKey: "AIzaSyDUWsmh0AxSgOk5fJHfo0_fVnURO4yNuo8",
                authDomain: "gst-it-20203.firebaseapp.com",
                databaseURL: "https://gst-it-20203-default-rtdb.europe-west1.firebasedatabase.app",
                projectId: "gst-it-20203",
                storageBucket: "gst-it-20203.appspot.com",
                messagingSenderId: "927146202041",
                appId: "1:927146202041:web:b9cae4414c9829f0addc68",
                measurementId: "G-BQW85NNZZG"
            };

            firebase.initializeApp(firebaseConfig);
        </script>
        <script type="text/javascript">
            window.onload = function() {
                render();
            };

            function render() {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }

            function phoneSendAuth() {
                var number = jQuery("#number").val();

                firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {

                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);

                    jQuery("#sentSuccess").text("Message Sent Successfully.");
                    jQuery("#sentSuccess").show();

                    jQuery("#varification_code_div").show();
                    jQuery("#phone_number_div").hide();


                }).catch(function(error) {
                    jQuery("#error").text(error.message);
                    jQuery("#error").show();
                });

            }

            function codeverify() {
                var code = jQuery("#verificationCode").val();

                coderesult.confirm(code).then(function(result) {
                    var user = result.user;

                    jQuery("#successRegsiter").text("Your Dues Clear Successfully.");
                    jQuery("#successRegsiter").show();


                    // for session pages access anand start
                    // anand
                    // To get phone number for session
                    var phone = jQuery("#number").val();
                    var token = "{{ csrf_token() }}";

                    sessionStorage.setItem("USER_LOGIN", true);
                    sessionStorage.setItem("USER_PHONE", phone);
                    var data = sessionStorage.getItem("USER_PHONE");
                    console.log(data); // Outputs: value
                    //
                    jQuery(document).ready(function() {
                        jQuery.ajax({
                            // url: 'login/auth',
                            // url: "{{ route('login.auth') }}",
                            url: '/user/auth',
                            type: 'post',
                            data: {
                                _token: token,
                                phone: phone
                            },
                            success: function(response) {

                               // return redirect('user/dashboard');

                                if (result == "success")
                                    alert(response);

                                console.log(response); // Success response from the server
                            },
                            error: function(xhr, status, error) {
                                alert('Error' + error);
                                console.error(error); // Error handling if the request fails
                            }
                        });
                    });
                    // for session pages access anand end

                    //window.location.replace("http://gst.sindhisanskriti.com/user/dashboard");

                }).catch(function(error) {
                    jQuery("#error").text(error.message);
                    jQuery("#error").show();
                });
            }
        </script>

        <!-- -->
    @endsection
