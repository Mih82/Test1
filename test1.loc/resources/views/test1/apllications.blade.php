@extends(env('THEME').'.layouts.site')

@section('navigation')
  @include( env('THEME').'.navigation' )
@endsection

@section('content')
  @include( env('THEME').'.client_apllications' )
@endsection