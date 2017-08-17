@extends('layouts.template')
@section('cabecera')
  <div id="preloader" class="ventana2" style="visibility: visible"></div>
  <div class="ventana" style="visibility: hidden">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/administrator/home">ADMINISTRADOR</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/administrator/user" class="active">USUARIO</a></li>
            <li><a href="/administrator/category" class="">CATEGORIA</a></li>
            <li><a href="/administrator/mark" class="">MARCA</a></li>
            <li><a href="/administrator/product">PRODUCTO</a></li>
            <li><a href="#" id="exit">Cerrar sesion</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

@endsection
@section('cuerpo')

  <div class="ventana" style="visibility: hidden">
    <br><br><br><br><br><br><br>
    <center><h1>BIENVENIDO A CASA ADMINISTRADOR </h1><center>
      <center><h2 id="bienv"></h2><center>
      </div>

    @endsection

    @section('scripts')
      {{-- <script>

      $(document).ready(function(){
        var decoded = jwt_decode(localStorage.getItem('token'));
        if (decoded.datos.role_id==1) {
          $(".ventana2").css("visibility","hidden");
          $(".ventana").css("visibility","visible");
          $("#bienv").append(''+decoded.datos.name);
        }else{
          $(location).attr('href','http://super-restlvl2.dev/501');
        }
      });
      </script> --}}
    @endsection
