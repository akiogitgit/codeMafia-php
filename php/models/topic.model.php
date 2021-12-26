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
}
