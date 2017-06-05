<?php
namespace App\Controllers;

use App\DB\Models\BlockedUser;
use App\DB\Models\User;
use Valitron\Validator;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\DB\Models\User as UserModel;
use App\DB\Models\Session as SessionModel;
use App\Library\AppController;
class Account extends AppController{

    public function block_profile_access(Request $request, Response $response) {
        $parsed_body = $request->getParsedBody();
        $validator = new Validator($parsed_body);
        $validator->rule('required', ['id', 'blocked_list']);
        $validator->rule('array', ['blocked_list']);
        if($validator->validate()) {
            $user_model = new User($this->ci->get('db'));
            $blocked_user_model = new BlockedUser($this->ci->get('db'));

            $user = $user_model->create($parsed_body);

            $blocked_user_model->delete_by_source([
                'user_id'       => $user['id'],
                'source_type'   => 1
            ]);

            foreach($parsed_body['blocked_list'] as $blocked_user_id) {
                $blocked_user_model->create([
                    'user_id'           => $user['id'],
                    'blocked_user_id'   =>  $blocked_user_id,
                    'source_type'       => 1
                ]);
            }
            return $response->withJson([
                'success'   => true,
                'message'   => 'Success'
            ]);
        } else {
            return $response->withJson([
                'success'   => false,
                'data'      => $validator->errors(),
                'message'   => 'Request is invalid'
            ]);
        }

    }

    public function block_story_access(Request $request, Response $response) {
        $parsed_body = $request->getParsedBody();
        $validator = new Validator($parsed_body);
        $validator->rule('required', ['id', 'blocked_story_list']);
        $validator->rule('array', ['blocked_story_list']);
        if($validator->validate()) {
            $user_model = new User($this->ci->get('db'));
            $blocked_user_model = new BlockedUser($this->ci->get('db'));

            $user = $user_model->create($parsed_body);

            $blocked_user_model->delete_by_source([
                'user_id'       => $user['id'],
                'source_type'   => 2
            ]);

            foreach($parsed_body['blocked_story_list'] as $blocked_user_id) {
                $blocked_user_model->create([
                    'user_id'           => $user['id'],
                    'blocked_user_id'   => $blocked_user_id,
                    'source_type'       => 2
                ]);
            }
            return $response->withJson([
                'success'   => true,
                'message'   => 'Success'
            ]);
        } else {
            return $response->withJson([
                'success'   => false,
                'data'      => $validator->errors(),
                'message'   => 'Request is invalid'
            ]);
        }
    }
}