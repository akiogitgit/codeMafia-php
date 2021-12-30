<?php

namespace controller\topic\detail;

use lib\Auth;
use lib\Msg;

// 飾り
function get()
{
    // 押したやつを、受け取って、
    // トピックのidを受け取って、SQL実行
    $topic = Auth::fetchByTopic(3);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    }
    if (count($topic) > 0) {
        $url = get_url("topic/detail?topic_id=" . $topic["id"]);
        $comments = Auth::fetchByAllComments($topic["id"]);
        \view\detail\index($topic, $url, $comments);
    }
}

function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $topic = Auth::fetchByTopic($topic_id);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    }
    if (count($topic) > 0) {
        // viewsを増やす
        Auth::incrementViewCount($topic["id"]);
        $comments = Auth::fetchByAllComments($topic["id"]);
        \view\detail\index($topic, $comments);
    }
}
