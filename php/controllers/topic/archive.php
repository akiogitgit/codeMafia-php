<?php

namespace controller\topic\archive;

use model\UserModel;
use lib\Auth;

// ログインしてないと、エラーメッセージ
Auth::requireLogin();

function get()
{
    // UserModel で SESSION 情報をクラスとして取得
    $user = UserModel::getSession();
    $res = Auth::fetchByUserId($user->id);
    if ($res) {
        // echo "<pre>";
        // print_r($res);
        // echo "</pre>";
        // require_once SOURCE_BASE . "views/topic/archive.php";

        // これで過去の投稿を表示
        \view\topic\archive2\index($res);
    } else {
        echo '
        <main>
            <div class="space-y-[15px] mt-[20px]">
                <h1 class="text-[30px] text-gray-500">過去の投稿</h1>
                <div class="p-4 bg-indigo-100">トピックを投稿してみよう。</div>
            </div>
        </main>
        ';
    }
    // require_once SOURCE_BASE . "views/archive.php";
}
