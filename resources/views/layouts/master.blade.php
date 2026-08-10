<!DOCTYPE html>
<html>

   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <meta name="description" content=""/>
      <meta name="author" content=""/>
      <title> PROFILEMEET</title>
      <!--favicon-->
      <link rel="icon" href="{{ URL::asset('frontendnew/images/fevicon.png')}}" type="image/x-icon">
        <link href="{{ URL::asset('useradmin_assets/assets/plugins/fancybox/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Vector CSS -->
      <link href="{{ URL::asset('useradmin_assets/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
      <!-- simplebar CSS-->
      <link href="{{ URL::asset('useradmin_assets/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
      <!-- Bootstrap core CSS-->
      <link href="{{ URL::asset('useradmin_assets/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
      <!-- animate CSS-->
      <link href="{{ URL::asset('useradmin_assets/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Icons CSS-->
      <link href="{{ URL::asset('useradmin_assets/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Sidebar CSS-->
      <link href="{{ URL::asset('useradmin_assets/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
      <!-- Custom Style-->
      <link href="{{ URL::asset('useradmin_assets/assets/css/app-style.css')}}" rel="stylesheet"/>
      
         <link href="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

  <link href="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
     
   <link href="https://extraweb.in/Gts_salon/assets/Promo_panel/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet">

 <script src="https://extraweb.in/Gts_salon/assets/Promo_panel/assets/plugins/switchery/js/switchery.min.js"></script>


   </head>
   <body>
         @include('admin.useradmin.header')
         @include('admin.useradmin.sidebar')
         @yield('content')
         @include('admin.useradmin.footer')
       
     <script>
function closeMe(element) {
  $(element).parent().remove();
}

function addMore() {
  var container = $('#list');
  var item = container.find('.default').clone();
  item.removeClass('default');
  //add anything you like to item, ex: item.addClass('abc')....
  item.appendTo(container).show();
}
</script>
<!--End wrapper-->
<!-- Bootstrap core JavaScript-->
<!--<script src="assets/js/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{ URL::asset('useradmin_assets/assets/js/popper.min.js')}}"></script>
<script src="{{ URL::asset('useradmin_assets/assets/js/bootstrap.min.js')}}"></script>
<!-- simplebar js -->
<script src="{{ URL::asset('useradmin_assets/assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- waves effect js -->
<script src="{{ URL::asset('useradmin_assets/assets/js/waves.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{ URL::asset('useradmin_assets/assets/js/sidebar-menu.js')}}"></script>
<!-- Custom scripts -->
<script src="{{ URL::asset('useradmin_assets/assets/js/app-script.js')}}"></script>
<!-- Vector map JavaScript -->
<script src="{{ URL::asset('useradmin_assets/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ URL::asset('useradmin_assets/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- Chart js -->
<script src="{{ URL::asset('useradmin_assets/assets/plugins/Chart.js/Chart.min.js')}}"></script>
<!-- Index js -->
<script src="{{ URL::asset('useradmin_assets/assets/js/index.js')}}"></script>
    
<script src="{{ URL::asset('useradmin_assets/assets/plugins/fancybox/js/jquery.fancybox.min.js')}}"></script>
<script src="{{ URL::asset('useradmin_assets/assets/js/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('front_assets/js/custom.js')}}"></script> 

    <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
  <script src="{{ URL::asset('useradmin_assets/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript" src="https://extraweb.in/Gts_salon/assets/js/bootstrap-toggle.min.js"></script>
    <script>
     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      } );

    </script>
<script type="text/javascript">
/* For CKeditor */

CKEDITOR.replace( 'ckeditor');
</script>
<script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>


<script>
$("#btnAdd").bind("click", function() {
      var clonetr = $("#TextBoxContainer").clone().addClass('TextBoxContainer');
      clonetr.removeAttr('id');
      clonetr.find("table.add_row").remove();
      clonetr.find('.sno').html('<span class="fa fa-trash-o" style="color:red;" onclick="$(this).parent().parent().remove();"></span>');
      clonetr.find('input').val('');
      clonetr.find('.staff option[value=""]').prop('selected',true);
      $("#addBefore").before(clonetr);
      autocomplete_serr();
      $('.TextBoxContainer').last().children().find('.qt').removeAttr('readonly');
      $('.TextBoxContainer').last().children().find('.package_service_quantity').remove();
      $('.TextBoxContainer').last().children().find('.package_service_inv').remove();
      change_event();
   });
   
</script>




   </body>
  </html>