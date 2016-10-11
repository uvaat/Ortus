@extends('layouts.admin')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">Ajouter un équipement</div>
	<div class="panel-body">
		
		@if(Session::has('success'))
			<div class="alert alert-success" role="alert">
				{{Session::get('success')}}
			</div>
        @endif

		<form role="form" method="POST" action="{{ url('/admin/equipment') }}">

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

			<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">

				<label for="equipmentType">Type</label><br>
				
				<select name="equipmentType" id="equipmentType" class="selectpicker">
					@foreach ($equipmentTypes as $equipmentType)
						<option value="{{$equipmentType->id}}">{{$equipmentType->name}}</option>
					@endforeach
				</select>

				@if ($errors->has('equipmentType'))
                    <span class="help-block">
                        <strong>{{ $errors->first('equipmentType') }}</strong>
                    </span>
                @endif

			</div>

			<button type="submit" class="btn btn-default">Enregistrer</button>

		</form>
	</div>
</div>


@endsection
