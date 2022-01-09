<?php

namespace view\edit;

function index($topic)
{

    //get でtopic_idを受け取り、送信で、UPdATEする。
?>
    <div class="space-y-[15px] mt-[20px]">
        <!--htmlセマンティック-->
        <h1 class="text-[30px] text-gray-500">トピックの編集</h1>
        <div class="flex flex-col justify-center gap-[20px]">
            <div class="bg-white w-full mx-auto p-[25px] rounded shadow-lg shadow-gray-400/50">
                <!-- <form class="flex flex-col gap-[20px]" action="<?php echo CURRENT_URI; ?>" method="post"> -->
                <form id="create-form" class="flex flex-col gap-[20px]" action="<?php echo the_url("topic/update"); ?>" method="post">
                    <div class="relative">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="タイトル">
                            タイトル
                        </label>
                        <input type="hidden" name="id" value="<?php echo $topic['id']; ?>">
                        <input type="text" name="title" id="input-create" value="<?php echo $topic['title']; ?>" autofocus required minlength="5" maxlength="30" class="py-2 pl-4 border border-gray-300 rounded shadow w-full appearance-none focus:outline-none focus:shadow-blue-500/50 focus:border-blue-500">
                        <div class="err-msg mt-[5px] text-red-500 text-[14px]"></div>
                        <div class="check-no absolute opacity-0 top-[37px] right-[5px] px-[10px] text-red-500 border border-2 border-red-500 rounded-full scale-[0.7]">!</div>
                        <div class="check-ok absolute opacity-0 top-[53px] right-[20px] scale-[1.5]">
                            <div class="w-[5px] h-[2px] bg-green-500 origin-right rotate-[60deg]"></div>
                            <div class="w-[12px] h-[2px] bg-green-500 origin-right rotate-[135deg] translate-x-[-7px] translate-y-[-1px]"></div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="ステータス">
                            ステータス
                        </label>
                        <select name="published" class="py-2 pl-4 text-[14px] border border-gray-300 rounded shadow w-full focus:outline-none focus:shadow-blue-500/70 focus:border-blue-500">
                            <!-- 公開＝1  -->
                            <?php if ($topic["published"]) : ?>
                                <option value="1" selected>公開</option>
                                <option value="0">非公開</option>
                            <?php else : ?>
                                <option value="1">公開</option>
                                <option value="0" selected>非公開</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="flex items-center space-x-[20px]">
                        <div>
                            <input type="submit" name="login" value="完了" class="primary-btn cursor-pointer">
                        </div>
                        <div>
                            <a href="<?php echo the_url("topic/archive"); ?>">戻る</a>
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

        <form action="<?php the_url('topic/delete'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $topic['id']; ?>">
            <button type="submit" class="danger-btn float-right mr-[25px] translate-y-[-75px]">削除</button>
        </form>
    </div>
    <script src="<?php echo BASE_CONTEXT_PATH ?>js/form-create.js"></script>
<?php
}
