<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\Peticiones;
use Illuminate\Http\Request;

Requests::register_autoloader();


Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('datos');
});

Route::post('/logica', function (Request $request) {

  //timeout
  $options = array(
	'timeout' => 60,
);
  // $nombre_comercio=$request->input('nombre_comercio');
  $moneda=$request->input('moneda');
  $tarjeta=$request->input('tarjeta');
  $codigo_comercio=$request->input('codigo_comercio');
  $api_key=$request->input('api_key');
  //setear moneda
  if($moneda=='on'){
    $moneda='PEN';
  }else{
    $moneda='USD';
  }

  //setear las tarjetas por marca
  if($tarjeta=='on'){
    $tarjeta='4444333322221111';
    $cvv='123';
    $m_exp='10';
    $a_exp='2020';
  }else{
    $tarjeta='377897456465156';
    $cvv='1234';
    $m_exp='10';
    $a_exp='2020';
  }

  //datos generales
  $nombres="Culqi";
  $apellidos="Culqi";
  $correo="integrate@culqi.com";
  $codigo_comercio='Bearer '.$codigo_comercio;
  $api_key='Bearer '.$api_key;
    // crear token
  $url = 'https://pago.culqi.com/api/v1/tokens';
  $headers = array("Content-Type" => "application/json", "Accept" => "application/json",'Authorization' => $codigo_comercio);
  $data = json_encode(
    array(
    "correo_electronico"=> $correo,
    "nombre"=> $nombres,
    "apellido"=> $apellidos,
    "numero"=> $tarjeta,
    "cvv"=> $cvv,
    "m_exp"=> $m_exp,
    "a_exp"=> $a_exp,
    "guardar"=>true,
    "moneda"=> $moneda
    )
  );
  $response = Requests::post($url, $headers, $data, $options);

  if(isset(json_decode($response->body)->id)){
      $token=json_decode($response->body)->id;
  }else{
    echo '<b>Ocurrió una excepción, el token no se ha creado bien, puede que se este intentando realizar un token en dólares cuando solo se acepta soles, también podría ser que no puede crear token con una marca correcta, u otro problema.</b> </br></br>';
    return 'Respuesta de la creación del token: '.$response->body;
  }

  // $cargo= new Peticiones();
  // $cargo=$cargo->crearCargo($token,$moneda,$nombres,$apellidos, $correo);

  //crear cargo

  $url = 'https://pago.culqi.com/api/v1/cargos';
  $headers = array("Content-Type" => "application/json", "Accept" => "application/json",'Authorization' => $api_key);
  $data = json_encode(
    array(
    "token"=> $token,
    "moneda"=> $moneda,
    "monto"=> 100,
    "descripcion"=> 'Compra de prueba',
    "pedido"=> time(),
    "codigo_pais"=> "PE",
    "ciudad"=> "Lima",
    "usuario"=>"usuario_test",
    "direccion"=> "dirección_test",
    "telefono"=>"6464645646",
    "nombres"=>$nombres,
    "apellidos"=>$apellidos,
    "correo_electronico"=>"culqi@culqi.com"
    )
  );
  $cargo= Requests::post($url, $headers, $data, $options);
  if(is_object($cargo)){
      $info=(string)($cargo->body);
      $cargo= json_decode($cargo->body)->mensaje_usuario;
  }else{
    return 'Error 404 o 500 al realizar un cargo.';
  }



  if($cargo=='Su tarjeta es inválida. Contáctese con la entidad emisora de su tarjeta. ' ||$cargo== 'Operación denegada. Intente nuevamente ó utilice otra tarjeta. Si el problema persiste, contáctese con el Comercio.'){
    $respuesta=$cargo;
    $mensaje='La configuración del comercio es correcta.';
    return view('respuesta',compact('mensaje','respuesta','info'));
  }else{
    $respuesta=$cargo;

    $mensaje='La configuración es incorrecta, enviar el información a soporte tecnológico.';
    return view('respuesta',compact('mensaje','respuesta','info'));
  }




});
