@extends('layouts.app')

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">
		
    	Liste des squares

    </div>

	<div class="panel-body">
		<a href="{{route('admin::square.create')}}" type="button" class="btn btn-primary">Ajouter un square</a>
	</div>

	<table class="table table-striped">

		<tr>
			<th></th>
			<th>Nom</th>
			<th>Ville</th>
			<th>Latitude</th> 
			<th>Longitude</th>
			<th>Nombre d'équipements</th>
			<th></th>
			<th></th>
		</tr>

		@foreach ($squares as $square)
			<tr>
				<td><b>#{{ $square->id }}</b></td>
				<td><a class="btn btn-link" href="{{ route('admin::square.show', ['id' => $square->id]) }}">{{ $square->name }}</a></td>
				<td><a href="{{ route('admin::city.show', ['id' => $square->city->id]) }}" class="btn btn-link">{{ $square->city->name }}</a></td> 
				<td>{{ $square->lat }}</td> 
				<td>{{ $square->lng }}</td>
				<td>{{ count($square->equipments) }}</td>
				<th>
					<a href="{{ route('admin::square.edit', ['id' => $square->id]) }}" class="btn btn-link">éditer</a>
				</th>
				<th>
					<form method="POST" action="{{route('admin::square.destroy', ['id' => $square->id])}}">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn-danger btn btn-link">supprimer</button>
					</form>
				</th>
			</tr>
    		
		@endforeach

	</table>

	@if ($squares->count() > 10)
		<div class="panel-body">
			{{ $squares->links() }}
		</div>
	@endif
	
</div>

@endsection