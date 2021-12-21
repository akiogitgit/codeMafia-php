<?php

namespace db;

use db\DataSource;
use model\UserModel;

class UserQuery
{
    public static function fetchById($id)
    {
        $db = new DataSource;
        $sql = "select * from users where id = :id;";
        $result = $db->selectOne($sql, [
            ":id" => $id
        ], DataSource::CLS, UserModel::class);
        return $result;
    }

    public static function insert($id, $pwd, $nick)
    {
        $db = new DataSource;
        $sql = "insert into users(id,pwd,nickname) values (:id, :pwd,:nick)";

        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        return $db->execute($sql, [
            ":id" => $id,
            ":pwd" => $pwd,
            ":nick" => $nick
        ]);
    }
}