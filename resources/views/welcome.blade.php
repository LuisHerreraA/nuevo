@extends('layouts.template')
@section('cabecera')

@endsection
@section('cuerpo')

  <br> <br> <br>
<center><h1>SUPER REST LVL 2</h1></center>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="login">Ingresar</button>
    </div>
  </div>


@endsection
@section('scripts')
 {{-- <script>
//  $(document).ready(function() {
  //   $("#login").click(function(){
  //     var email=$("#email").val();
  //     var password=$("#password").val();
  //     obtenerToken(email,password);
  //   });
  //
  //   function obtenerToken(email,password) {
  //     $.ajax({
  //       url: 'https://super-restlvl2.ssmagallanes.cl/api/auth',
  //       method: 'post',
  //       data: {
  //         email:email,
  //         password:password,
  //         grant_type:'password'
  //       },
  //       error: function (e) {
  //         console.log("ERROR:"+e);
  //       },
  //       success: function (response) {
  //         console.log(response.token);
  //         localStorage.setItem('token',response.token);
  //         var decoded = jwt_decode(localStorage.getItem('token'));
  //         console.log(decoded);
  //         console.log(localStorage.getItem('token'));
  //         if (decoded.datos.role_id==1) {
  //           $(location).attr('href', 'http://super-restlvl2.dev/administrator/home');
  //         }else if (decoded.datos.role_id==2) {
  //             $(location).attr('href', 'http://super-restlvl2.dev/administrative/home')
  //         }
  //       }
  //     });
  //   }

  // });



   </script> --}}
@endsection
