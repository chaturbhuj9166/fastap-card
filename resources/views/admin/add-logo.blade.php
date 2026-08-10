@extends('include.master')
@section('page_title','Product')
@section('contant')
<div class="page-wrapper">
<div class="page-content">
<div class="row">

<div class="col-xl-12 mx-auto">

<h6 class="mb-0 text-uppercase">Brand logo</h6>

<hr/>



<div class="card">

<div class="card-body">

<div class="p-4 border rounded">

<form class="row g-3 " action="add-logo1" method="post"  enctype="multipart/form-data">
@csrf







<div class="col-md-12">
<label  class="form-label">Title</label>
<input type="text" name="title" value="{{old('title')}}" class="form-control" >
<p style="color:red;">@error('title'){{$message}}@enderror</p>
</div>



<div class="col-md-12">
<label  class="form-label">Logo Image</label>
<input type="file" name="logo" value="{{old('logo')}}" class="form-control" >
<p style="color:red;">@error('logo'){{$message}}@enderror</p>
</div>







<div class="col-12 text-center">

<p class="text-center"><input type="submit" value="submit"  class="btn btn-success" name="submit"></p>

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

		<script>
	jQuery(document).ready(function(){

			jQuery('#catagory').change(function(){
				let cid=jQuery(this).val();
				jQuery('#childcategory').html('<option value="">--Select Child-Category type--</option>')
				jQuery.ajax({
					url:'getSubcat',
					type:'post',
					data:'cid='+cid+'&_token={{csrf_token()}}',
					success:function(result){

						jQuery('#subcategory').html(result)
					}
				});
			});
			
					jQuery('#subcategory').change(function(){
				let sid=jQuery(this).val();
				jQuery.ajax({
					url:'getchildcat',
					type:'post',
					data:'sid='+sid+'&_token={{csrf_token()}}',
					success:function(result){

						jQuery('#childcategory').html(result)
					}
				});
			});
			
    });


			
		</script>

@endpush



@endsection