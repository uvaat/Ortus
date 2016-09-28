@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">Éditer la ville {{$city->name}}</h1>
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

		<form role="form" method="POST" action="{{ route('admin::city.update', ['id' => $city->id]) }}">
	
			{{ method_field('PUT') }}
            {{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

				<label for="name">Nom</label>
				<input type="text" class="form-control" id="name" name="name" value="{{$city->name}}">

				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

			</div>

			<button type="submit" class="btn btn-default">Enregistrer</button>

		</form>
	</div>
</div>


@endsection
