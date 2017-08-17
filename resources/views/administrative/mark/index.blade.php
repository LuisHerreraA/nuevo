@extends('layouts.template')
@section('cabecera')
  <div id="preloader" class="loader" style="visibility: visible"></div>
  <div class="administrativeWindow" style="visibility: hidden">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="user" href="/administrative/home"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/administrative/category">CATEGORIA</a></li>
            <li class="active"><a href="/administrative/mark">MARCA</a></li>
            <li><a href="/administrative/product">PRODUCTO</a></li>
            <li><a href="#" id="exit">CERRAR SESION</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
@endsection
@section('cuerpo')

  <div class="administrativeWindow" style="visibility: hidden">
    <br><br><br><br><br><br><br>
    <h1>MARCA</h1>
    <br>
    <ol class="breadcrumb">
      <li><a href="/administrative/home">Home</a></li>
      <li class="active">Marcas</li>
    </ol>
    <br><br>
    <button class='btn btn-warning btn-sm' id='pdfMark'>PDF</button>
    <br>
    <table class="table" id="tablaMarkAdm">
      <thead>
        <th>ID</th>
        <th>MARCA</th>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
  {{-- <script>
  $.ajaxSetup({
    beforeSend: function(xhr){
      xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
    }
  });
  $(document).ajaxSuccess(function(event, request, setting){
    if(request.status==200)
    {
      $(".loader").css("visibility","hidden");
      $(".administrativeWindow").css("visibility","visible");
    }
    console.log(request.status);
  });
  $(document).ajaxError(function(event,request,setting){
    if (request.status==501) {
      $(location).attr('href','http://super-restlvl2.dev/501');
    }
    console.log(request.status);
  });

  $(document).ready(function(){
    console.log(localStorage.getItem('token'));

    var tablaMarkAdm= $('#tablaMarkAdm').DataTable({
      language:{
        emptyTable: "No hay datos disponibles",
        info: "Mostrando _START_ a _END_ del _TOTAL_ de entradas",
        infoEmprty: "Mostrando 0 a 0 de 0 entradas",
        infoFiltered: "(Filtrado de _MAX_ entradas totales)",
        lengthMenu: "Mostrar _MENU_ entradas",
        loadingRecords: "Cargando",
        processing:     "Procesando",
        search: "Buscar",
        zeroRecords:    "No hay registros encontrados",
        paginate: {
        first:      "PRIMERA",
        last:       "ULTIMA",
        next:       "SIGUIENTE",
        previous:   "ANTERIOR"
      }},
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: {
        url: "https://super-restlvl2.ssmagallanes.cl/api/administrative/mark/list",
        error: function (xhr, error, thrown) {
          console.log("ERROR"+error+xhr+thrown);
        }
      },
      columns: [
        {data: 'id', name: 'id'},
        {data:'name', name:'name'}
      ],
    });
  });
  </script> --}}
@endsection
