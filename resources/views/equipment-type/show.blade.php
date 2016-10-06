@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">{{$equipment->name}}</h1>
    </div>
    <div class="panel-body">
    	<a href="{{ route('admin::equipment-type.edit', ['id' => $equipment->id]) }}" type="button" class="btn btn-primary">Éditer</a>
    </div>

</div>

<div class="row">



</div>

@endsection
