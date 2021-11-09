<div>
	<a href="{!! route( 'moderator.index' ) !!}" > Все заявки </a>
	<div> {!! Form::open( [ 'url'=>'logout' , 'method'=>'post' ] ) !!}
			@csrf	
	        {!! Form::submit('Exit') !!}
		{!! Form::close() !!}
	</div>
</div>