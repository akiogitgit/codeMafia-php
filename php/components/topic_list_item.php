<?php

namespace components;

// 一個だけ表示する　aタグのとこはdetail editに飛ぶから、引数
function topic_list_item($topic, $url)
{
?>
    <div class="mt-[15px] flex flex-col justify-center">
        <div class="w-full mx-auto p-[25px] gap-[30px] flex items-center flex-col md:flex-row md:justify-between
                        bg-white rounded shadow-md shadow-gray-400/50 hover:shadow-lg hover:shadow-0 duration-300">
            <div>
                <h2 class="text-[30px]">

                    <h2 class="text-[30px]">
                        <?php if ($topic["published"]) : ?>
                            <span class="primary-btn text-[20px]">公開</span>
                        <?php else : ?>
                            <span class="danger-btn text-[20px]">非公開</span>
                        <?php endif; ?>
                        <!-- ここ上手くいく？ -->
                        <!-- <a href="<?php echo "edit?topic_id=" . $topic["id"]; ?>" class="text-gray-500 hover:underline hover:cursor-pointer"><?php echo $topic["title"]; ?></a> -->
                        <a href="<?php echo $url; ?>" class="text-gray-500 hover:underline hover:cursor-pointer"><?php echo $topic["title"]; ?></a>
                    </h2>
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
