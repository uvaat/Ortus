@extends('layouts.app')

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">
		
    	Liste des type d'équipements

    </div>

	<div class="panel-body">
		<a href="{{route('admin::equipment-type.create')}}" type="button" class="btn btn-primary">Ajouter un type</a>
	</div>

	<table class="table table-striped">

		<tr>
			<th></th>
			<th>Nom</th>
			<th></th>
			<th></th>
		</tr>

		@foreach ($equipments as $equipment)
			<tr>
				<td><b>#{{ $equipment->id }}</b></td>
				<td><a class="btn btn-link" href="{{ route('admin::equipment-type.show', ['id' => $equipment->id]) }}">{{ $equipment->name }}</a></td>
				<th>
					<a href="{{ route('admin::equipment-type.edit', ['id' => $equipment->id]) }}" class="btn btn-link">éditer</a>
				</th>
				<th>
					<form method="POST" action="{{route('admin::equipment-type.destroy', ['id' => $equipment->id])}}">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn-danger btn btn-link">supprimer</button>
					</form>
				</th>
			</tr>
    		
		@endforeach

	</table>
	
	@if ($equipments->hasMorePages())
		<div class="panel-body">
			{{ $equipments->links() }}
		</div>
	@endif
	
</div>

@endsection