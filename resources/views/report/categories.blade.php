<HTML>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Reporte</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

  <div class="container">
    <br><br><br><br>
    <h1>REPORTE DE CATEGORIAS</h1>

    <br>
    <table class="table">
      <thead>
        <th>ID</th>
        <th>TIPO</th>
      </thead>
      <tbody>
        <tr></tr>
        @foreach ($datas->categories as $data)
              <tr>
                  <td>{{$data->id}}</td>
                  <td>{{$data->type}}</td>
              </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</HTML>
