@extends(env('THEME').'.layouts.site')

@section('navigation')
  @include( env('THEME').'.mod_navigation' )
@endsection


@section('content')

{{ !empty( session('status') ) ? session('status') : '' }}

 @if( !empty( $apllications ) )
  <div>
	<table>
		<tr> <th>id</th> <th>Имя</th> <th>Тема</th> <th>Время Создания</th> <th>Ответил</th> </tr>
		@foreach( $apllications as $apllication )
		  <tr>
				
				 <td>{{ $apllication->id }}</td> <td>{{ $apllication->name }}</td><td>{{ $apllication->topic }}</td>
						<td>{{ $apllication->created_at->format('H:i d m Y') }}</td>
						<td> {{ $apllication->status == 'true' ? 'ответил' : 'не ответил' }} </td>
						<td><a href="{{ route( 'moderator.show' , [ 'id'=>$apllication->id ] ) }}" > Просмотреть</a></td>
						<td> 
				{!! Form::open([ 'url'=>'moderator/'.$apllication->id,'method'=>'PUT'  ]) !!}
					@csrf
					{{ Form::checkbox( 'status', 'true', $status = $apllication->status == 'true' ? 'true' : '' ) }}	
	                {!! Form::submit('Отметить') !!}
				{!! Form::close() !!}
			</td>
			<td> 
				{!! Form::open([ 'url'=>'moderator/'.$apllication->id,'method'=>'DELETE'  ]) !!}
					@csrf	
	                {!! Form::submit('Удалить') !!}
				{!! Form::close() !!}
			</td>
			
		  </tr>
		@endforeach
	</table>
  </div>
 @endif
@endsection