// //para minificar
//

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
    $(".loaderAdminstrator").css("visibility","hidden");
    $(".viewAdministrator").css("visibility","visible");
    // var decoded = jwt_decode(localStorage.getItem('token'));
    $(".ventana2").css("visibility","hidden");
    $(".ventana").css("visibility","visible");
    // $("#bienv").append(''+decoded.datos.name);
  }
  console.log(request.status)
});
$(document).ajaxError(function(event,request,setting){
  if(request.status==0){
    console.log("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
  }else if (request.status == 404) {
    console.log("Pagina no encontrada [404]");
  }else if (request.status == 500) {
    console.log("Error interno en el servidor [500]");
    $(location).attr('href', 'http://super-restlvl2.dev/');
  }else if (request.status == 400) {
    console.log("Token no Disponible [400]");
    $(location).attr('href', 'http://super-restlvl2.dev/');
  }else if(request.status==501) {
    console.log("no hay acceso 501");
    $(location).attr('href','http://super-restlvl2.dev/501');
  }
  console.log(request.status)
});



$(document).ready(function() {
  $("#login").click(function(){
    var email=$("#email").val();
    var password=$("#password").val();
    obtenerToken(email,password);
  });

  function obtenerToken(email,password) {
    $.ajax({
      url: 'https://super-restlvl2.ssmagallanes.cl/api/auth',
      method: 'post',
      data: {
        email:email,
        password:password,
        grant_type:'password'
      },
      error: function (e) {
        ("ERROR:"+e);
      },
      success: function (response) {

        localStorage.setItem('token',response.token);
        var decoded = jwt_decode(localStorage.getItem('token'));
        localStorage.setItem('user', decoded.datos.name);
        localStorage.setItem('rol', decoded.datos.role_id);
        (localStorage.getItem('token'));
        if (decoded.datos.role_id==1) {
          $(location).attr('href', 'http://super-restlvl2.dev/administrator/home');
        }else if (decoded.datos.role_id==2) {
          $(location).attr('href', 'http://super-restlvl2.dev/administrative/home')
        }
      }
    });
  }
});

// console.log(localStorage.getItem('token'));
// if (localStorage.getItem('token')===null) {
//   $(location).attr('href','http://super-restlvl2.dev/');
// }




//   $(document).ajaxSuccess(function(event, request, setting){
//     if(request.status==200)
//     {
//       $(".loader").css("visibility","hidden");
//       $(".administrativeWindow").css("visibility","visible");
//       $(".loaderAdminstrator").css("visibility","hidden");
//       $(".viewAdministrator").css("visibility","visible");
//       var decoded = jwt_decode(localStorage.getItem('token'));
//       $(".ventana2").css("visibility","hidden");
//       $(".ventana").css("visibility","visible");
//       $("#bienv").append(''+decoded.datos.name);
//     }
//
//   });
//   $(document).ajaxError(function(event,request,setting){
//     if (request.status==501) {
//       $(location).attr('href','http://super-restlvl2.dev/501');
//     }
//   });
// });
// //separadr
// //aqui comienza todo lo de administrativo
$(document).ready(function(){
  console.log(localStorage.getItem('user'));
  $("#user").append(localStorage.getItem('user'));
  var tablaCategoryAdm= $('#tablaCategoryAdm').DataTable({
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
        url: "https://super-restlvl2.ssmagallanes.cl/api/administrative/category/list",
        error: function (xhr, error, thrown) {
          ("ERROR"+error+xhr+thrown);
        }
      },
      columns: [
        {data: 'id', name: 'id'},
        {data:'type', name:'type'}
      ],
    });

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

      var tableProductAdmi= $('#tableProductAdmi').DataTable({
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
            url: "https://super-restlvl2.ssmagallanes.cl/api/administrative/product/list",
            error: function (xhr, error, thrown) {
              ("ERROR"+error+xhr+thrown);
            }
          },
          columns: [
            {data: 'id', name: 'id'},
            {data:'name', name:'name'},
            {data:'description', name:'description'},
            {data:'mark.name', name:'mark.name'},
            {data:'category.type', name:'category.type'}
          ],
        });
        //aqui termina administrativo
        //aqui comienza administrator category
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
                ("ERROR"+error+xhr+thrown);
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
              (formData);
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
                    ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                  }else if (jqXHR.status == 404) {
                    ("Pagina no encontrada [404]");
                  }else if (jqXHR.status == 500) {
                    ("Error interno en el servidor [500]");
                  }else if (jqXHR.status == 400) {
                    ("Token no Disponible [400]");
                    $(location).attr('href', 'http://super-restlvl2.dev/');
                  }else if (jqXHR.status == 422) {
                    ("Error de validacion de campo [422]");
                    var errores= jqXHR.responseJSON;
                    $.each(errores, function(key, value){
                      $("#validCategory").prepend(value);
                    });
                  }
                }
              });
            });

            $(document).on('click','.editCategory',function(){
              $(".window").css("visibility","visible");
              $(".window2").css("visibility","hidden");
              var data=tablaCategory.row($(this).parents('tr')).data();
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
              (formData.get("id"));
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
                },
                error: function(jqXHR, textStatus, errorThrow){
                  if(jqXHR.status==0){
                    ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                  }else if (jqXHR.status == 404) {
                    ("Pagina no encontrada [404]");
                  }else if (jqXHR.status == 500) {
                    ("Error interno en el servidor [500]");
                  }else if (jqXHR.status == 400) {
                    ("Token no Disponible [400]");
                    $(location).attr('href', 'http://super-restlvl2.dev/');
                  }else if (jqXHR.status == 422) {
                    ("Error de validacion de campo [422]");
                    var errores= jqXHR.responseJSON;
                    $.each(errores, function(key, value){
                      $("#validCategory").prepend(value);
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
            // //administrator mark
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
                    ("ERROR"+error+xhr+thrown);
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
                        ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                      }else if (jqXHR.status == 404) {
                        ("Pagina no encontrada [404]");
                      }else if (jqXHR.status == 500) {
                        ("Error interno en el servidor [500]");
                      }else if (jqXHR.status == 400) {
                        ("Token no Disponible [400]");
                        $(location).attr('href', 'http://super-restlvl2.dev/');
                      }else if (jqXHR.status == 422) {
                        ("Error de validacion de campo [422]");
                        var errores= jqXHR.responseJSON;
                        $.each(errores, function(key, value){
                          $("#validMark").append(value);
                        });
                      }
                    }
                  });
                });

                $(document).on('click','.editMark',function(){
                  $(".loaderModalMark").css("visibility","visible");
                  $(".viewModalMark").css("visibility","hidden");
                  var data=tablaMark.row($(this).parents('tr')).data();
                  (data.id);
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
                  (formData.get("id"));
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
                    },
                    error: function(jqXHR, textStatus, errorThrow){
                      if(jqXHR.status==0){
                        ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                      }else if (jqXHR.status == 404) {
                        ("Pagina no encontrada [404]");
                      }else if (jqXHR.status == 500) {
                        ("Error interno en el servidor [500]");
                      }else if (jqXHR.status == 400) {
                        ("Token no Disponible [400]");
                        $(location).attr('href', 'http://super-restlvl2.dev/');
                      }else if (jqXHR.status == 422) {
                        ("Error de validacion de campo [422]");
                        var errores= jqXHR.responseJSON;
                        $.each(errores, function(key, value){
                          $("#valid").append(value);
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

                // //administrator product
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
                        ("ERROR"+error+xhr+thrown);
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
                      $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/product/'+data.id,
                      {
                        beforeSend: function(xhr){
                          xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
                        },
                        method: "GET",
                        success: function(resp){
                          $.each(resp, function(key, value){
                            (resp);
                            $("#FormEditProduct input[name=id]").val(resp.product.id);
                            $("#FormEditProduct input[name=name]").val(resp.product.name);
                            $("#FormEditProduct input[name=description]").val(resp.product.description);
                            $("#FormEditProduct select[name=mark_id]").val(resp.product.mark_id);
                            $("#FormEditProduct select[name=category_id]").val(resp.product.category_id);
                            $(".loaderEditProduct").css("visibility","hidden");
                            $(".viewEditProduct").css("visibility","visible");
                          });
                        },
                        error: function(req,statu,err){
                          $(location).attr('href', 'http://test-client.dev/');
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
                          $.each( resp.marks, function( key, value ) {
                            (value.name);
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
                          $.each( resp.categories, function( key, cat ) {
                            (cat.type);
                            $("#FormEditProduct select[name=category_id]").append("<option value="+cat.id+">"+cat.type+"</option>");
                          });
                        }
                      });
                    });

                    $(document).on('submit','#FormEditProduct',function(event){
                      event.preventDefault();
                      var formData=new FormData($(this)[0]);
                      (formData.get("id"));
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
                        },
                        error: function(jqXHR, textStatus, errorThrow){
                          if(jqXHR.status==0){
                            ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                          }else if (jqXHR.status == 404) {
                            ("Pagina no encontrada [404]");
                          }else if (jqXHR.status == 500) {
                            ("Error interno en el servidor [500]");
                          }else if (jqXHR.status == 400) {
                            ("Token no Disponible [400]");
                            $(location).attr('href', 'http://super-restlvl2.dev/');
                          }else if (jqXHR.status == 422) {
                            ("Error de validacion de campo [422]");
                            var errores= jqXHR.responseJSON;
                            $.each(errores, function(key, value){
                              $("#valid").append(value);
                            });
                          }
                        }
                      });
                    });

                    $(document).on('submit','#FormProduct',function(event){
                      event.preventDefault();
                      var formData=new FormData($(this)[0]);
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
                            ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                          }else if (jqXHR.status == 404) {
                            ("Pagina no encontrada [404]");
                          }else if (jqXHR.status == 500) {
                            ("Error interno en el servidor [500]");
                          }else if (jqXHR.status == 400) {
                            ("Token no Disponible [400]");
                            $(location).attr('href', 'http://super-restlvl2.dev/');
                          }else if (jqXHR.status == 422) {
                            ("Error de validacion de campo [422]");
                            var errores= jqXHR.responseJSON;
                            $.each(errores, function(key, value){
                              $("#valid2").prepend('<li>'+value+'</li>');
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
                          $.each( resp.marks, function( key, mark ) {
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
                          $.each( resp.categories, function( key, cat ) {
                            $("#FormProduct select[name=category_id]").append("<option value="+cat.id+">"+cat.type+"</option>");
                          });
                        }
                      });
                    });


                    $(document).on('click','.delProduct',function(){
                      var data=tableProduct.row($(this).parents('tr')).data();
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

                    // //administrator user
                    //

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
                            ("ERROR"+error+xhr+thrown);
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
                                  ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                                }else if (jqXHR.status == 404) {
                                  ("Pagina no encontrada [404]");
                                }else if (jqXHR.status == 500) {
                                  ("Error interno en el servidor [500]");
                                }else if (jqXHR.status == 400) {
                                  ("Token no Disponible [400]");
                                  $(location).attr('href', 'http://super-restlvl2.dev/');
                                }else if (jqXHR.status == 422) {
                                  ("Error de validacion de campo [422]");
                                  var errores= jqXHR.responseJSON;
                                  $.each(errores, function(key, value){
                                    $("#valid").append(value);
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
                          (data.id);
                          $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/user/'+data.id+'/edit',
                          {
                            beforeSend: function(xhr){
                              xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
                            },
                            method: "GET",
                            success: function(resp){
                              $.each(resp, function(key, value){
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
                          (formData.get("id"));
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
                            },
                            error: function(jqXHR, textStatus, errorThrow){
                              if(jqXHR.status==0){
                                ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                              }else if (jqXHR.status == 404) {
                                ("Pagina no encontrada [404]");
                              }else if (jqXHR.status == 500) {
                                ("Error interno en el servidor [500]");
                              }else if (jqXHR.status == 400) {
                                ("Token no Disponible [400]");
                                $(location).attr('href', 'http://super-restlvl2.dev/');
                              }else if (jqXHR.status == 422) {
                                ("Error de validacion de campo [422]");
                                var errores= jqXHR.responseJSON;
                                $.each(errores, function(key, value){
                                  $("#valid").append(value);
                                });
                              }
                            }
                          });
                        });

                        $(document).on('click','.delUser',function(){
                          var data=tableUser.row($(this).parents('tr')).data();
                          (data.id);
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
                                  if(req.status==0){
                                    ("No Conectado: verificar su Red / Access-Control-Request-Methods or Access-Denied [0]");
                                  }else if (req.status == 404) {
                                    ("Pagina no encontrada [404]");
                                  }else if (req.status == 500) {
                                    ("Error interno en el servidor [500]");
                                  }else if (req.status == 400) {
                                    ("Token no Disponible [400]");
                                    $(location).attr('href', 'http://super-restlvl2.dev/');
                                  }
                                }
                              });
                            } else {
                              swal("Cancelled", "Your imaginary file is safe :)", "error");
                            }
                          });
                        });

                        var pathname = window.location.pathname;
                        console.log(pathname);
                        if (pathname === '/administrative/home') {
                          if (localStorage.getItem('rol')==2) {
                            $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrative/category/list',{
                              beforeSend: function(xhr){
                                xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
                              }, method: 'GET',
                            });
                          }else {
                            $(location).attr('href','http://super-restlvl2.dev/');
                          }
                        }else if (pathname==='/administrator/home') {
                          if (localStorage.getItem('rol')==1) {
                            $.ajax('https://super-restlvl2.ssmagallanes.cl/api/administrator/category/list',{
                              beforeSend: function(xhr){
                                xhr.setRequestHeader("Authorization","Bearer "+localStorage.getItem('token'));
                              }, method: 'GET',
                            });
                          }else {
                            $(location).attr('href','http://super-restlvl2.dev/');
                          }
                        }



                        // var decoded = jwt_decode(localStorage.getItem('token'));
                        // var pathname = window.location.pathname;
                        // console.log(pathname);
                        // if (localStorage.getItem('rol')==2 && pathname.indexOf('administrative') >= 0) {
                        //   //   $(".ventana2").css("visibility","hidden");
                        //   //   $(".ventana").css("visibility","visible");
                        //   //   $("#bienv").append(''+localStorage.getItem('user'));
                        // }else if (localStorage.getItem('rol')==1 && pathname.indexOf('administrator') >= 0) {
                        //   $(".ventana2").css("visibility","hidden");
                        //   $(".ventana").css("visibility","visible");
                          //   $("#bienv").append(''+localStorage.getItem('user'));
                          //  }else {
                          //    $(location).attr('href','http://super-restlvl2.dev/');
                          //  }
                        });

                        $(document).ready(function(){
                          $("#exit").click(function(){
                            localStorage.clear();
                            $(location).attr('href', 'http://super-restlvl2.dev');
                          });
                        });
