<?php

// urlが/php/codeMafia/php-mysql/appWeb/login　の時
// 共通の/php/codeMafia/php-mysql/appWeb/だけを取得する
define("CURRENT_URI", $_SERVER["REQUEST_URI"]);
if (preg_match("/(.+(appWeb))/i", CURRENT_URI, $match)) {
    define("BASE_CONTEXT_PATH", $match[0] . "/");
    // echo "context: " . BASE_CONTEXT_PATH . "<br>";
    // echo "img: " . BASE_IMAGE_PATH;
}

define("BASE_IMAGE_PATH", BASE_CONTEXT_PATH . "images/");
define("SOURCE_BASE", __DIR__ . "/php/");
// echo "<br>source base:  " . SOURCE_BASE;

define("GO_HOME", "home");
define("GO_REFERER", "referer");