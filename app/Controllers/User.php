<?php
/**
 * Created by PhpStorm.
 * User: songxun
 * Date: 12/11/2016
 * Time: 11:08 PM
 */
namespace App\Controllers;
use App\Library\AppController;
use Valitron\Validator;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\DB\Models\BlockedUser as BlockedUserModel;

class User extends AppController{

    public function blocking_user(Request $request, Response $response, $args) {
        $blocked_user_model = new BlockedUserModel($this->ci->get('db'));

        $result = $blocked_user_model->list_by_blocked_user([
            'blocked_user_id' => $args['id'],
            'source_type' => 1
        ]);
        return $response->withJson([
            'success'   => true,
            'data'      => $result
        ]);
    }

    public function blocking_story_user(Request $request, Response $response, $args) {
        $blocked_user_model = new BlockedUserModel($this->ci->get('db'));

        $result = $blocked_user_model->list_by_blocked_user([
            'blocked_user_id' => $args['id'],
            'source_type' => 2
        ]);
        return $response->withJson([
            'success'   => true,
            'data'      => $result
        ]);
    }
}