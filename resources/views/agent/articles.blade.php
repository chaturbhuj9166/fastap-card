@extends('agent.layouts.main')

@section('page_title','Article')

@section('main-container')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Website Managment /</span> Article </h4>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong> {{ $message }} </strong>
                </div>
            @endif

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header" style="border-bottom: 1px solid rgba(0, 0, 0, .125); padding: 0.5rem 1rem;">
                    <i class="fa fa-table" aria-hidden="true"></i> Article<a style="float: right;"class="btn btn-primary"
                        href="addarticle">
                        <i class="fa fa-plus-circle" style="margin-right: 0;"aria-hidden="true"></i></a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th> <strong> Title </strong> </th>
                                    <th> <strong> Short Desc </strong> </th>
                                    <th><strong> Date </strong></th>
                                    <th><strong> Actions </strong> </th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($article as $articleList)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                                                {{ $loop->index + 1 }}</strong></td>
                                        <td>{{ $articleList->title }} </td>
                                         {{-- <td>{{ $articleList->short_desc }} </td> --}}

                                         <td>{{ Illuminate\Support\Str::limit($articleList->short_desc, 20) }} </td>
                                        <td>{{ $articleList->post_date }} </td>
                                        <td>
                                            <a class="btn btn-primary" href="editarticle/{{ $articleList->id }}/edit"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>

                                    <!-- for admin & manager role start -->            
                                    <?php
                                        $role = Session::get('ROLE');
                
                                        if ($role === 'admin')
                                        {
                                            ?>
                                                <style> .btn-danger{ display: block}</style>
                                            <?php
                                        }else
                                        {
                                            ?>
                                            <style> .btn-danger{ display: none}</style>
                                            <?php
                                        }
                                        ?>
                
                                        <?php
                                    ?>
                                    <!-- for admin & manager role end-->

                                            <a class="btn btn-danger" href="article/{{ $articleList->id }}/delete"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
                {{ $article->links() }}
            </div>

            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />


            <!-- / Content -->
        @endsection
