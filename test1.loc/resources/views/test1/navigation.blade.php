<div>
	<a href="{!! route( 'client.create' ) !!}" >Создать заявку</a>
	<a href="{!! route( 'client.show', ['id'=> Auth::user('id')] ) !!}" >Все ваши заявки</a>
</div>
	<div> {!! Form::open( [ 'url'=>'logout' , 'method'=>'post' ] ) !!}
			@csrf	
	        {!! Form::submit('Выйти') !!}
		{!! Form::close() !!}
	</div>