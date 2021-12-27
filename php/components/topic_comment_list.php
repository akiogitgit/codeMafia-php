<?php

namespace components;

function topic_comment_list($topic)
{
?>
    <?php foreach ($topic as $r) : ?>
        <div class="mt-[15px] flex flex-col justify-center">
            <div class="w-full mx-auto p-[25px] gap-[30px] flex items-center flex-col md:flex-row md:justify-between
                        bg-white rounded shadow-md shadow-gray-400/50 hover:shadow-lg hover:shadow-0 duration-300">
                <div>
                    <h2 class="text-[30px]">

                        <h2 class="text-[30px]">
                            <?php if ($r["published"]) : ?>
                                <span class="primary-btn text-[20px]">公開</span>
                            <?php else : ?>
                                <span class="danger-btn text-[20px]">非公開</span>
                            <?php endif; ?>
                            <!-- ここ上手くいく？ -->
                            <!-- <a href="<?php echo "edit?topic_id=" . $r["id"]; ?>" class="text-gray-500 hover:underline hover:cursor-pointer"><?php echo $r["title"]; ?></a> -->
                            <a href="<?php echo BASE_CONTEXT_PATH . "topic/edit?topic_id=" . $r["id"]; ?>" class="text-gray-500 hover:underline hover:cursor-pointer"><?php echo $r["title"]; ?></a>
                        </h2>
                </div>
                <div class="flex text-[40px] gap-[70px] justify-center">
                    <div class="text-center "><?php echo $r["views"]; ?>
                        <p class="text-[15px]">Views</p>
                    </div>
                    <div class="text-center text-cyan-400"><?php echo $r["likes"]; ?>
                        <p class="text-[15px] w-[40px]">賛成</p>
                    </div>

                    <div class="text-center text-red-400"><?php echo $r["dislikes"]; ?>
                        <p class="text-[15px] w-[40px]">反対</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php
}
