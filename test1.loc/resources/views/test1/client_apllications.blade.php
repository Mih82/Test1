<div>
  
  {{ !empty( session('status') ) ? session('status') : '' }}
	@if( !empty( $apllications ) )
	<table>
		<tr> <th>Имя</th> <th>Сообщение</th> <th>Файл</th> <th>Почта</th> <th>Дата заявки</th> </tr>
		
		  @foreach( $apllications as $apllication )		
			<tr>
				<td> {{ $apllication->name }} </td>
				<td> {{ $apllication->text }} </td>
				<td> <img src="{{ asset('storage/'.$apllication->path) }}" alt="images" height="50pt" ></td>
				<td> {{ $apllication->email }} </td>
				<td> {{ $apllication->created_at->format('H:i d m, Y') }} </td>
			</tr>
		 @endforeach		
	</table>
	@endif
	
</div>