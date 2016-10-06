@extends('layouts.app')

@section('content')

   
<div class="panel panel-default">
	
    <div class="panel-heading">
    	<h1 class="panel-title">{{$city->name}} - {{$city->zip}}</h1>
    </div>
    <div class="panel-body">
    	<a href="{{ route('admin::city.edit', ['id' => $city->id]) }}" type="button" class="btn btn-primary">Éditer</a>
    </div>

</div>

<div class="row">

@foreach ($city->squares as $square)
	
	<div class="col-md-4">
		<a href="">
			<div class="panel panel-primary">
				
			    <div class="panel-heading">
			    	<h1 class="panel-title">{{$square->name}}</h1>
			    </div>
			    <div class="panel-body">
	    			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis excepturi ipsam vitae sed incidunt vero accusantium quidem inventore similique qui, minus ipsum repudiandae exercitationem suscipit dignissimos, ad voluptas, fugit quis.
	  			</div>

			</div>
		</a>
	</div>

@endforeach

</div>

@endsection
