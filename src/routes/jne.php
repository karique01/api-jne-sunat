<?php
/**
 * Created by PhpStorm.
 * User: tavosud
 * Date: 25/11/2018
 * Time: 10:39
 */

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/jne/{dni}', function (Request $request, Response $response, array $args){

        $url = 'http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI=';
        $dni = $args['dni'];

        if(strlen($dni)==8){
            $consulta = file_get_contents($url.$dni);

            $partes = explode("|", $consulta);

            if(isset($partes[3])){
                $datos = array(
                    'msg' => 'No se encontro datos'
                );
            }else {
                $datos = array(
                    'ape_pat' => $partes[0],
                    'ape_mat' => $partes[1],
                    'nombres' => $partes[2]
                );
            }
            echo json_encode($datos);
        }else{
            print '{ "msg" : "Numero de DNI no valido" }';
        }

    });