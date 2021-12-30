<?php

namespace controller\topic\create;

use lib\Auth;
use lib\Msg;

Auth::requireLogin();

function get()
{
    \view\create\index();
}

// 送信ボタンが押された
function post()
{
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $published = filter_input(INPUT_POST, "published", FILTER_SANITIZE_NUMBER_INT);

    $success = Auth::create_topic($title, $published);
    if (!$success) {
        Msg::push(Msg::ERROR, "トピックの作成に失敗しました");
    } else {
        Msg::push(Msg::INFO, "トピックの作成に成功しました");
    }
    redirect("/");
    die();
}
