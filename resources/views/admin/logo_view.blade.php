@extends('include.master')
@section('contant')


<style>
    
    .active{
            font-size: 14px;
    background-image: linear-gradient(to right, rgb(218, 34, 255) 0%, rgb(151, 51, 238) 51%, rgb(218, 34, 255) 100%);
        
    }
    
    
    .inactive{
         font-size: 14px;
        background-image: linear-gradient(to right, rgb(255, 81, 47) 0%, rgb(240, 152, 25) 51%, rgb(255, 81, 47) 100%);
    }
    
    #example2_info {
        text-align: end !important;
        position: relative;
        left: 36em;
    }
    
    
</style>

<div class="page-wrapper">
			<div class="page-content">


<div class="col-sm-12">
       <div class="container-fluid">

 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>logo<a style="float: right;" class="btn btn-primary" href="add-logo"><i class="fa fa-plus-circle" style="margin-right: 0;" aria-hidden="true"></i></a></div>
          
            <div class="card-body">
              <div class="">
                  <!--table-responsive-->
			        <table id="example2" class="table table-bordered" style="width:100%">
                <thead>
                  <tr>
                        <th>Sr.No.</th>
                        <th>Title</th>
                        <th>Logo</th>
                      
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                         @include('layouts.flash-message')
                    <?php $i=0;?>
                 @foreach($logo as $settingee)
                 
                 
                   

<tr role="row" class="odd">
<td><?php $i++;?>{{$i}}</td>
<td>{{$settingee->title}}</td>
               <td>             <a href="{{ url('uploads/product_images/'.$settingee->logo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{ url('uploads/product_images/'.$settingee->logo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 60px;">
</a></td>

    <td>
    <a class="btn btn-primary" href="brand_logo_update{{$settingee->id}}"><i class="fa fa-pencil"></i></a>
<a class="btn btn-danger" onclick="confirm('Are you sure?')" href="brand_logo_delete{{$settingee->id}}"><i class="fa fa-trash-o"></i></a>

</td>
@endforeach
</tbody>

</table>



        <div class="d-flex justify-content-flex-end Pagination_1" >
            {!! $logo->links("pagination::bootstrap-4") !!}
        </div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>



<script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});</script>


<script>
    
    
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'product.update.status',
            data: {'status': status, 'id': userId},
            success: function (data) {
                alert(data.message);
            }
        });
    });
});
    
</script>



<style>

.w-5 {
    display: none;
}

.h-5{
    display: none;
}

</style>


@endsection
@stack('footer_script')