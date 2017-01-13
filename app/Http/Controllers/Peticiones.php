<?php

namespace App\Http\Controllers;
// require_once "C:/laragon/www/laravel/vendor/rmccue/requests/library/Requests.php";
// Requests::register_autoloader();


class Peticiones extends Controller
{

    public function crearCargo($token,$moneda,$nombres,$apellidos, $correo){
      $url = 'https://integ-pago.culqi.com/api/v1/cargos';
      $headers = array("Content-Type" => "application/json", "Accept" => "application/json",'Authorization' => 'Bearer ASa3QY0uw8LZ9eo9MM7zYzQRsZgQil7LR6UhI4/TdP8=' );
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
      $response = Requests::post($url, $headers, $data);

      return json_decode($response->body)->id;
    }
}
