<?php
// 初めに来た時、getに渡し、構文エラーでpost からget で view
namespace controller\topic\create;

use lib\Auth;
use lib\Msg;
use lib\sql_operation;
use model\TopicModel;

Auth::requireLogin();

function get()
{
    $topic = TopicModel::getSessionFlush();

    if (!$topic) { // 初回
        \view\create\index("", 1);
    } else { // 送信失敗した時(post から来た)
        $title = $topic->title;
        $published = $topic->published;
        \view\create\index($title, $published);
    }
}

// 送信ボタンを押した
function post()
{
    Auth::requireLogin();
    // 受け取ったのを、また渡す
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $published = filter_input(INPUT_POST, "published", FILTER_SANITIZE_NUMBER_INT);
    // session で get に渡す
    $topic = new TopicModel;
    $topic->title = $title;
    $topic->published = $published;
    // 入力チェック
    $success = sql_operation::create_topic($title, $published);

    if (!$success) {
        Msg::push(Msg::ERROR, "トピックの作成に失敗しました");
        // session に保存して、 上のgetに渡す
        TopicModel::setSession($topic);
        redirect(GO_REFERER);
    } else {
        Msg::push(Msg::INFO, "トピックの作成に成功しました");
        redirect("/");
    }
    die();
}
