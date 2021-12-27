<?php

namespace view\detail;

function index($topics)
{
    // 押したやつを、受け取って、
    // トピックのidを受け取って、SQL実行で
    $topic = array_shift($topics);
    \components\topic_header_item($topic);
    \components\topic_comment_list($topic);
}
