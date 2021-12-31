<?php

namespace controller\home;

use lib\Auth;
use lib\sql_operation;

function get()
{
    $res = sql_operation::fetchByAllPost();
    if ($res) {
        // namespace を読み込むときは、index.php で requireする
        \view\home2\index($res);
    }
}

// function post()
// {
//     $res = Auth::fetchByAllPost();
//     if ($res) {
//         // namespace を読み込むときは、index.php で requireする
//         \view\home2\index($res);
//     }
// }
