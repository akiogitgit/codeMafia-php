<?php

namespace components;

// 一個だけ表示する　aタグのとこはdetail editに飛ぶから、引数
function topic_list_item($topic, $home)
{
?>
    <div class="mt-[15px] flex flex-col justify-center">
        <div class="w-full mx-auto p-[25px] gap-[50px] flex items-center flex-col md:flex-row md:justify-between
                        bg-white rounded shadow-md shadow-gray-400/50 hover:shadow-lg hover:shadow-0 duration-300">
            <div>
                <!-- ホームなら true(detailへ)  archiveなら false(editへ) -->
                <form action="<?php echo $home ? the_url("topic/detail") : the_url("topic/edit"); ?>" method="post">
                    <h2 class="text-[30px]">
                        <?php if ($topic["published"]) : ?>
                            <span class="primary-btn text-[20px] h-[40px] w-[100px] inline">公開</span>
                        <?php else : ?>
                            <span class="danger-btn text-[20px] h-[40px] w-[100px] inline">非公開</span>
                        <?php endif; ?>

                        <!-- <form action="<?php echo $home; ?>" method="post" class="inline"> -->
                        <input type="hidden" name="id" value="<?php echo $topic['id']; ?>">
                        <button type="submit" class="text-left text-gray-500 ml-[20px] inline hover:underline hover:cursor-pointer">
                            <?php echo $topic['title']; ?>
                        </button>
                        <!-- <span class="text-gray-500"><?php echo $topic["title"]; ?></span> -->
                    </h2>
                </form>
            </div>
            <div class="flex text-[40px] gap-[70px] justify-center">
                <div class="text-center "><?php echo $topic["views"]; ?>
                    <p class="text-[15px]">Views</p>
                </div>
                <div class="text-center text-cyan-400"><?php echo $topic["likes"]; ?>
                    <p class="text-[15px] w-[40px]">賛成</p>
                </div>

                <div class="text-center text-red-400"><?php echo $topic["dislikes"]; ?>
                    <p class="text-[15px] w-[40px]">反対</p>
                </div>
            </div>
        </div>
    </div>
<?php
}
