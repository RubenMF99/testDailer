@extends('layouts.login')
@section('contenido')



    <div class="ddco-content-fixed">
        <img src="/img/fondos/fondologin.jpg" style="position:fixed;z-index:-1;" alt="" srcset="">
    </div>
    <div class="ddco-content-relative">
        <div class="container">
            <login-two ruta="{{asset('')}}"></login-two>
        </div>
    </div>




@endsection