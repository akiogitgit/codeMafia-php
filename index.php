<?php

// エラー表示あり
ini_set('display_errors', 1);

require_once("config.php");
// echo "index.php<br>";
// echo $_SERVER["REQUEST_URI"];


// ここのDBの使い方嫌い
// require_once(SOURCE_BASE . "db/datasource.php");
// require_once(SOURCE_BASE . "db/user.query.php");
// use db\UserQuery;
// $result = UserQuery::fetchById("test");
// var_dump($result);



// model
require_once(SOURCE_BASE . "models/abstract.model.php");
require_once(SOURCE_BASE . "models/user.model.php");
require_once(SOURCE_BASE . "models/topic.model.php");

// lib
require_once "libs/helper.php";
require_once "libs/auth.php";
require_once "libs/sql_operation.php";
require_once "libs/router.php";
require_once "libs/message.php";


// db
require_once "dbconnect.php";

// views
require_once SOURCE_BASE . "./components/topic_header_item.php";
require_once SOURCE_BASE . "./components/topic_list_item.php";
require_once SOURCE_BASE . "./components/topic_comment_list.php";

require_once SOURCE_BASE . "./views/topic/archive2.php";
require_once SOURCE_BASE . "./views/topic/detail.php";
require_once SOURCE_BASE . "./views/topic/create.php";
require_once SOURCE_BASE . "./views/topic/edit.php";
require_once SOURCE_BASE . "./views/home2.php";

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

    // getか、post を小文字で取得
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
