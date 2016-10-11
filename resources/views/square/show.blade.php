@extends('layouts.admin')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">{{$square->name}}</h1>
    </div>
	<!-- <div class="panel-body"> -->

		<div id="map"></div>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuynfyxz-W2otXa1bFVB82ZPEjzz3NKNQ"></script>
	    <script>

	   		var latLng = {lat: <?php echo $square->lat ?>, lng: <?php echo $square->lng ?>};

			var map = new google.maps.Map(document.getElementById('map'), {
				center : latLng,
				zoom   : 18,
				mapTypeId: google.maps.MapTypeId.SATELLITE
			});

			var marker = new google.maps.Marker({
				position : latLng,
				map      : map
			});

	    </script>
		
	<!-- </div> -->
</div>


@endsection
