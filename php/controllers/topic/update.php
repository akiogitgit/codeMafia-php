<?php

namespace controller\topic\update;

use lib\Auth;
use lib\Msg;
use lib\sql_operation;

Auth::requireLogin();

function get()
{
    require_once SOURCE_BASE . "views/topic/create.php";
    redirect("/");
}

function post()
{
    $t_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
    $t_title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $t_published = filter_input(INPUT_POST, "published", FILTER_SANITIZE_NUMBER_INT);

    $success = sql_operation::update($t_id, $t_title, $t_published);
    if (!$success) {
        Msg::push(Msg::ERROR, "更新に失敗しました。");
        redirect("topic/archive");
        // redirect(GO_REFERER);
    } else {
        Msg::push(Msg::INFO, "更新に成功しました。");
        redirect("topic/archive");
    }
    die();
}
