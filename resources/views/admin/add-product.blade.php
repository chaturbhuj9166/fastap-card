@extends('include.master')
@section('page_title','Product')
@section('contant')
<div class="page-wrapper">
<div class="page-content">
<div class="row">

<div class="col-xl-12 mx-auto">

<h6 class="mb-0 text-uppercase">Product Setting</h6>

<hr/>



<div class="card">

<div class="card-body">

<div class="p-4 border rounded">

<form class="row g-3 " action="add-product" method="post"  enctype="multipart/form-data">
@csrf
<!--<div class="col-md-6">-->
<!--<label  class="form-label">Category</label>-->
<!--<select name="catagory" value="{{old('catagory')}}" class="form-control single-select">-->
<!--<option value="0">--Select Categroy type--</option>-->
<!--@foreach($categoryslist as $list)-->
<!--<option value="{{$list->id}}">{{$list->categroy}}</option>-->
<!--@endforeach-->
<!--</select> -->
<!--<p style="color:red;">@error('catagory'){{$message}}@enderror</p>-->
<!--</div>-->

{{--<div class="col-md-6">
<label  class="form-label">Sub Category</label>
<select name="subcategory" id="subcategory" value="{{old('subcategory')}}" class="form-control single-select">
<option value="">--Select Subcategroy type--</option>
</select> 
<p style="color:red;">@error('subcategory'){{$message}}@enderror</p>
</div>--}}




<div class="col-md-6">
<label  class="form-label">Product Name</label>
<input type="text" name="pro_name" value="{{old('pro_name')}}" class="form-control" >
<p style="color:red;">@error('pro_name'){{$message}}@enderror</p>
</div>

<div class="col-md-6">
    <label  class="form-label">Commission (%) </label>
    <input type="number" id="twoDigitInput" maxlength="2" name="commission" value="{{old('commission')}}" class="form-control" placeholder="%">
    <p style="color:red;">@error('commission'){{$message}}@enderror</p>
</div>

<div class="col-md-6">
<label  class="form-label">Product Image</label>
<input type="file" name="pro_img" value="{{old('pro_img')}}" class="form-control" >
<p style="color:red;">@error('pro_img'){{$message}}@enderror</p>
</div>

<div class="col-md-6">
<label  class="form-label">Product Multi Images</label>
<input type="file" name="pro_multi_img[]" value="{{old('pro_multi_img')}}" multiple="multiple" class="form-control" >
<p style="color:red;">@error('pro_multi_img'){{$message}}@enderror</p>
</div>

<div class="col-md-6">
<label  class="form-label">Product Price</label>
<input type="number" name="pro_price" value="{{old('pro_price')}}" class="form-control" >
<p style="color:red;">@error('pro_price'){{$message}}@enderror</p>
</div>
<div class="col-md-6">
<label  class="form-label">Product MRP Price</label>
<input type="number" name="pro_mrp" value="{{old('pro_mrp')}}" class="form-control" >
<p style="color:red;">@error('pro_mrp'){{$message}}@enderror</p>
</div>

<div class="col-md-6">
<label  class="form-label">Status</label>
<select name="status" class="form-control single-select">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select> 
<p style="color:red;">@error('status'){{$message}}@enderror</p>
</div>
<div class="col-md-12">
<label  class="form-label"> About Product</label>

<textarea type="text"  class="form-control" value="" placeholder="Enter Your Product Short Description" name="editor" rows="5" >{{old('pro_description')}}</textarea>
<p style="color:red;">@error('editor'){{$message}}@enderror</p>
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