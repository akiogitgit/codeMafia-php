<?php

namespace controller\topic\detail;

use lib\Auth;
use lib\Msg;

function get()
{
    // 押したやつを、受け取って、
    // トピックのidを受け取って、SQL実行で

    // $topic = array_shift($topics);
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

    // コメントと追加したテーブルを取得
    // $topic = Auth::fetchByAllPost();
    // if ($topic) {
    //     // namespace を読み込むときは、index.php で requireする
    //     \view\detail\index($topic);
    // }
    // require_once SOURCE_BASE . "views/detail.php";
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
        $url = get_url("topic/detail?topic_id=" . $topic["id"]);
        $comments = Auth::fetchByAllComments($topic["id"]);
        \view\detail\index($topic, $url, $comments);
    }
}
