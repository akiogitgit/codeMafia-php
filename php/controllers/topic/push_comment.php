<?php

namespace controller\topic\push_comment;

// update.php create.php と同じこと

use lib\Auth;
use lib\Msg;
use lib\sql_operation;
use model\UserModel;

Auth::requireLogin();

// post->get->home(detail) つまり、redirectは１度しか使えない(Msgがでなくなる)
function get()
{
    // session
    // is_success, url(home or detail), topic_id comment, agree
    if ($_SESSION["comment"]["is_success"]) {
        $url = $_SESSION["comment"]["url"];
        $topic_id = $_SESSION["comment"]["topic_id"];
        unset($_SESSION["comment"]);
        $_SESSION["comment"]["url"] = $url;
        $_SESSION["comment"]["topic_id"] = $topic_id;
    }
    // detail は、sessionで topic_idを受け取るから、表示できる
    redirect($_SESSION["comment"]["url"]);
    die();
}

function post()
{
    $topic_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
    $opinion = filter_input(INPUT_POST, "opinion", FILTER_SANITIZE_NUMBER_INT);
    $body = filter_input(INPUT_POST, "body", FILTER_SANITIZE_STRING);

    $url = filter_input(INPUT_POST, "url");
    if ($url === "/php/codeMafia/php-mysql/appWeb/") {
        $url = "/";
    } else {
        $url = "topic/detail";
    }
    // preg_match("/(.+(appWeb))/i", $url, $url1);
    // $url2 = $url1[0];

    $user = UserModel::getSession();
    $user_id = $user->id;
    $nickname = $user->nickname;

    $success = sql_operation::push_comment($topic_id, $opinion, $body, $user_id, $nickname);
    if (!$success) {
        Msg::push(Msg::ERROR, "コメントの追加に失敗しました。");
    } else {
        Msg::push(Msg::INFO, "コメントの追加に成功しました。");
    }

    // is_success, url(home or detail), topic_id comment, agree
    // session に格納し、getに渡す
    $_SESSION["comment"]["is_success"] = $success;
    $_SESSION["comment"]["url"] = $url;
    $_SESSION["comment"]["topic_id"] = $topic_id;
    $_SESSION["comment"]["body"] = $body;
    $_SESSION["comment"]["opinion"] = $opinion;

    // redirect("topic/push_comment");
    \controller\topic\push_comment\get();
    // redirect("/");
    die();
}
