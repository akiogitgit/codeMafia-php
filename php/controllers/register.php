<?php

namespace controller\register;

use lib\Auth;
use lib\Msg;
use model\UserModel;

function get()
{
    require_once SOURCE_BASE . "views/register.php";
}

function post()
{
    // クラスのオブジェクト
    $User =  new UserModel;
    $User->id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING) ?? "";
    $User->pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING) ?? "";
    $User->nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_STRING) ?? "";
    // // 空のまま送った時の処理
    // $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING) ?? "";
    // $pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING) ?? "";
    // $nick = filter_input(INPUT_POST, "nick", FILTER_SANITIZE_STRING) ?? "";

    // $resultLogin = login($id, $pwd);
    if (Auth::register($User)) {
        Msg::push(Msg::INFO, "{$User->nickname}さん、ようこそ");
        redirect(GO_HOME);
    } else {
        Msg::push(Msg::INFO, "登録失敗");
        redirect(GO_REFERER);
    }
}