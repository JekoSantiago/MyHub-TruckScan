@extends('layouts.main')
@section('content')

    <div class="d-flex flex-column align-middle ">
        <div class="pl-2 clearfix  centered">
            <h3>Press to Scan</h3>
            <a href="javascript:void(0)" id="QR"><img style="width: 150px ; height: 150px" src="{{asset('assets/images/qr-code.png')}}" class="img-thumbnail">
            </a>
        </div>
        <div id="plate" style = "display:none">
            <h3 class="text-center pt-2">Truck Plate No.</h3>
            <h1 id="truckplate" class="text-success"></h1>
        </div>

        <div class="text-center" id="loading" style = "display:none"><div class="spinner spinner-border">Loading...</div></div>

        <div id="logdate" style = "display:none">
            <h4 class="text-center pt-2 ">Log Date</h4>
            <h4 id="logdatetext"></h1>
        </div>
    </div>

    <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
@endsection

@section('js')
@endsection
