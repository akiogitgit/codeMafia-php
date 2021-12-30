<?php

namespace view\detail;

function index($topic, $comments)
{
    \components\topic_header_item($topic, false);
    \components\topic_comment_list($comments);
    // 押したやつを、受け取って、
    // トピックのidを受け取って、SQL実行で

    // $topic = array_shift($topics);
    // $topic = Auth::fetchByTopic(1);
    // if (!$topic) {
    //     Msg::push(Msg::ERROR, "トピックが見つかりません");
    //     redirect("404");
    // }
    // if (count($topic) > 0) {
    //     $url = get_url("topic/detail?topic_id=" . $topic["id"]);
    //     $comments = Auth::fetchByAllComments($topic["id"]);
    //     \components\topic_header_item($topic, $url);
    //     \components\topic_comment_list($comments);
    // }
}
