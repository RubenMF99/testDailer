
 @extends('layouts.app')
@section('contenido')
<br>
<br>
<br>
<br>

<div class="container">
    <br>
    <parcial-final curso ="{{ $curso }}" person ="{{session()->get('id_persona')}}"></parcial-final>
</div>
@endsection
 
 



