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
    <header class="w-full mt-[10px]">
        <nav class="flex flex-col md:flex-row md:justify-between container md:m-auto md:items-center">
            <a href="" class="flex ml-[20px] mb-[15px] md:mb-0">
                <img src="./images/logo.svg" alt="みんなのアンケート　ロゴ" class="h-[50px]">
                <span class="text-[green] text-[35px] font-bold">みんなのアンケート</span>
            </a>
            <div class="flex h-[38px] ml-[20px] gap-[10px]">
                <a class="py-[6px] px-[20px] rounded-md bg-blue-500 text-white font-bold">登録</a>
                <a class="mt-[6px]">ログイン</a>
            </div>
        </nav>
    </header>
    <?php

    use lib\Auth;
    use lib\Msg;

    // ここで、全ての pushを表示！
    Msg::flush();
    // if (Auth::isLogin()) {
    //     echo "ログイン中<br>";
    // } else {
    //     echo "ログインしてない！<br>";
    // }