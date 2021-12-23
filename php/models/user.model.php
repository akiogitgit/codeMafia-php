<?php

// ただのクラスやんけ
namespace model;

use lib\Msg;

class UserModel extends AbstractModel
{
    public string $id;
    public string $pwd;
    public string $nickname;
    public int $del_flg;

    protected static $SESSION_NAME = "_user";

    public static function validateID($val)
    {
        $res = true;
        if (empty($val)) {
            Msg::push(Msg::ERROR, "ユーザーIDを入力してください");
            $res = false;
        } else {
            if (strlen($val) > 10) {
                Msg::push(Msg::ERROR, "ユーザーIDは10桁以下で入力してください");
                $res = false;
            } // 半角英数字に当てはまらない
            if (!is_alnum($val)) {
                Msg::push(Msg::ERROR, "ニックネームは半角英数字で入力してください");
                $res = false;
            }
        }
        return $res;
    }

    public static function validatePassWord($val)
    {
        $res = true;
        if (empty($val)) {
            Msg::push(Msg::ERROR, 'パスワードを入力してください。');
            $res = false;
        } else {
            if (strlen($val) < 4) {
                Msg::push(Msg::ERROR, 'パスワードは４桁以上で入力してください。');
                $res = false;
            }
            if (!is_alnum($val)) {
                Msg::push(Msg::ERROR, 'パスワードは半角英数字で入力してください。');
                $res = false;
            }
        }
        return $res;
    }

    public static function validateNickName($val)
    {
        $res = true;
        if (empty($val)) {
            Msg::push(Msg::ERROR, "ニックネームを入力してください");
            $res = false;
        } else {
            if (strlen($val) > 10) {
                Msg::push(Msg::ERROR, "ニックネームは10桁以下で入力してください");
                $res = false;
            }
        }
        return $res;
    }
}