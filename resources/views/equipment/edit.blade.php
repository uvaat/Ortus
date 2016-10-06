@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">Éditer le square {{$equipment->name}}</h1>
    </div>
	<div class="panel-body">
		
		@if(Session::has('success'))
			<div class="alert alert-success" role="alert">
				{{Session::get('success')}}
			</div>
        @endif

        @if(Session::has('error'))
			<div class="alert alert-error" role="alert">
				{{Session::get('error')}}
			</div>
        @endif

		<form role="form" method="POST" action="{{ route('admin::equipment.update', ['id' => $equipment->id]) }}">
	
			{{ method_field('PUT') }}
            {{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

				<label for="name">Nom</label>
				<input type="text" class="form-control" id="name" name="name" value="{{$equipment->name}}">

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
						<option {{($equipmentType->id == $equipment->type->id)? 'selected' : ''}}  value="{{$equipmentType->id}}">{{$equipmentType->name}}</option>
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
