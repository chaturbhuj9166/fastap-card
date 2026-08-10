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
<div class="card-header"></i>PRICING PLANS<a style="float: right;" href="coupon"></a></div>

<div class="card-body">
<div class="table-responsive">
<div class="row">
<div class="col-md-12">
<h4>SMART CARD</h4>
</div>
</div>
<form method="POST" action="add_Pricing_Plans" enctye="multipart/form-data">
@csrf
<div class="form-group row" >
<div class="col-md-2">
<label  class="form-label">Card Name</label>
</div>
<div class="col-md-4">

<input type="text" name="cname" value="{{old('cname')}}"  class="form-control" >
<p style="color:red;">@error('cname'){{$message}}@enderror</p>
</div>


<div class="col-md-2">
<label  class="form-label">Pricing Plans Single Image</label>
</div>
<div class="col-md-4">

<input type="file" name="pro_single_img"   class="form-control" >
<p style="color:red;">@error('pro_single_img'){{$message}}@enderror</p>
</div>

<div class="col-md-2">
<label  class="form-label">Pricing Plans Images</label>
</div>
<div class="col-md-4">

<input type="file" name="pro_multi_img[]"  multiple class="form-control" >
<p style="color:red;">@error('pro_multi_img'){{$message}}@enderror</p>
</div>
<div class="col-md-2">

<label for="basic-input" class="col-sm-3 col-form-label">Description 1</label>
</div>
<div class="col-sm-4">
<textarea name="Description1"  type="text" class="form-control" value="{{old('editor')}}"  placeholder="Description" rows="3" cols="55"></textarea>
<p style="color:red;">@error('Description1'){{$message}}@enderror</p>

</div>
</div>
<div class="form-group row">
<div class="col-sm-2">
<label for="basic-input" class="col-sm-3 col-form-label">Description 2</label>
</div>
<div class="col-sm-10">
<div class="input-group mb-3">
<textarea  type="text" class="form-control" value="{{old('editor')}}" name="editor" placeholder="Description" ></textarea>
<p style="color:red;">@error('editor'){{$message}}@enderror</p>

</div>
</div>
</div>
<div class="text-center"><input type="submit" name="submit" value="submit" class="btn btn-success"></div>
</form>

</form>



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
url: 'coupon.status',
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