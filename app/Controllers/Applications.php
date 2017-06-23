<?php
namespace App\Controllers;

use Valitron\Validator;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Library\AppController;

class Applications extends AppController{

    public function get_mode(Request $request, Response $response) {
        $parsed_body = $request->getParsedBody();
        $validator = new Validator($parsed_body);
        $validator->rule('required', ['name']);

        $result = [];
        switch($parsed_body['name']) {
            case "wvmip":
                $result = [
                    'success'   => true,
                    'data'      => [
                        'mode'  => 'dev'
                    ]
                ];
                break;
        }
        return $response->withJson($result);
    }
}