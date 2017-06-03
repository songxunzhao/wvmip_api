<?php
/**
 * Created by PhpStorm.
 * User: songxun
 * Date: 6/3/2017
 * Time: 5:10 PM
 */

namespace App\DB\Models;

use \PDO;
use App\Library\DBModel;

class BlockedUser extends DBModel{
    public function create($data) {
        $query_params = [
            'user_id',
            'blocked_user_id',
            'source_type'
        ];

        $query = "CALL fx_blocked_users_create(?, ?, ?)";
        return $this->fetch_one($query, $query_params, $data);
    }

    public function delete_by_source($data) {
        $query_params = [
            'user_id',
            'source_type'
        ];

        $query = "CALL fx_blocked_users_delete_by_source(?,?)";
        return $this->execute_query($query, $query_params, $data);
    }

    public function list_by_blocked_user($data) {
        $query_params = [
            'blocked_user_id',
            'source_type'
        ];

        $query = "CALL fx_blocked_users_list_by_blocked_user(?, ?)";
        return $this->fetch_all($query, $query_params, $data);
    }
}