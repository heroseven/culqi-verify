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
          <h3>Respuesta</h3>
          {{$mensaje}}</br></br>

          <div class="alert alert-warning"><b>Mensaje usuario: </b> {{$respuesta}}</div>
          <div class="alert alert-info"><b>Mensaje culqi: </b>
            @if(isset($info))
              {{$info}}
            @endif
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
