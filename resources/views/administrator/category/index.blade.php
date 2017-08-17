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
            <li><a href="/administrator/user" class="">USUARIO</a></li>
            <li class="active"><a href="/administrator/category" class="active">CATEGORIA</a></li>
            <li><a href="/administrator/mark" class="">MARCA</a></li>
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
    <h1>CATEGORIAS</h1>
    <ol class="breadcrumb">
      <li><a href="/administrator/home">Home</a></li>
      <li class="active">Categorias</li>
    </ol>
    <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalCreateCategory'>Crear</button> <button class='btn btn-warning btn-sm' id='pdfCategory'>Pdf</button>
    <table class="table" id="tablaCategory">
      <thead>
        <th>ID</th>
        <th>CATEGORIA</th>
        <th>OTRO</th>
        <br>
      </thead>
      <tbody>

      </tbody>
    </table>


    @include('administrator.category.create')
    @include('administrator.category.edit')
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
    var tablaCategory= $('#tablaCategory').DataTable({
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
        url: "https://super-restlvl2.ssmagallanes.cl/api/administrator/category/list",
        error: function (xhr, error, thrown) {
          $(location).attr('href', 'http://super-restlvl2.dev/');
          console.log("ERROR"+error+xhr+thrown);
        }
      },
      columns: [
        {data: 'id', name: 'id'},
        {data:'type', name:'type'},
        {
          targets: -1,
          data: null,
          orderable: false,
          searchable: false,
          defaultContent: "<button class='editCategory btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditCategory'>editar</button> <button class='delCategory btn btn-danger btn-sm'>Eliminar</button>"
        }],
      });

      $(document).on('submit','#FormCategory',function(event){
        event.preventDefault();
        var formData=new FormData($(this)[0]);
        console.log(formData);
        $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category',
        {
          type: "POST",
          dataType: "JSON",
          cache: false,
          contentType: false,
          processData: false,
          data:formData,
          success: function(resp){
            $("#modalCreateCategory").modal('toggle');
            tablaCategory.ajax.reload();
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

      $(document).on('click','.editCategory',function(){
        $(".window").css("visibility","visible");
        $(".window2").css("visibility","hidden");
        var data=tablaCategory.row($(this).parents('tr')).data();
        console.log(data.id);
        $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category/'+data.id,{
          method: "GET",
          success: function(resp){
            $(".window").css("visibility","hidden");
            $(".window2").css("visibility","visible");
            $("#FormEditCategory input[name=id]").val(resp.category.id);
            $("#FormEditCategory input[name=type]").val(resp.category.type);
          },
          error: function(req,statu,err){
            $(location).attr('href', 'http://super-restlvl2.dev/');
          }
        });
      });

      $(document).on('submit','#FormEditCategory',function(event){
        event.preventDefault();
        var formData=new FormData($(this)[0]);
        console.log(formData.get("id"));
        $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category/'+formData.get("id"),
        {
          type: "POST",
          headers: {"X-HTTP-Method-Override": "PUT"},
          dataType: "JSON",
          cache: false,
          contentType: false,
          processData: false,
          data:formData,
          success: function(resp){
            $("#modalEditCategory").modal('toggle');
            tablaCategory.ajax.reload();
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
                $("#validCategory").append(value);
                console.log(value);
              });
            }
          }
        });
      });

      $(document).on('click','.delCategory',function(){
        var data=tablaCategory.row($(this).parents('tr')).data();
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
            $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category/'+data.id,{
              method: 'DELETE',
              success:function(resp){
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                tablaCategory.ajax.reload();
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

      $(document).on('click','#pdfCategory',function(){
        window.location.href='/report/category';
      });
    });
    </script> --}}
  @endsection
