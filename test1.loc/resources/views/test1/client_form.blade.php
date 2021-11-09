<div>
  
  {{ !empty( $errors->first() ) ? $errors->first() : '' }}

{!! Form::open(['route'=>'client.store', 'files'=>'true']) !!}
	@csrf
	<p>Тема
	{!! Form::text( 'topic'  ) !!}
	</p>
	<p>Сообщение
	{!! Form::text( 'text'  ) !!}
	</p>
	{!! Form::file( 'file' ) !!}	
	  {!! Form::submit('Отправить') !!}
    {!! Form::close() !!}


</div>