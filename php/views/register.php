<main class="mt-[80px]">
    <!-- sr-onlyで表示されないけど、h1タグを置ける -->
    <h1 class="sr-only">登録</h1>
    <div class="flex flex-col justify-center gap-[20px]">
        <img src="./images/logo.svg" alt="みんなのアンケート ロゴ" class="h-[60px]">
        <div class="bg-white w-[300px] mx-auto p-[25px] rounded shadow-lg shadow-gray-400/50">
            <form class="flex flex-col gap-[20px]" action="<?php echo CURRENT_URI; ?>" method="post">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ユーザーID">
                        ユーザーID
                    </label>
                    <input type="text" name="id" id="" autofocus class="border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="パスワード">
                        パスワード
                    </label>
                    <input type="password" name="pwd" id="" class="border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="パスワード">
                        ニックネーム
                    </label>
                    <input type="text" name="nickname" id="" class="border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:border-blue-500">
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <a href="<?php the_url('login'); ?>">ログインへ</a>
                    </div>
                    <div>
                        <input type="submit" name="login" value="登録" class="py-[6px] px-[20px] rounded-md bg-blue-500 text-white cursor-pointer">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- 
<h1 class="text-[100px] text-green-200">registeer</h1>
<form action="" method="post">
    <div>
        id: <input type="text" name="id" id="" class="border border-black">
    </div>
    <div>
        pw: <input type="password" name="pwd" id="" class="border border-black">
    </div>
    <div>
        nickname: <input type="text" name="nickname" id="" class="border border-black">
    </div>
    <div>
        <input type="submit" value="登録" class="border border-black">
    </div>
</form> -->