<?php

namespace view\home2;

use lib\Auth;

function index($topics)
{
    // 神関数。$topicに、最初の配列　$topicsに残りの配列格納。
    $topic = array_shift($topics);
    // $url_h = get_url("topic/detail?topic_id=" . $topic["id"]);
    \components\topic_header_item($topic, true);
    // \components\topic_list_item($topics);

    foreach ($topics as $topic) {
        $url = get_url("topic/detail?topic_id=" . $topic["id"]);
        // 配列を全表示
        \components\topic_list_item($topic, true);
    }
}
