<?php

namespace view\home2;

use lib\Auth;

function index($topics)
{
    // 神関数。$topicに、最初の配列　$topicsに残りの配列格納。
    $topic = array_shift($topics);
    \components\topic_header_item($topic);
    \components\topic_list_item($topics);
}
