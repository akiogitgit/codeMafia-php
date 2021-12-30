<?php

namespace controller\topic\push_comment;

use lib\Auth;
use lib\Msg;
use model\UserModel;

Auth::requireLogin();

function get()
{
    redirect("/");
}

function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
    $opinion = filter_input(INPUT_POST, "opinion", FILTER_SANITIZE_NUMBER_INT);
    $body = filter_input(INPUT_POST, "body", FILTER_SANITIZE_STRING);
    $user = UserModel::getSession();
    $user_id = $user->id;
    $nickname = $user->nickname;

    $success = Auth::push_comment($topic_id, $opinion, $body, $user_id, $nickname);
    if (!$success) {
        Msg::push(Msg::ERROR, "コメントの追加に失敗しました。");
    } else {
        Msg::push(Msg::INFO, "コメントの追加に成功しました。");
    }
    redirect("/");
    die();
}
