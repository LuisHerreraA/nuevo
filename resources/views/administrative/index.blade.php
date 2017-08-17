@extends('layouts.template')
@section('cabecera')
  <div id="preloader" class="ventana2" style="visibility: visible"></div>
  <div class="ventana" style="visibility: hidden">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/administrative/home">Home</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/administrative/category">CATEGORIA</a></li>
            <li><a href="/administrative/mark">MARCA</a></li>
            <li><a href="/administrative/product">PRODUCTO</a></li>
            <li><a href="#" id="exit">CERRAR SESION</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
@endsection
@section('cuerpo')
  <div class="ventana" style="visibility: hidden">
    <br><br><br><br><br><br><br>
    <center><h1>BIENVENIDO A CASA ADMINISTRATIVO </h1><center>
      <center><h2 id="bienv"></h2><center>
      </div>
    @endsection
    @section('scripts')
      {{-- <script>

      $(document).ready(function(){
        var decoded = jwt_decode(localStorage.getItem('token'));
        var pathname = window.location.pathname;
        console.log(pathname);
        if (decoded.datos.role_id==2 && pathname.indexOf('administrative') >= 0) {
          $(".ventana2").css("visibility","hidden");
          $(".ventana").css("visibility","visible");
          $("#bienv").append(''+decoded.datos.name);
        }else if (decoded.datos.role_id==1 && pathname.indexOf('administrative') >= 0) {
          $(".ventana2").css("visibility","hidden");
          $(".ventana").css("visibility","visible");
          $("#bienv").append(''+decoded.datos.name);
        }else {
          $(location).attr('href','http://super-restlvl2.dev/501');
        }
      });
      </script> --}}
    @endsection
