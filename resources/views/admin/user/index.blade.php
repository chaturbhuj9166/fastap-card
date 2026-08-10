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
    
</style> 
  
<div class="page-wrapper">
			<div class="page-content">


<div class="col-sm-12">
       <div class="container-fluid">

 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <!--<div class="card-header"><i class="fa fa-table"></i>Orders<a style="float: right;" class="btn btn-primary" href="add-product"><i class="fa fa-plus-circle" style="margin-right: 0;" aria-hidden="true"></i></a></div>-->
          
            <div class="card-body">
              <div class="table-responsive">
			        <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                  <tr>
                        <th>Sr.No.</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Date</th>
                        <!--<th>User ID</th>-->
                        <!--<th>Password</th>-->
                        <!--<th>QR</th>-->
                        <!--<th>Card Type</th>-->
                        <!--<th>PDF Download</th>-->
                         <!--<th>City</th>-->
                          <!--<th>State</th>-->
                        <!--th>Status</th-->
                        <th>Active / Inactive</th>
                        <th>Panel Status (GOLD)</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                        @include('layouts.flash-message')
                       <?php $i=1;?>
                            @foreach($user as $settingee)
                 
                                <tr role="row" class="odd">
                                <td>{{$i++}}</td>
                                <td>{{$settingee->name}}</td>
                                <td>{{$settingee->email}}</td>
                                <td>{{$settingee->mobile}}</td>
                                <td>{{date('d-M-Y',strtotime($settingee->created_at))}}</td>
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td>{{$settingee->city}}</td>-->
                                <!--<td>{{$settingee->state}}</td>-->
                             <!--td> 
                                <input type="checkbox" data-id="{{ $settingee->id }}" name="status" class="js-switch" {{ $settingee->status == 1 ? 'checked' : '' }}>
                            </td-->   
                            <td>          
                                <!--<select id="permissionSelect" name="permission">-->
                                <!--    <option value="1" {{$settingee->permission == 1  ? 'selected' : ''}}>Unblock</option>-->
                                <!--    <option value="0" {{$settingee->permission == 0  ? 'selected' : ''}}>Block</option>-->
                                <!--</select>-->
                                    
                                <input type="checkbox" data-id="{{ $settingee->id }}" name="permission" class="js-switch permission-switch" {{ $settingee->permission == 1 ? 'checked' : '' }}>
      
                            </td>         
                            <td>
                                <!--<input onclick="return confirm('Are you sure you want to change panel status')" type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->
                                <!--<input onclick="return confirm('Are you sure you want to change panel status') ? true : false;" type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->
                                <!--<input onclick="if(!confirm('Are you sure you want to change panel status')) return false;" type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->
                                <!--<input onclick="console.log('Clicked!'); if (!confirm('Are you sure you want to change panel status')) return false;" type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->
                                <!--<input type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->
                                
                                <!--<input type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->
                                <!--<script>-->
                                <!--    document.querySelector('.panel_status-switch').addEventListener('click', function(event) {-->
                                <!--        if (!confirm('Are you sure you want to change panel status')) {-->
                                <!--            event.preventDefault();-->
                                <!--        }-->
                                <!--    });-->
                                <!--</script>--> 
                                 
                                <!--<input onclick="handlePanelStatusChange(event)" type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>-->

                                <!--<script>--> 
                                <!--    function handlePanelStatusChange(event) {-->
                                <!--        console.log('Clicked!');-->
                                        
                                        
                                <!--        var isConfirmed = confirm('Are you sure you want to change panel status?');-->
                                
                                        
                                <!--        if (!isConfirmed) {-->
                                <!--            event.preventDefault();-->
                                <!--        }-->
                                <!--    }-->
                                <!--</script>-->
 
                                <input type="checkbox" data-id="{{ $settingee->id }}" name="panel_status" class="js-switch panel_status-switch" {{ $settingee->panel_status == 1 ? 'checked' : '' }}>


                            </td>
                            <td><a class="btn btn-dark" onclick="return confirm('Are you sure you want to delete this User')" href="{{url('admin/user-delete/'.$settingee->id)}}"><i class="fa fa-trash-o"></i></a></td>
                            @endforeach 
</tbody>

</table>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Button to Open the Modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">-->
<!--  Open modal-->
<!--</button>-->

<!-- The Modal -->
<div class="modal" id="active_inactive">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <div class="row">
             <div class="col-md-6"><a href="" class="btn btn-primary  d-block">QR Code Generate</a></div>
             <div class="col-md-6"><a href="" class="btn btn-primary d-block">NFC</a></div>
         </div>
      </div>

      <!-- Modal footer -->
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>-->
      <!--</div>-->

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
url: 'order.status',
data: {'status': status, 'id': userId},
success: function (data) {
alert(data.message);
}
});
});
});



$(document).ready(function(){
    $('.permission-switch').change(function () {
        let permission = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'user.update.permission',
            data: {'permission': permission, 'id': userId},
            success: function (data) {
                alert(data.message);
            }
        });
    });
});
//-----------------//


// for panel_status checkbox gold / normal users

$(document).ready(function(){
    $('.panel_status-switch').change(function () {
        // alert('asdf');
        // return;
        
        // // Display a confirmation dialog
        // var isConfirmed = confirm('Are you sure you want to change panel status?');

        // // If the user clicks "Cancel" in the confirmation dialog, prevent the default behavior
        // if (!isConfirmed) {
        //     $(this).prop('checked', !$(this).prop('checked'));
        //     return;
        // }
        
        
        // Display a confirmation dialog
        // var isConfirmed = confirm('Are you sure you want to change panel status?');

        // // If the user clicks "Cancel" in the confirmation dialog, prevent the checkbox from being checked
        // if (!isConfirmed) {
        //     event.preventDefault();
        //     $(this).prop('checked', !$(this).prop('checked'));
        //     return;
        // }  
         
        let panel_status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({ 
            type: "GET",  
            dataType: "json",
            url: 'user.update.panel_status',
            data: {'panel_status': panel_status, 'id': userId},
            success: function (data) {
                alert(data.message);
            }
        });
    });
});

//------------------//

</script>

<script>

success: function (data) {
toastr.options.closeButton = true;
toastr.options.closeMethod = 'fadeOut';
toastr.options.closeDuration = 100;
toastr.success(data.message);
}
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