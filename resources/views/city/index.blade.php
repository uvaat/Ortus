@extends('layouts.app')

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">
		
    	Liste des ville

    </div>

	<div class="panel-body">
		<a href="{{route('admin::city.create')}}" type="button" class="btn btn-primary">Ajouter une ville</a>
	</div>

	<table class="table table-striped">

		<tr>
			<th></th>
			<th>Nom</th>
			<th></th>
			<th></th>
		</tr>

		<!-- @foreach ($cities as $cities)
			<tr>
				<td><b>#{{ $cities->id }}</b></td>
				<td><a class="btn btn-link" href="{{ route('admin::cities.show', ['id' => $cities->id]) }}">{{ $cities->name }}</a></td>
				<th>
					<a href="{{ route('admin::cities.edit', ['id' => $cities->id]) }}" class="btn btn-link">éditer</a>
				</th>
				<th>
					<form method="POST" action="{{route('admin::cities.destroy', ['id' => $cities->id])}}">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn-danger btn btn-link">supprimer</button>
					</form>
				</th>
			</tr>
    		
		@endforeach -->

	</table>
	
	<!-- @if ($cities->hasMorePages())
		<div class="panel-body">
			{{ $cities->links() }}
		</div>
	@endif -->
	
</div>

@endsection