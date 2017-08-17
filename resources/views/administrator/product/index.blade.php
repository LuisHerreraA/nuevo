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
            <li><a href="/administrator/mark">MARCA</a></li>
            <li class="active"><a href="/administrator/product">PRODUCTO</a></li>
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
    <h1>PRODUCTOS</h1>
    <br>
    <ol class="breadcrumb">
      <li><a href="/administrator/home">Home</a></li>
      <li class="active">Productos</li>
    </ol>
    <button class='btn btn-success btn-sm' id="createProduct" data-toggle='modal' data-target='#modalCreateProduct'>Crear</button> <button class='btn btn-warning btn-sm' id='pdfProduct'>Pdf</button>
    <table class="table" id="tableProduct">
      <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DESCRIPCIÓN</th>
        <th>MARCA</th>
        <th>CATEGORIA</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  @include('administrator.product.edit')
  @include('administrator.product.create')
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
  });

  $(document).ready(function(){
    console.log(localStorage.getItem('token'));
    var tableProduct= $('#tableProduct').DataTable({
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
          url: "https://super-restlvl2.ssmagallanes.cl/api/administrator/product/list",
          error: function (xhr, error, thrown) {
            console.log("ERROR"+error+xhr+thrown);
          }
        },
        columns: [
          {data: 'id', name: 'id'},
          {data:'name', name:'name'},
          {data:'description', name:'description'},
          {data:'mark.name', name:'mark.name'},
          {data:'category.type', name:'category.type'},
          {
            targets: -1,
            data: null,
            orderable: false,
            searchable: false,
            defaultContent: "<button class='editProduct btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditProduct'>editar</button> <button class='delProduct btn btn-danger btn-sm'>Eliminar</button>"
          }],
        });

        //COMIENZO DEL EDITAR DE PRODUCTOS LLENANDO CAMPOS
        $(document).on('click','.editProduct',function(){
          $(".loaderEditProduct").css("visibility","visible");
          $(".viewEditProduct").css("visibility","hidden");
          var data=tableProduct.row($(this).parents('tr')).data();
          console.log(data.id);
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product/'+data.id,
          {
            beforeSend: function(xhr){
              xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
            },
            method: "GET",
            success: function(resp){
              $.each(resp, function(key, value){
                console.log(resp);
                $(".loaderEditProduct").css("visibility","hidden");
                $(".viewEditProduct").css("visibility","visible");
                $("#FormEditProduct input[name=id]").val(resp.product.id);
                $("#FormEditProduct input[name=name]").val(resp.product.name);
                $("#FormEditProduct input[name=description]").val(resp.product.description);
                $("#FormEditProduct select[name=mark_id]").val(resp.product.mark_id);
                $("#FormEditProduct select[name=category_id]").val(resp.product.category_id);
              });
            },
            error: function(req,statu,err){
              //$(location).attr('href', 'http://test-client.dev/');
            }
          });
        });

        //LLENANDO SELECTS
        $(document).on('click','.editProduct',function(){

          $("#FormEditProduct select[name=mark_id]").empty();
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/mark',{
            beforeSend: function(xhr){
              xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
            },  method: 'GET',
            success: function(resp){
              console.log(resp);
              $.each( resp.marks, function( key, value ) {
                console.log(value.name);
                $("#FormEditProduct select[name=mark_id]").append("<option value="+value.id+">"+value.name+"</option>");
              });
            }
          });
        });

        $(document).on('click','.editProduct',function(){
          $("#FormEditProduct select[name=category_id]").empty();
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category',{
            beforeSend: function(xhr){
              xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
            },  method: 'GET',
            success: function(resp){
              console.log(resp);
              $.each( resp.categories, function( key, cat ) {
                console.log(cat.type);
                $("#FormEditProduct select[name=category_id]").append("<option value="+cat.id+">"+cat.type+"</option>");
              });
            }
          });
        });

        //ENVIANDO INFORMACIÓN A PUT
        // $(document).on('click','.update',function(){
        //   var id =$("#FormEdit input[name=id]").val();
        //   var name =$("#FormEdit input[name=name]").val();
        //   var description =$("#FormEdit input[name=description]").val();
        //   var mark_id =$("#FormEdit select[name=mark_id]").val();
        //   var category_id =$("#FormEdit select[name=category_id]").val();
        //   $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product/'+id,
        //   {
        //     beforeSend: function(xhr){
        //       xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
        //     },
        //     method: "PUT",
        //     data:{
        //       name:name,
        //       description:description,
        //       mark_id:mark_id,
        //       category_id:category_id
        //     },
        //     success: function(resp){
        //       //listar();
        //       console.log(resp);
        //       swal("Actualizado!", "Se actualizo el producto!", "success");
        //       tabla.ajax.reload();
        //     },
        //     error: function(req,statu,err){
        //    // $(location).attr('href', 'http://test-client.dev/');
        //     }
        //   });
        // });

        $(document).on('submit','#FormEditProduct',function(event){
          event.preventDefault();
          var formData=new FormData($(this)[0]);
          console.log(formData.get("id"));
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product/'+formData.get("id"),
          {
            type: "POST",
            headers: {"X-HTTP-Method-Override": "PUT"},
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(resp){
              $("#modalEditProduct").modal('toggle');
              tableProduct.ajax.reload();
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

        //CREANDO DATOS

        // $(document).on('click','.create',function(){
        //   var name = $("#FormCreate input[name=name]").val();
        //   var description = $("#FormCreate input[name=description]").val();
        //   var mark_id = $("#FormCreate select[name=mark_id]").val();
        //   var category_id = $("#FormCreate select[name=category_id]").val();
        //   $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product',{
        //     beforeSend: function(xhr){
        //       xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
        //     },
        //     method: "POST",
        //     data:{
        //       name:name,
        //       description:description,
        //       mark_id:mark_id,
        //       category_id:category_id
        //     },
        //     success: function(resp){
        //       console.log(resp);;
        //       swal("Creado!", "Se Creo el producto!", "success");
        //       tabla.ajax.reload();
        //     },
        //     error: function(req,statu,err){
        //     // $(location).attr('href', 'http://test-client.dev/');
        //     }
        //   });
        // });

        $(document).on('submit','#FormProduct',function(event){
          event.preventDefault();
          var formData=new FormData($(this)[0]);
          console.log(formData);
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product',
          {
            type: "POST",
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(resp){
              $("#modalCreateProduct").modal('toggle');
              tableProduct.ajax.reload();
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
                  $("#valid2").append(value);
                  console.log(value);
                });
              }
            }
          });
        });


        $(document).on('click','#createProduct',function(){
          $("#FormProduct input[name=name]").val('');
          $("#FormProduct input[name=description]").val('');
          $("#FormProduct select[name=mark_id]").empty();
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/mark',{
            beforeSend: function(xhr){
              xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
            },  method: 'GET',
            success: function(resp){
              console.log(resp);
              $.each( resp.marks, function( key, mark ) {
                console.log(mark.name);
                $("#FormProduct select[name=mark_id]").append("<option value="+mark.id+">"+mark.name+"</option>");
              });
            }
          });
        });

        $(document).on('click','#createProduct',function(){
          $("#FormProduct select[name=category_id]").empty();
          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category',{
            beforeSend: function(xhr){
              xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
            },  method: 'GET',
            success: function(resp){
              console.log(resp);
              $.each( resp.categories, function( key, cat ) {
                console.log(cat.type);
                $("#FormProduct select[name=category_id]").append("<option value="+cat.id+">"+cat.type+"</option>");
              });
            }
          });
        });


        $(document).on('click','.delProduct',function(){
          var data=tableProduct.row($(this).parents('tr')).data();
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
            if (isConfirm) {
              $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product/'+data.id,{
                beforeSend: function(xhr){
                  xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
                },
                method: 'DELETE',
                success:function(resp){
                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  tableProduct.ajax.reload();

                },
                error:function(req,statu,err){
                  //$(location).attr('href','http://test-client.dev/');
                }
              });
            } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
          });
        });
        $(document).on('click','#pdfProduct',function(){
          window.location.href='/report/product';
        });
      });

      </script> --}}
    @endsection
