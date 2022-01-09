<main class="mt-[80px]">
    <!-- sr-onlyで表示されないけど、h1タグを置ける -->
    <h1 class="sr-only">ログイン</h1>
    <div class="flex flex-col justify-center gap-[20px]">
        <img src="./images/logo.svg" alt="みんなのアンケート ロゴ" class="h-[60px]">
        <div class="bg-white w-[300px] mx-auto p-[25px] rounded shadow-lg shadow-gray-400/50">

            <form class="validate-form flex flex-col gap-[20px]" action="<?php echo CURRENT_URI; ?>" method="post" autocomplete="off" novalidate>
                <!-- atutocomplete="off"で補完なし novalidateでdefaultの注意がなくなる(maxlengthとかの)-->
                <div class="relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ユーザーID">
                        ユーザーID
                    </label>
                    <input type="text" name="id" autofocus required minlength="4" maxlength="20" tabindex="1" pattern="[a-zA-Z0-9]+" class="validate-target border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:border-blue-500">
                    <div class="err-msg mt-[5px] text-red-500 text-[10px]"></div>
                    <div class="check-no absolute opacity-0 top-[27px] right-[5px] px-[10px] text-red-500 border border-2 border-red-500 rounded-full scale-[0.5]">!</div>
                    <div class="check-ok absolute opacity-0 top-[44px] right-[10px]">
                        <div class="w-[5px] h-[2px] bg-green-500 origin-right rotate-[60deg]"></div>
                        <div class="w-[12px] h-[2px] bg-green-500 origin-right rotate-[135deg] translate-x-[-7px] translate-y-[-1px]"></div>
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="パスワード">
                        パスワード
                    </label>
                    <input type="password" name="pwd" required minlength="4" maxlength="20" tabindex="2" pattern="[a-zA-Z0-9]+" class="validate-target border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:border-blue-500">

                    <div class="err-msg mt-[5px] text-red-500 text-[10px]"></div>
                    <div class="check-no absolute opacity-0 top-[27px] right-[5px] px-[10px] text-red-500 border border-2 border-red-500 rounded-full scale-[0.5]">!</div>
                    <div class="check-ok absolute opacity-0 top-[44px] right-[10px]">
                        <div class="w-[5px] h-[2px] bg-green-500 origin-right rotate-[60deg]"></div>
                        <div class="w-[12px] h-[2px] bg-green-500 origin-right rotate-[135deg] translate-x-[-7px] translate-y-[-1px]"></div>
                    </div>
                </div>


                <div class="flex justify-between items-center">
                    <div>
                        <a href="<?php the_url("register"); ?>">アカウント登録</a>
                    </div>
                    <div>
                        <input type="submit" name="login" value="ログイン" tabindex="3" disabled class="py-[6px] px-[20px] rounded-md bg-blue-500 text-white cursor-pointer">
                    </div>
                </div>

                <style>
                    .is-valid {
                        border: 2px double skyblue;
                    }

                    .is-valid:focus {
                        border: 2px double skyblue;
                    }

                    .is-invalid {
                        border: 2px double red;
                    }

                    .is-invalid:focus {
                        border: 2px double red;
                    }

                    .is-valid~.check-ok {
                        opacity: 1;
                    }

                    .is-invalid~.check-no {
                        opacity: 1;
                    }

                    input[type="submit"]:disabled {
                        opacity: 0.5;
                    }
                </style>
            </form>
        </div>
    </div>
    <script src="<?php echo BASE_CONTEXT_PATH ?>js/form-validate.js"></script>
</main>