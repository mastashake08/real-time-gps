@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      #map {
       height: 400px;
       width: 100%;
      }
   </style>
   <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                  <table class="table">
                  <tbody>
                    @foreach(auth()->user()->devices as $device)
                    <tr>
                      <td>{{$device->uuid}}</td>
                      <td>
                      <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-start-gps" id="start-gps"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                      <button data-id="{{$device->id}}" class="btn btn-sm btn-warning action-stop-gps" id="stop-gps"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                      <form method="post" action="/device/{{$device->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button data-id="{{$device->id}}" type="submit" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close" aria-hidden="true"></i></button>
                    </form>

                    </td>
                </tr>
                    @endforeach
                  </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>

                <div class="panel-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
var startGps = document.getElementsByClassName("action-start-gps");
var stopGps = document.getElementsByClassName("action-stop-gps");

for (var i = 0; i < startGps.length; i++) {
    startGps[i].addEventListener('click', function(){
      $.get("http://gps.app/command/start-gps/" + $(this).data('id'), function(data, status){
      }, false);
});
}

for (var i = 0; i < stopGps.length; i++) {
    stopGps[i].addEventListener('click', function(){
      $.get("http://gps.app/command/stop-gps/" + $(this).data('id'), function(data, status){
      }, false);
});
}
function initMap(lat,long) {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: uluru,

        });

        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        var socket = io.connect('http://gps.app:6001');
          socket.on('gps', function (data) {

          var center = {lat:Number(data.data.gps.lat),lng:Number(data.data.gps.long)};
            @foreach(auth()->user()->devices as $device)
              socket.on({{$device->id}}, function(data){
                console.log(data);
              });
            @endforeach

            marker.setPosition(center);

            // using global variable:


            map.panTo(center);

          })


      }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCDNt1biVyfA8h-eCZyZ69CKS6NNBCeEQ&callback=initMap">
    </script>
@endsection
