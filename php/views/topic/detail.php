<?php

namespace view\detail;

function index($topic, $comments)
{
    \components\topic_header_item($topic, false);
    \components\topic_comment_list($comments);
}
