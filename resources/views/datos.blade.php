<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



    <style media="screen">
      .container{
        margin-top:100px;
      }
    </style>

  </head>
  <body>

    <div class="container">

      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Verificar comercios</h3>
          <form class="" action="/logica" method="post">
            <!-- <div class="form-group">
              <label for="codigo">Código de comercio</label>
              <input type="text" name="nombre_comercio" class="form-control" placeholder="Código de comercio">
            </div> -->
            <div class="form-group">
              <label for="codigo">Código de comercio</label>
              <input type="text" name="codigo_comercio" class="form-control" placeholder="Código de comercio">
            </div>
            <div class="form-group">
              <label for="apikey">Api Key</label>

              <input type="text" name="api_key" class="form-control" placeholder="Api Key">
            </div>
           Moneda  <input type="checkbox" name="moneda" data-on="Soles" data-off="Dólares"  checked data-toggle="toggle">
          Tarjeta   <input type="checkbox" name="tarjeta" data-on="Visa" data-off="PMC"  checked data-toggle="toggle">
            <input type="submit" class="btn btn-success" value="Enviar">
            {{csrf_field()}}
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
