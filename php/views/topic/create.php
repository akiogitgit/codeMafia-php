<div class="space-y-[15px] mt-[20px]">
    <!--htmlセマンティック-->
    <h1 class="text-[30px] text-gray-500">トピック作成</h1>
    <div class="flex flex-col justify-center gap-[20px]">
        <div class="bg-white w-full mx-auto p-[25px] rounded shadow-lg shadow-gray-400/50">
            <form class="flex flex-col gap-[20px]" action="<?php echo CURRENT_URI; ?>" method="post">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="タイトル">
                        タイトル
                    </label>
                    <input type="text" name="id" id="" autofocus class="py-2 pl-4 border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:shadow-blue-500/50 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ステータス">
                        ステータス
                    </label>
                    <select name="example" class="py-2 pl-4 text-[14px] border border-gray-300 rounded shadow w-full focus:outline-none focus:shadow-blue-500/70 focus:border-blue-500">
                        <option value="0" selected>公開</option>
                        <option value="1">非公開</option>
                    </select>
                </div>
                <div class="flex items-center space-x-[20px]">
                    <div>
                        <input type="submit" name="login" value="送信" class="py-[6px] px-[20px] rounded-md bg-blue-500 text-white">
                    </div>
                    <div>
                        <a href="">戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>