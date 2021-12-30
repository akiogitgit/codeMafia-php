<?php

namespace controller\home;

use lib\Auth;

function get()
{
    $res = Auth::fetchByAllPost();
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
