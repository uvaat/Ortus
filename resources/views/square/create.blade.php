@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">Ajouter un square</div>
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
				<input type="text" class="form-control" id="name" name="name">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

			</div>

			<div class="form-group{{ $errors->has('lat') ? ' has-error' : '' }}">

				<label for="lat">Latitude</label>
				<input type="text" class="form-control" id="lat" name="lat">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lat') }}</strong>
                    </span>
                @endif

			</div>

			<div class="form-group{{ $errors->has('lng') ? ' has-error' : '' }}">

				<label for="lat">Longitude</label>
				<input type="text" class="form-control" id="lng" name="lng">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lng') }}</strong>
                    </span>
                @endif

			</div>

			<div class="form-group{{ $errors->has('equipments') ? ' has-error' : '' }}">
				
				<label for="lat">Equipment(s)</label><br>
				
				<select name="equipments[]" id="equipments" class="selectpicker" multiple>
					@foreach ($equipments as $equipment)
						<option value="{{$equipment->id}}">{{$equipment->name}}</option>
					@endforeach
				</select>

				@if ($errors->has('equipments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('equipments') }}</strong>
                    </span>
                @endif

			</div>

			<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">

				<label for="lat">Ville</label><br>
				
				<select name="city" id="city" class="selectpicker">
					@foreach ($cities as $city)
						<option value="{{$city->id}}">{{$city->name}}</option>
					@endforeach
				</select>

				@if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif

			</div>

			<button type="submit" class="btn btn-default">Enregistrer</button>

		</form>
	</div>
</div>


@endsection
