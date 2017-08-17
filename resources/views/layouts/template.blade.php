
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>LVL2</title>
  <link href="/template/css/Bootstrap.min.css" rel="stylesheet">
  <link href="/sweetalert/dist/sweetalert.css" rel="stylesheet">
  <link href="/css/preloader.css" rel="stylesheet">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

</head>

<body>
      @yield('cabecera')
      <div class="container">
      @yield('cuerpo')


  </div>
  <script src="/template/js/jquery.min.js"></script>
  <script src="/template/js/Bootstrap.min.js"></script>
  <script src="/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <script src="/template/js/repository-login.js"></script>
  <script src="/template/js/jquery.base64.js"></script>
  <script src="/template/js/jwt-decode.min.js"></script>
  <script src="/template/js/mio.min.js"></script>
</body>
</html>
@yield('scripts')
