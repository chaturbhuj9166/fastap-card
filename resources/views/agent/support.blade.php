@extends('agent.layouts.main')
@section('page_title', 'Support ')
@section('main-container')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Support/</span> </h4>

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
                            <h5 class="mb-0">Support </h5>
                            <small class="text-muted float-end">Form</small>
                        </div>
                        <div class="card-body">
    
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- / Content -->


    @endsection
