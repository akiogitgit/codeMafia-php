<?php

namespace controller\topic\update;

use lib\Auth;
use lib\Msg;
use lib\sql_operation;
use model\TopicModel;

Auth::requireLogin();

// post から来て、session を受け取り、editが受け取る配列に直す (session 配列なら楽なのでは、、)
function get()
{
    $topic_c = TopicModel::getSessionFlush();
    $topic["id"] = $topic_c->id;
    $topic["title"] = $topic_c->title;
    $topic["published"] = $topic_c->published;
    \view\edit\index($topic);
}

function post()
{
    $t_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
    $t_title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $t_published = filter_input(INPUT_POST, "published", FILTER_SANITIZE_NUMBER_INT);

    $topic = new TopicModel;
    $topic->id = $t_id;
    $topic->title = $t_title;
    $topic->published = $t_published;

    $success = sql_operation::update($t_id, $t_title, $t_published);

    // 失敗　session に情報格納して、get に渡す
    if (!$success) {
        Msg::push(Msg::ERROR, "更新に失敗しました。");
        TopicModel::setSession($topic);
        redirect("topic/update");
    } else {
        Msg::push(Msg::INFO, "更新に成功しました。");
        redirect("topic/archive");
    }
    die();
}
