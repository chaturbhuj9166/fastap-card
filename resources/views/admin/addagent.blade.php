@extends('include.master')
@section('page_title','Add Agent')
@section('contant')

<style>

/* Hide the up/down arrows in the number input */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield; /* For Firefox */
  appearance: textfield; /* For other modern browsers */
}

</style>

<div class="page-wrapper">
<div class="page-content">
<div class="row">

<div class="col-xl-12 mx-auto">

<h6 class="mb-0 text-uppercase">Add Franchise</h6>

<hr/>



<div class="card">

<div class="card-body">

<div class="p-4 border rounded">

<form class="row g-3 " action="/admin/addagent/addagentstore" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="col-md-6">
    <label  class="form-label">Name</label>
    <input type="text" name="name" value="{{old('name')}}" class="form-control" >
    <p style="color:red;">@error('name'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Mobile</label>
    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" >
    <p style="color:red;">@error('mobile'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Alternative Mobile</label>
    <input type="text" name="alternative_mobile" value="{{old('alternative_mobile')}}" class="form-control" >
    <p style="color:red;">@error('alternative_mobile'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Address</label>
    <input type="text" name="address" value="{{old('address')}}" class="form-control" >
    <p style="color:red;">@error('address'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Upload Aadhar Card Front</label>
    <input type="file" name="aadhar_front" value="{{old('aadhar_front')}}" class="form-control" >
    <p style="color:red;">@error('aadhar_front'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Upload Aadhar Card Back</label>
    <input type="file" name="aadhar_back" value="{{old('aadhar_back')}}" class="form-control" >
    <p style="color:red;">@error('aadhar_back'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Email</label>
    <input type="text" name="email" value="{{old('email')}}" class="form-control" >
    <p style="color:red;">@error('email'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Password</label>
    <input type="password" name="password" value="{{old('password')}}" class="form-control" >
    <p style="color:red;">@error('password'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Franchise Code</label>
    <input type="text" name="agent_code" value="{{old('agent_code')}}" class="form-control" >
    <p style="color:red;">@error('agent_code'){{$message}}@enderror</p>
    </div>
    
    <div class="col-md-6">
    <label  class="form-label">Status</label>
    <select name="status" class="form-control single-select">
    <option value="select">Select Status</option>
    <option value="1">Active</option>
    <option value="0">Inactive</option>
    </select> 
    <p style="color:red;">@error('status'){{$message}}@enderror</p>
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


@endpush

<script>
    // Get the input element
const twoDigitInput = document.getElementById('twoDigitInput');

// Store the previous valid value
let previousValue = twoDigitInput.value;

// Listen for the "input" event to detect changes in the input value
twoDigitInput.addEventListener('input', () => {
  // Check if the input value is a valid two-digit number
  const inputValue = twoDigitInput.value;
  if (!/^\d{0,2}$/.test(inputValue)) {
    // If not, revert to the previous valid value
    twoDigitInput.value = previousValue;
  } else {
    // Update the previous valid value
    previousValue = inputValue;
  }
});

</script>

@endsection