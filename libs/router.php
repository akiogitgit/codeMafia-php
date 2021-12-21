<?php

namespace lib;

use Throwable;

function route($rpath, $method)
{
    try {
        if ($rpath === "") {
            $rpath = "home";
        }
        $targetFile = SOURCE_BASE . "controllers/{$rpath}.php";
        if (!file_exists($targetFile)) {
            require_once SOURCE_BASE . "views/404.php";
            return;
        }
        require_once $targetFile;

        // 表示している namespace の関数を実行
        $fn = "\\controller\\{$rpath}\\{$method}";
        $fn();
    } catch (Throwable $e) {
        echo $e;
        Msg::push(Msg::DEBUG, $e->getMessage());
        Msg::push(Msg::ERROR, "何かがおかしい");
        require_once SOURCE_BASE . "views/404.php";
        // redirect("404");
    }
}
// Msg は同じ libの名前空間だから、useいらない