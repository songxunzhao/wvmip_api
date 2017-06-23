<?php
/**
 * Created by PhpStorm.
 * User: songxun
 * Date: 6/24/2017
 * Time: 1:03 AM
 */

use Valitron\Validator;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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