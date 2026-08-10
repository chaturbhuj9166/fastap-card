@extends('layouts.user_layout')
@section('page_title','Dashboard')
@section('content')
<style>
.inner_leads_main {
    /*background: #6d28d9de;*/
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 10px 12px;
    /*color: #fff;*/
    margin-bottom: 5px;
    
    background-color: #191C24 !important;
	color: #FFFFFF;
}
.fa-commenting {
    color: #BC1212; !important;

}
.fa-id-card {
    color: #BC1212; !important;
    
}
.inner_leads_main p i {
    font-size: 51px;
}
.inner_leads_main p {
    margin-bottom: 0px;
    text-align: center;
}
.inner_leads_main p span {
    font-size: 38px;
}
.leads_table {
    /*background: #fff;*/
    background-color: #191C24 !important;
    padding: 13px 15px;
    border-radius: 19px;
    box-shadow: 0 0 9px #7f43dd42;
    margin-bottom: 30px;
    color: #FFFFFF;
}
.inner_leads_main:hover {
    /*box-shadow: 0 0 12px #7f43dd;*/
    box-shadow: 0 0 12px #EB1616;
}

.pdf_download_btn{
    color: #fff;
    background-color: #bc1212;
    border-color: #b01111;
}
.pdf_download_btn:hover {
    color: #c81313;
    background-color: #fff;
    border-color: #bc1212;
}

.clock {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    color: #868e96;
    font-size: 60px;
    font-family: Orbitron;
    /*letter-spacing: 7px;*/
    letter-spacing: 4px;
    width: 100%;
    
    background-color: #191C24 !important;
    padding: 5px 12px;
    border-radius: 12px;

}

.clock:hover {
    /*box-shadow: 0 0 12px #7f43dd;*/
    box-shadow: 0 0 12px #EB1616;
}

#MyClockDisplay{padding: 0px;height: 96%;}
/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/
@media (min-width: 320px) and (max-width: 480px) {
  .container-fluid{margin-top: 30px;}
  #MyClockDisplay{margin-top: 5%;width: 93%; font-size: 40px;text-align: center;}
  .leads_table{margin-top: 20%;}
}

.inner_leads_main {
    /* background: #6d28d9de; */
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 10px 12px;
    /* color: #fff; */
    margin-bottom: 5px;
    background-color: #191C24 !important;
    color: #FFFFFF;
    height: 150px;
}
</style>

@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
   .them_change{
    background-color:#ffff !important;
    
}

.them_change_second{
    background-color:#daa520 !important;
   
} 

.box1{
    background-color:#3299ff !important; 
}
.box2{
    background-color:#fab114 !important; 
}
.box3{
    background-color:#e65252 !important; 
}

.box4{
    background-color:#321fdb !important; 
}
    .fa-id-card {
    color: #ffffff;
    !important: ;
}

.fa-commenting {
    color: #ffffff;
    !important: ;
}

.pdf_download_btn {
    color: #fff;
    background-color: #18a1b0;
    border-color: #17a7b6;
}

@media (min-width: 320px) and (max-width: 480px){
.leads_table {
    margin-top: 30%;
}
#MyClockDisplay {
    margin-top: 17%;
    /* margin-bottom: 10px !important; */
    width: 93%;
    font-size: 40px;
    text-align: center;
    /* height: 94px !important; */
    height: 143px !important;
    padding-bottom: 10px !important;
}

.box1 {
    background-color: #3299ff !important;
    margin-top: 17px;
}

}



</style>

@endif
<div class="container-fluid them_change">
    <div class="row">
        <div class="col-md-12 mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="inner_leads_main box1">
                    <p><b>Total Taps</b><br>
                    <span>{{$user->leadcount}}</span></p>
                    <p><i class="fa fa-id-card" aria-hidden="true"></i></p>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="inner_leads_main box2">
                    <p><b>Received Leads</b><br><span>{{$user->messages->count()}}</span></p>
                    <p><i class="fa fa-commenting" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="col-md-4">
                <!--<div class="inner_leads_main">-->
                <!--    <p><b>Total Leads</b><br><span>{{$user->messages->count()+$user->leadcount}}</span></p>-->
                <!--    <p><i class="fa fa-bullhorn" aria-hidden="true"></i></p>-->
                <!--</div>-->
                
                    <!--div id="MyClockDisplay" class="clock box3 text-white" onload="showTime()"></div-->
                    @if(Session::get('panel') == 1)
                    <div  class="clock text-white" onload="showTime()" style="background-color: #000000 !important;"><img src="{{asset('assets/3dgifmaker58017.gif')}}"></div>
@endif
            </div>
        </div>
    </div>
    
    <div class="col-md-12 mt-5">
        <div class="leads_table box4">
            <h4 class="float-left">My Leads</h4>
            <a href="" class="btn btn-primary float-right mb-2 pdf_download_btn">All Leads PDF Download</a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>NAME</th>
                        <th>MOBILE</th>
                        <th>MESSAGE</th>
                      </tr>
                    </thead>
                    <tbody>
                        @isset($user->messages)
                        @foreach($user->messages as $msg)
                         <tr>
                        <td>{{$msg->name}}</td>
                        <td>{{$msg->mobile}}</td>
                        <td>{{$msg->Message}}</td>
                      </tr>
                        @endforeach
                     
                     @endisset
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-12 mt-5">
        <div class="leads_table box4">
            <h4 class="float-left">My Poduct Leads</h4>
            <!--a href="" class="btn btn-primary float-right mb-2 pdf_download_btn">All Leads PDF Download</a-->
            <div class="table-responsive">
                <table class="table table-hover">
                    @php
                    $prleads =DB::table('product_lead')
                    ->select('*','product_lead.name as pname','product_lead.city as pcity','product_lead.mobile as pmobile')
                    ->leftJoin('myproducts','myproducts.id','=','product_lead.pid')
                    ->where('product_lead.user_id',session::get('FRONT_USER_ID'))
                    ->get()
                    
                    @endphp
                    <thead>
                      <tr>
                        <th>NAME</th>
                        <th>MOBILE</th>
                        <th>City</th>
                        <th>Product</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody>
                        @isset($prleads)
                        @foreach($prleads as $pr)
                         <tr>
                        <td>{{$pr->pname}}</td>
                        <td>{{$pr->pmobile}}</td>
                        <td>{{$pr->pcity}}</td>
                        <td>{{$pr->title}}</td>
                        <td>{{$pr->price}}</td>
                      </tr>
                        @endforeach
                     
                     @endisset
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    
    function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();

</script>


@endsection