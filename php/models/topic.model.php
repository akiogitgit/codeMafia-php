<?php

// ただのクラスやんけ
namespace model;

use lib\Msg;

class TopicModel extends AbstractModel
{
    public int $id;
    public string $title;
    public int $published;
    public int $views;
    public int $likes;
    public int $dislikes;
    public string $user_id;
    public int $del_flg;

    protected static $SESSION_NAME = "_topic";

    public static function validateTitle($val)
    {
        $res = true;
        if (empty($val)) {
            Msg::push(Msg::ERROR, "タイトルを入力してください");
            $res = false;
        } else {
            if (strlen($val) > 30) {
                Msg::push(Msg::ERROR, "タイトルは30桁以下で入力してください");
                $res = false;
            }
        }
        return $res;
    }

    public static function validateComment($val)
    {
        $res = true;
        if (empty($val)) {
            Msg::push(Msg::ERROR, "コメントを入力してください");
            $res = false;
        } else {
            if (strlen($val) > 30) {
                Msg::push(Msg::ERROR, "コメントは1000桁以下で入力してください");
                $res = false;
            }
        }
        return $res;
    }
}
