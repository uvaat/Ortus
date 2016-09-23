@extends('layouts.app')

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">Liste des squares</div>

	<div class="panel-body">
		<a href="{{route('admin::square.create')}}" type="button" class="btn btn-primary">Ajouter un square</a>
	</div>

	<table class="table table-striped">

		<tr>
			<th></th>
			<th>Nom</th>
			<th>Latitude</th> 
			<th>Longitude</th>
			<th></th>
		</tr>

		@foreach ($squares as $square)
			<tr>
				<td><b>#{{ $square->id }}</b></td>
				<td>{{ $square->name }}</td>
				<td>{{ $square->lat }}</td> 
				<td>{{ $square->lng }}</td>
				<th>
					<a href="{{ route('admin::square.edit', ['id' => $square->id]) }}" class="">éditer</a>
				</th>
			</tr>
    		
		@endforeach

	</table>
	
	{{ $squares->links() }}

	
</div>

@endsection