<?php

namespace controller\login;

use lib\Auth;

function get()
{
    require_once SOURCE_BASE . "views/login.php";
}


function post()
{
    // 空のまま送った時の処理
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING) ?? "";
    $pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING) ?? "";

    // $resultLogin = login($id, $pwd);
    if (Auth::login($id, $pwd)) {
        echo "<br><br>認証成功";
        // helper.php appWeb/の後を渡す
        redirect("");
        die();
    } else {
        echo "<br><br>認証失敗";
        redirect("login");
        die();
    }
}