<?php

namespace controller\topic\delete;

use lib\Auth;
use lib\Msg;
use lib\sql_operation;

function get()
{
    redirect("/");
    die();
}
function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    // require_once SOURCE_BASE . "views/topic/edit.php";
    $topic = sql_operation::fetchByTopic($topic_id);
    if (!$topic) {
        Msg::push(Msg::ERROR, "トピックが見つかりません");
        redirect("404");
    } else {
        $success = sql_operation::delete($topic["id"]);
        if ($success) {
            Msg::push(Msg::INFO, "トピックを削除しました");
        } else {
            Msg::push(Msg::ERROR, "トピックを削除失敗");
        }
        redirect("topic/archive");
        die();
    }
}
