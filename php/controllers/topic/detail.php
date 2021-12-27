<?php

namespace controller\topic\detail;

use lib\Auth;

function get()
{
    // コメントと追加したテーブルを取得
    $res = Auth::fetchByAllPost();
    if ($res) {
        // namespace を読み込むときは、index.php で requireする
        \view\detail\index($res);
    }
    // require_once SOURCE_BASE . "views/detail.php";
}
