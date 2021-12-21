<?php
// require("config.php");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>みんなのアンケート</title>
</head>

<body>
    <h1 class="text-[50px] text-red-600">heeader</h1>
    <?php

    use lib\Auth;
    use lib\Msg;

    Msg::flush();
    // Msg::clearSession();
    if (Auth::isLogin()) {
        echo "ログイン中<br>";
    } else {
        echo "ログインしてない！<br>";
    }