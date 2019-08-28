<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/sunat/{ruc}', function (Request $request, Response $response, array $args){

        $ruc = $args['ruc'];
        if((ctype_digit($ruc) and strlen($ruc) == 8) or (ctype_digit($ruc) and strlen($ruc) == 11)){
            $empresa = new \Sunat\Sunat( true, true );
            $resultado = $empresa->search( $ruc );
            $data = $resultado->json();
            $response->getBody()->write($data);
        }else{
            $response->getBody()->write('{ "msg" : "Numero no valido" }');
        }

        return $response;

    });