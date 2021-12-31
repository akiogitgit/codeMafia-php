<?php

namespace controller\topic\detail;

use lib\Auth;
use lib\Msg;
use lib\sql_operation;

// 飾り
function get()
{
    // 押したやつを、受け取って、
    // トピックのidを受け取って、SQL実行
    $topic = sql_operation::fetchByTopic(3);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    }
    if (count($topic) > 0) {
        $url = get_url("topic/detail?topic_id=" . $topic["id"]);
        $comments = sql_operation::fetchByAllComments($topic["id"]);
        \view\detail\index($topic, $url, $comments);
    }
}

function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $topic = sql_operation::fetchByTopic($topic_id);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    }
    if (count($topic) > 0) {
        // viewsを増やす
        sql_operation::incrementViewCount($topic["id"]);
        $comments = sql_operation::fetchByAllComments($topic["id"]);
        \view\detail\index($topic, $comments);
    }
}
