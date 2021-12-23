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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@500&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-100">
    <div class="min-h-[100vh] overflow-hidden md:mx-auto w-[90%] max-w-[1500px]">
        <!-- <header class="w-full pt-[10px] container md:m-auto w-[90%]"> -->
        <header class="w-full pt-[10px]">
            <nav class="flex flex-col md:flex-row md:justify-between md:items-center">
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