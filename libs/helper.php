<?php
function get_param($key, $default_val, $is_post = true)
{
    $arry = $is_post ? $_POST : $_GET;
    return $arry[$key] ?? $default_val;
}

function redirect($path)
{
    if ($path === GO_HOME) {
        $path = get_url("");
    } else if ($path === GO_REFERER) {
        $path = $_SERVER["HTTP_REFERER"];
    } else {
        $path = get_url($path);
    }
    header("Location: {$path}");
    die();
}

function the_url($path)
{
    echo get_url($path);
}

function get_url($path)
{
    return BASE_CONTEXT_PATH . trim($path, "/"); // 両端に / がある時、消す
}

// 確か、id pwd のチェック
function is_alnum($val)
{
    return preg_match("/^[a-zA-Z0-9]+$/", $val);
}
// function is_alnum($val)
// {
//     $result = true;
//     if (!preg_match("/^[a-zA-Z0-9]+$/", $val)) {
//         $result = false;
//     }
//     return $result;
// }