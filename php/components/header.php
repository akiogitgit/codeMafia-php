<?php
// require("config.php");

use db\DataSource;
use lib\Auth;
use lib\Msg;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>みんなのアンケート</title>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="//fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@700&display=swap" rel="stylesheet">

    <style type="text/tailwindcss">
        .primary-btn {
            @apply py-[6px] px-[20px] rounded-md bg-blue-500 text-white inline;
        }
        .danger-btn {
            @apply py-[6px] px-[20px] rounded-md bg-red-500 text-white inline;
        }
        .font-m1{
            font-family: 'M PLUS Rounded 1c', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 font-m1">
    <div class="min-h-[100vh] overflow- mx-auto w-[90%] md:w-[80%] max-w-[1200px]">
        <!-- <header class="w-full pt-[10px] container md:m-auto w-[90%]"> -->
        <header class="w-full pt-[10px]">
            <nav class="flex flex-col md:flex-row md:justify-between md:items-center">
                <a href="<?php the_url("/"); ?>" class="flex mb-[15px] md:mb-0">
                    <!-- <img src="./images/logo.svg" alt="みんなのアンケート　ロゴ" class="h-[50px]"> -->
                    <img src="<?php echo BASE_CONTEXT_PATH ?>images/logo.svg" alt="みんなのアンケート　ロゴ" class="h-[50px]">
                    <span class="text-[green] ml-[20px] text-[30px] font-m1">みんなのアンケート</span>
                </a>
                <div class="flex h-[38px] gap-[10px]">
                    <?php if (Auth::isLogin()) : ?>
                        <a href="<?php the_url("topic/create"); ?>" class="primary-btn">投稿</a>
                        <a href="<?php the_url("topic/archive"); ?>" class="mt-[6px] cursor-pointer">過去の投稿</a>
                        <a href="<?php the_url("logout"); ?>" class="mt-[6px] cursor-pointer">ログアウト</a>
                    <?php else : ?>
                        <a href="<?php the_url("register"); ?>" class="py-[6px] px-[20px] rounded-md bg-blue-500 text-white cursor-pointer">登録</a>
                        <a href="<?php the_url("login"); ?>" class="mt-[6px] cursor-pointer">ログイン</a>
                    <?php endif; ?>
                </div>
            </nav>
        </header>
        <main class="overflow-hidden">
            <?php
            // ここで、全ての pushを表示！
            Msg::flush();
    // if (Auth::isLogin()) {
    //     echo "ログイン中<br>";
    // } else {
    //     echo "ログインしてない！<br>";
    // }