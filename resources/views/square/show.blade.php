@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">{{$square->name}}</h1>
    </div>
	<div class="panel-body">
		
		{{$square->lat}} 	<br>
		{{$square->lng}}

		<div id="map"></div>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuynfyxz-W2otXa1bFVB82ZPEjzz3NKNQ"></script>
	    <script>

			var map = new google.maps.Map(document.getElementById('map'), {
				center: {
					lat: <?php echo $square->lat ?>,
					lng: <?php echo $square->lng ?>
				},
				zoom: 8
			});

	    </script>
		
	</div>
</div>


@endsection
