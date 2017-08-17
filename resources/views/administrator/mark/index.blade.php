@extends('layouts.template')
@section('cabecera')
  <div id="preloader" class="loaderAdminstrator" style="visibility: visible"></div>
  <div class="viewAdministrator" style="visibility: hidden">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/administrator/home">ADMINISTRADOR</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/administrator/user">USUARIO</a></li>
            <li><a href="/administrator/category">CATEGORIA</a></li>
            <li class="active"><a href="/administrator/mark" >MARCA</a></li>
            <li><a href="/administrator/product">PRODUCTO</a></li>
            <li><a href="#" id="exit">CERRAR SESION</a></li>
          </ul>
          <label id='usuario' name='usuario' class="label label-success"></label>
        </div>
      </div>
    </nav>
  </div>
@endsection
@section('cuerpo')
  <div class="viewAdministrator" style="visibility: hidden">
    <br><br><br><br><br><br><br>
    <h1>MARCAS</h1>
    <ol class="breadcrumb">
      <li><a href="/administrator/home">Home</a></li>
      <li class="active">Marca</li>
    </ol>
    <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalCreateMark'>Crear</button> <button class='btn btn-warning btn-sm' id='pdfMark'>Pdf</button>
    <table class="table" id="tableMark">
      <thead>
        <th>ID</th>
        <th>MARCA</th>
        <th>OTRO</th>
      </thead>
      <tbody>

      </tbody>
    </table>


    @include('administrator.mark.create')
    @include('administrator.mark.edit')
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
      $(".loaderAdminstrator").css("visibility","hidden");
      $(".viewAdministrator").css("visibility","visible");
    }
    console.log(request.status);
  });
  $(document).ajaxError(function(event,request,setting){
    if(request.status==501)
    {
      $(location).attr('href','http://super-restlvl2.dev/501');
    }
    console.log(request.status);
  });

  $(document).ready(function(){
    console.log(localStorage.getItem('token'));
    var tablaMark= $('#tableMark').DataTable({
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
          url: "https://super-restlvl2.ssmagallanes.cl/api/administrator/mark/list",
          error: function (xhr, error, thrown) {
            //  $(location).attr('href', 'http://super-restlvl2.dev/');
            console.log("ERROR"+error+xhr+thrown);
          }
        },
        columns: [
          {data: 'id', name: 'id'},
          {data:'name', name:'name'},
          {
            targets: -1,
            data: null,
            orderable: false,
            searchable: false,
            defaultContent: "<button class='editMark btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditMark'>editar</button> <button class='delMark btn btn-danger btn-sm'>Eliminar</button>"
          }],
        });

        $(document).on('submit','#FormMark',function(event){
          event.preventDefault();
          var formData=new FormData($(this)[0]);
          console.log(formData);
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/mark',
          {
            type: "POST",
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(resp){
              $("#modalCreateMark").modal('toggle');
              tablaMark.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrow){
              if(jqXHR.status==0){
                console.log("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
              }else if (jqXHR.status == 404) {
                console.log("Pagina no encontrada [404]");
              }else if (jqXHR.status == 500) {
                console.log("Error interno en el servidor [500]");
              }else if (jqXHR.status == 400) {
                console.log("Token no Disponible [400]");
                $(location).attr('href', 'http://super-restlvl2.dev/');
              }else if (jqXHR.status == 422) {
                console.log("Error de validacion de campo [422]");
                var errores= jqXHR.responseJSON;
                $.each(errores, function(key, value){
                  $("#validMark").append(value);
                  console.log(value);
                });
              }
            }
          });
        });

        $(document).on('click','.editMark',function(){
          $(".loaderModalMark").css("visibility","visible");
          $(".viewModalMark").css("visibility","hidden");
          var data=tablaMark.row($(this).parents('tr')).data();
          console.log(data.id);
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/mark/'+data.id,{
            method: "GET",
            success: function(resp){
              $(".loaderModalMark").css("visibility","hidden");
              $(".viewModalMark").css("visibility","visible");
              $("#FormEditMark input[name=id]").val(resp.mark.id);
              $("#FormEditMark input[name=name]").val(resp.mark.name);
            },
            error: function(req,statu,err){
              $(location).attr('href', 'http://super-restlvl2.dev/');
            }
          });
        });

        $(document).on('submit','#FormEditMark',function(event){
          event.preventDefault();
          var formData=new FormData($(this)[0]);
          console.log(formData.get("id"));
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/mark/'+formData.get("id"),
          {
            type: "POST",
            headers: {"X-HTTP-Method-Override": "PUT"},
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(resp){
              $("#modalEditMark").modal('toggle');
              tablaMark.ajax.reload();
              console.log(resp);;
            },
            error: function(jqXHR, textStatus, errorThrow){
              if(jqXHR.status==0){
                console.log("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
              }else if (jqXHR.status == 404) {
                console.log("Pagina no encontrada [404]");
              }else if (jqXHR.status == 500) {
                console.log("Error interno en el servidor [500]");
              }else if (jqXHR.status == 400) {
                console.log("Token no Disponible [400]");
                $(location).attr('href', 'http://super-restlvl2.dev/');
              }else if (jqXHR.status == 422) {
                console.log("Error de validacion de campo [422]");
                var errores= jqXHR.responseJSON;
                $.each(errores, function(key, value){
                  $("#valid").append(value);
                  console.log(value);
                });
              }
            }
          });
        });

        $(document).on('click','.delMark',function(){
          var data=tablaMark.row($(this).parents('tr')).data();
          swal({
            title: "Estas seguro?",
            text: "Si lo haces no podras recuperar ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm) {
              $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/mark/'+data.id,{
                method: 'DELETE',
                success:function(resp){
                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  tablaMark.ajax.reload();
                },
                error: function(req,statu,err){
                  $(location).attr('href','http://super-restlvl2.dev/');
                }
              });
            } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
          });

        });

        $(document).on('click','#pdfMark',function(){
          window.location.href='/report/mark';
        });
      });
      </script> --}}
    @endsection
