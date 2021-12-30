<?php

namespace controller\topic\edit;

use lib\Auth;
use lib\Msg;

function get()
{
    require_once SOURCE_BASE . "views/topic/edit.php";
    // require_once SOURCE_BASE . "views/detail.php";
}
function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    // require_once SOURCE_BASE . "views/topic/edit.php";
    $topic = Auth::fetchByTopic($topic_id);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    }
    if (count($topic) > 0) {
        \view\edit\index($topic);
    }
}
