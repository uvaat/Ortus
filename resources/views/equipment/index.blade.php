@extends('layouts.app')

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">
		
    	Liste des équipement

    </div>

	<div class="panel-body">
		<a href="{{route('admin::equipment.create')}}" type="button" class="btn btn-primary">Ajouter un équipement</a>
	</div>

	<table class="table table-striped">

		<tr>
			<th></th>
			<th>Nom</th>
			<th>Type</th>
			<th></th>
			<th></th>
		</tr>

		@foreach ($equipments as $equipment)
			<tr>
				<td><b>#{{ $equipment->id }}</b></td>
				<td><a class="btn btn-link" href="{{ route('admin::equipment.show', ['id' => $equipment->id]) }}">{{ $equipment->name }}</a></td>
				<td><a href="{{ route('admin::equipment-type.show', ['id' => $equipment->type->id]) }}" class="btn btn-link">{{ $equipment->type->name }}</a></td> 
				<th>
					<a href="{{ route('admin::equipment.edit', ['id' => $equipment->id]) }}" class="btn btn-link">éditer</a>
				</th>
				<th>
					<form method="POST" action="{{route('admin::equipment.destroy', ['id' => $equipment->id])}}">
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