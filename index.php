<?php

// エラー表示あり
ini_set('display_errors', 1);

require_once("config.php");
// echo "index.php<br>";
// echo $_SERVER["REQUEST_URI"];


// クラスは使わないでやってみる
// require_once(SOURCE_BASE . "db/datasource.php");
// require_once(SOURCE_BASE . "db/user.query.php");
// use db\UserQuery;
// $result = UserQuery::fetchById("test");
// var_dump($result);
require_once "libs/helper.php";
require_once "libs/auth.php";
require_once "libs/router.php";

require_once(SOURCE_BASE . "models/abstract.model.php");
require_once "libs/message.php";
require_once(SOURCE_BASE . "models/user.model.php");

require_once "dbconnect.php";

use function lib\route;

session_start();


// $db = dbconnect();
// $res = $db->query("select * from users;");
// $res = $db->query("select * from users where id = 'test';");
// foreach ($res as $r) {
//     echo "<br>id: " . $r["id"];
//     echo "<br>pwd: " . $r["pwd"];
//     echo "<br>nickname: " . $r["nickname"];
// }

try {
    require_once(SOURCE_BASE . "./components/header.php");

    // rpath は、login register homeの部分だけを抽出する。
    //                     検索文字列　　　　置換　対象文字列
    $rpath = str_replace(BASE_CONTEXT_PATH, "", CURRENT_URI);
    // $_SERVERは、全てのURL、BASE_は/appacheの先がないURL　つまり、残りの部分を rpathに格納

    // method を小文字で取得
    $method = strtolower($_SERVER["REQUEST_METHOD"]);
    // echo "method: " . $method;


    route($rpath, $method);


    // ださいから、上のに変更
    // if ($_SERVER["REQUEST_URI"] === "/php/codeMafia/php-mysql/appWeb/login") {
    //     require_once SOURCE_BASE . "controllers/login.php";
    // } else if ...

    require_once SOURCE_BASE . "./components/footer.php";
} catch (Throwable $e) {
    die("<h1>何かがおかしいです index.php</h1>");
}