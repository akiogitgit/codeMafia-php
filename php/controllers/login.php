<?php

namespace controller\login;

use lib\Auth;
use lib\Msg;

function get()
{
    require_once SOURCE_BASE . "views/login.php";
}


function post()
{
    // 空のまま送った時の処理
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING) ?? "";
    $pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING) ?? "";

    Msg::push(Msg::DEBUG, "メッセージ");

    // $resultLogin = login($id, $pwd);
    if (Auth::login($id, $pwd)) {
        // session のMsgに格納 Msg::flush()で表示
        Msg::push(Msg::INFO, "認証成功！");

        // helper.php appWeb/の後を渡す GO_HOMEはconfig.php
        redirect(GO_HOME);
        die();
    } else {
        Msg::push(Msg::ERROR, "認証失敗！");
        // １つ前に戻る
        redirect(GO_REFERER);
        die();
    }
}