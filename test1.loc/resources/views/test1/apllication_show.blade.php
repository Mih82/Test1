@extends(env('THEME').'.layouts.site')

@section('navigation')
  @include( env('THEME').'.mod_navigation' )
@endsection

@section('content')
 @if( !empty( $apllication ) )
  <div>
	<table>
		<tr> <th>id</th> <th>Имя</th> <th>Тема</th> <th>Сообщение</th> <th>Файл</th> <th>Время Создания</th> <th>Ответил</th> </tr>
		  <tr>
			<td>{{ $apllication->id }}</td> <td>{{ $apllication->name }}</td><td>{{ $apllication->topic }}</td>
			<td> {{ $apllication->text }} </td>
			<td><img src="{{ asset('storage/'.$apllication->path) }}" alt="images" height="50pt" ></td>
			<td>{{ $apllication->created_at->format('H:i d m, Y') }}</td>
			<td> 
				{!! Form::open([ route( 'moderator.update', $apllication->id ),'method'=>'put'  ]) !!}
					@csrf
					{{ Form::checkbox( 'status', 'true', $status = $apllication->status == 'true' ? 'true' : '' ) }}	
	                {!! Form::submit('Отметить') !!}
				{!! Form::close() !!}
			</td>
			<td> 
				{!! Form::open([ route( 'moderator.destroy', $apllication->id ),'method'=>'delete'  ]) !!}
					@csrf	
	                {!! Form::submit('Удалить') !!}
				{!! Form::close() !!}
			</td>
			
		  </tr>
	</table>
  </div>
 @endif
@endsection