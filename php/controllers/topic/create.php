<?php

namespace controller\topic\create;

use lib\Auth;
use lib\Msg;

function get()
{
    if (Auth::isLogin()) {
        require_once SOURCE_BASE . "views/topic/create.php";
        // require_once SOURCE_BASE . "views/create.php";
    } else {
        // Msg::push(Msg::ERROR, "ログインをしてください");
        require_once SOURCE_BASE . "views/login.php";
    }
}
