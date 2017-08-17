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
            <li class="active"><a href="/administrator/user" class="active">USUARIO</a></li>
            <li><a href="/administrator/category" class="">CATEGORIA</a></li>
            <li><a href="/administrator/mark" class="">MARCA</a></li>
            <li><a href="/administrator/product">PRODUCTO</a></li>
            <li><a href="#" id="exit">CERRAR SESION</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
@endsection
@section('cuerpo')

  <div class="viewAdministrator" style="visibility: hidden">
    <br><br><br><br><br><br><br>
    <h1>USUARIOS</h1>
    <br>
    <ol class="breadcrumb">
      <li><a href="/administrator/home">Home</a></li>
      <li class="active">Usuarios</li>
    </ol>
    <button class='btn btn-success btn-sm createUser' data-toggle='modal' data-target='#modalCreateUser'>REGISTRAR</button>
    <br><br>
    <table class="table" id="tableUser">
      <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>

      </tbody>
    </table>

@include('administrator.user.create')
@include('administrator.user.edit')
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
    var tableUser= $('#tableUser').DataTable({
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
        url: "https://super-restlvl2.ssmagallanes.cl/api/administrator/user",
        error: function (xhr, error, thrown) {
          $(location).attr('href', 'http://super-restlvl2.dev/');
          console.log("ERROR"+error+xhr+thrown);
        }
      },
      columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {
          targets: -1,
          data: null,
          orderable: false,
          searchable: false,
          defaultContent: "<button class='editUser btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditUser'>editar</button> <button class='delUser btn btn-danger btn-sm'>Eliminar</button>"
        }],
      });

      $(document).on('submit','#FormUser',function(event){
        event.preventDefault();
        var clave = $("#password").val();
        var clave2 = $("#password2").val();
        if (clave==clave2) {
          var formData=new FormData($(this)[0]);
          console.log(formData);
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/user',
          {
            type: "POST",
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(resp){
              $("#modalCreateUser").modal('toggle');
              tableUser.ajax.reload();
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
        }else {
          $("#clave").append("las claves deben ser iguales");
        }
      });

      $(document).on('click','.editUser',function(){
        $(".window").css("visibility","visible");
        $(".window2").css("visibility","hidden");
        var data=tableUser.row($(this).parents('tr')).data();
        console.log(data.id);
        $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/user/'+data.id+'/edit',
        {
          beforeSend: function(xhr){
            xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
          },
          method: "GET",
          success: function(resp){
            $.each(resp, function(key, value){
              console.log(resp);
              $(".window").css("visibility","hidden");
              $(".window2").css("visibility","visible");

              $("#FormEditUser input[name=id]").val(resp.user.id);
              $("#FormEditUser input[name=name]").val(resp.user.name);
              $("#FormEditUser input[name=email]").val(resp.user.email);
              $("#FormEditUser select[name=role_id]").val(resp.user.role_id);
            });
          },
          error: function(req,statu,err){
          $(location).attr('href', 'http://test-client.dev/');
          }
        });
      });

      $(document).on('submit','#FormEditUser',function(event){
        event.preventDefault();
        var formData=new FormData($(this)[0]);
        console.log(formData.get("id"));
        $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/user/'+formData.get("id"),
        {
          type: "POST",
          headers: {"X-HTTP-Method-Override": "PUT"},
          dataType: "JSON",
          cache: false,
          contentType: false,
          processData: false,
          data:formData,
          success: function(resp){
            $("#modalEditUser").modal('toggle');
            tableUser.ajax.reload();
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

      $(document).on('click','.delUser',function(){
        var data=tableUser.row($(this).parents('tr')).data();
        console.log(data.id);
        swal({
          title: "Estas seguro?",
          text: "You will not be able to recover this imaginary file!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm)
                {
              $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/user/'+data.id,{
                beforeSend: function(xhr){
                  xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
                },
                method: 'DELETE',
                success:function(resp){
                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  tableUser.ajax.reload();
                },
                error:function(req,statu,err)
                {
                  console.log(statu);
                }
              });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
      });
    });
    </script> --}}
  @endsection
