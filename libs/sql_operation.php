<?php

namespace lib;

use model\TopicModel;
use model\UserModel;
use Throwable;

// エラー表示あり
ini_set('display_errors', 1);

class sql_operation
{
    public static function delete($topic_id)
    {
        // ユーザーと、トピックのユーザーを確かめる
        $user = UserModel::getSession();
        $user_id = $user->id;
        $db = dbconnect();
    }
}
