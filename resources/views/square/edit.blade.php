@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">Éditer le square {{$square->name}}</h1>
    </div>
	<div class="panel-body">
		
		@if(Session::has('success'))
			<div class="alert alert-success" role="alert">
				{{Session::get('success')}}
			</div>
        @endif

		<form role="form" method="POST" action="{{ url('/admin/square') }}">

            {{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

				<label for="name">Nom</label>
				<input type="text" class="form-control" id="name" name="name" value="{{$square->name}}">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

			</div>

			<div class="form-group{{ $errors->has('lat') ? ' has-error' : '' }}">

				<label for="lat">Latitude</label>
				<input type="text" class="form-control" id="lat" name="lat" value="{{$square->lat}}">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lat') }}</strong>
                    </span>
                @endif

			</div>

			<div class="form-group{{ $errors->has('lng') ? ' has-error' : '' }}">

				<label for="lat">Longitude</label>
				<input type="text" class="form-control" id="lng" name="lng" value="{{$square->lng}}">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lng') }}</strong>
                    </span>
                @endif

			</div>

			<button type="submit" class="btn btn-default">Enregistrer</button>

		</form>
	</div>
</div>


@endsection
