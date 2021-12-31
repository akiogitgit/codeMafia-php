<?php

namespace controller\topic\delete;

use lib\Auth;
use lib\Msg;

function get()
{
    redirect("/");
    die();
}
function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    // require_once SOURCE_BASE . "views/topic/edit.php";
    $topic = Auth::fetchByTopic($topic_id);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    } else {
        Msg::push(Msg::INFO, "トピックを削除するふりをしました");
        redirect("topic/archive");
        die();
    }
}
