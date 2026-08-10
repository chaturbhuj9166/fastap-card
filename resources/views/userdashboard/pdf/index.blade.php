@extends('layouts.user_layout')
@section('page_title','My Resumes')
@section('content')

@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
  .box_general.padding_bottom {
    padding-bottom: 20px;
    background-color: #06163a !important;
    color: #6C7293;
}

.form-control {
    font-size: 14px;
    font-size: 0.875rem;
    padding: 0.65rem;
    background-color: #ffffff;
    border: 1px solid #06163a;
    border-radius: 5px;
    color: black;
}

.form-control:focus {
    /* color: #495057; */
    /* background-color: #fff; */
    /* border-color: #EB1616; */
    /* outline: none; */
    /* box-shadow: none; */
    color: #6C7293;
    background-color: #06163a;
    border-color: #f58b8b;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(235,22,22,0.25);
    color: white;
}

.savebtn {
    color: #fff;
    /* background-color: #bc1212; */
    /* border-color: #b01111; */
    background-image: linear-gradient(45deg, #13b0c1, transparent) !important;
}

.nav-link{
    /* color: #392779; */
    color: #000000 !important;
    
}

.them_change{
    background-color:#fff !important;
    
}

.them_change_second{
    background-color:#1c9caa !important;
   
} 


.card_table_data {
    border: solid 1px #EB1616;
    border-radius: 8px;
    background: #06163a !important;
    padding: 10px 10px 0px;
    box-shadow: 0 0 10px #EB1616;
    margin-bottom: 15px;
    color: #6C7293;
}
</style>
@endif
    <div class="container-fluid them_change_second">
      <!-- Breadcrumbs-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Upload Resume</h2>
			</div>
			@php
			$uid = session()->get('FRONT_USER_ID');
			$Pdfs = DB::table('pdf')->where('uid',$uid)->first();
			@endphp
			<!--<form action="savePdf" method="post" enctype="multipart/form-data">-->
			<!--	 @csrf-->
			<!--    <div class="row">-->
   <!-- 				<div class="col-md-6">-->
   <!-- 					<div class="form-group">-->
   <!-- 						<label>PDF Only</label>-->
   <!-- 						<input type="file" name="pdf" class="form-control" accept="application/pdf" required> -->
   <!-- 						<embed class="form-control mt-3" src="{{asset('images')}}/{{isset($Pdfs->pdf) && $Pdfs->pdf !='' ? $Pdfs->pdf :''}}" width="500" height="375" type="application/pdf">-->
   <!-- 					<input type="hidden" name="id" value="{{isset($Pdfs->id) && $Pdfs->id !='' ? $Pdfs->id :''}}">-->
   <!-- 					</div>-->
   <!-- 					<p style="color:red;">@error('Pdf'){{$message}}@enderror</p>-->
   <!-- 				</div>-->
   <!-- 			 </div>-->
			<!--<button type="submit" class="btn btn_1 savebtn" name="submit">Save</button>-->
			<!--</form>-->
			<form action="savePdf" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Select PDF or Images</label>
                <input type="file" 
                       name="pdf[]" 
                       class="form-control" 
                       accept="application/pdf,image/*" 
                       multiple 
                       required>
                @error('pdf')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn savebtn">Upload</button>
        </form>
          <h3 class="mt-4">My Resumes</h3>
    <div class="row">
        @php
            $uid = session()->get('FRONT_USER_ID');
            $achievements = DB::table('pdf')->where('uid',$uid)->get();
        @endphp

        @forelse($achievements as $achiv)
            <div class="col-md-2">
                <div class="achievement-card">
                    @if(Str::endsWith(strtolower($achiv->pdf), '.pdf'))
                        <embed src="{{ asset('public/images/'.$achiv->pdf) }}" 
                           type="application/pdf" 
                           width="100px" 
                           height="100px">
                    @else
                        <img src="{{ asset('public/images/'.$achiv->pdf) }}" width="100px" height="100px" />
                    @endif
                        
                   <div class="d-flex gap-4 mt-2">
                    <form action="{{ url('deletePdf/'.$achiv->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>

                    <a href="{{ asset('public/images/'.$achiv->pdf) }}" download class="btn btn-sm btn-primary ml-2">
                        Download
                    </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p style="color: #fff;">No resume uploaded yet.</p>
            </div>
        @endforelse
    </div>
		</div>
	  </div>
	  <!-- /.container-fluid-->
@endsection