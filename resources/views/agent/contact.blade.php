@extends('agent.layouts.main')

@section('page_title', 'Contact')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Website Managment /</span> Contact </h4>


            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header" style="border-bottom: 1px solid rgba(0, 0, 0, .125); padding: 0.5rem 1rem;">
                    <i class="fa fa-table" aria-hidden="true"></i> Contact

                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>  <strong> Sr No </strong> </th>
                                    <th> <strong> Name </strong></th>
                                    <th> <strong> Email </strong></th>
                                    <th> <strong> Mobile </strong></th>
                                    <td> <strong> Address </strong></td>
                                    <th> <strong> Actions </strong></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($contact as $contactList)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                                                {{ $loop->index + 1 }}</strong></td>

                                        <td>{{ $contactList->name }} </td>
                                        <td>{{ $contactList->email }} </td>
                                        <td>{{ $contactList->mobile }} </td>
                                        <td>{{ $contactList->address }} </td>

                                        <td>
                                            <a href="contact/{{ $contactList->id }}/contactview" class="btn btn-info" >
                                                <i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
                {{ $contact->links() }}
            </div>

            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />


            <!-- / Content -->
        @endsection
