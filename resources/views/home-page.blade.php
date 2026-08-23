@extends('layouts.main-layout')

@section('content')

<div>
  
  <div>

    @for ($i = 0; $i < 2; $i++)
      @include('partials.midia-item')
    @endfor

  </div>

</div>

@endsection