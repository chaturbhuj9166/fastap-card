@extends('include.master')
@section('page_title','Child Categroy')
@section('contant')


<div class="page-wrapper">
<div class="page-content">

<div class="container-fluid">

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header text-uppercase">Child Categroy</div>
<div class="card-body">
<form method="POST" action="add-childcategory" class="form-horizontal" enctype="multipart/form-data">
   
@csrf
<div class="form-group row">

<label for="basic-input" class="col-sm-2 col-form-label">Select Categroy</label>
<div class="col-sm-4">
<div class="input-group mb-3">

<select class="form-select form-control mb-2 single-select " id="catagory" name="catagory" aria-label="Default select example" >
<option value="">--Select Categroy type--</option>
@foreach($categoryslist as $settingees)
<option  value = "{{ $settingees->id }}">{{ $settingees->categroy }} </option>
@endforeach
<p style="color:red;">@error('catagory'){{$message}}@enderror</p>
</select>
</div>
</div>





<label for="basic-input" class="col-sm-2 col-form-label">Sub Categroy</label>
<div class="col-sm-4">
<div class="input-group mb-3">
<select id="subcategory" class="form-control" name="subcategory"  >

<option value="">--Select Subcategroy type--</option>
</select>
</div>
<p style="color:red;">@error('subcategory'){{$message}}@enderror</p>


</div>


<label for="basic-input" class="col-sm-2 col-form-label">Add Child Categroy</label>
<div class="col-sm-4">
<div class="input-group mb-3">

<input type="text" class="form-control" value="{{old('childcategroy')}}" name="childcategroy" placeholder="Child Categroy Name" >
</div>
<p style="color:red;">@error('childcategroy'){{$message}}@enderror</p>
</div>


<label for="basic-input" class="col-sm-2 col-form-label">Image</label>
<div class="col-sm-4">
<div class="input-group mb-3">

<input type="file" class="form-control" value="{{old('image')}}" name="image" >
</div>
<p style="color:red;">@error('image'){{$message}}@enderror</p>
</div>

						  <label for="basic-input" class="col-sm-2 col-form-label">Status</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
<select name="status" class="form-control single-select">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select> 
</div>
<p style="color:red;">@error('status'){{$message}}@enderror</p>
</div>
<div class="form-group row">
<label for="basic-input" class="col-sm-2 col-form-label">Description</label>
<div class="col-sm-10">
<div class="input-group mb-3">

<textarea type="text" class="form-control"  name="editor" placeholder="Description" >{{old('editor')}}</textarea>
</div>
<p style="color:red;">@error('editor'){{$message}}@enderror</p>
</div>
</div>



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
<script type = "text/javascript">
	jQuery(document).ready(function(){
			jQuery('#catagory').change(function(){
				let cid=jQuery(this).val();
				jQuery.ajax({
					url:'getSubcat',
					type:'post',
					data:'cid='+cid+'&_token={{csrf_token()}}',
					success:function(result){

						jQuery('#subcategory').html(result)
					}
				});
			});
    });

</script>


@endpush


@endsection
