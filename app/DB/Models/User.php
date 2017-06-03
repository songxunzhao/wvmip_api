<?php
/**
 * Created by PhpStorm.
 * User: songxun
 * Date: 12/12/2016
 * Time: 10:23 PM
 */
namespace App\DB\Models;

use \PDO;
use App\Library\DBModel;

class User extends DBModel{
    private function param_array_create() {
        return [
            'id',
            'username',
            'fullname',
            'profile_picture'
        ];
    }

    public function create($data) {
        $query_params = $this->param_array_create();
        $query = "CALL fx_users_create(?, ?, ?, ?)";
        return $this->fetch_one($query, $query_params, $data);
    }
}