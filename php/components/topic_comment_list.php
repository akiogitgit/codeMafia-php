<?php

namespace components;

function topic_comment_list($topic)
{
    $topic = escape($topic);
?>
    <?php foreach ($topic as $r) : ?>
        <div class="mt-[15px] flex flex-col">
            <div class="w-full p-[25px] gap-[3px] flex flex-col
                        bg-white rounded shadow-md shadow-gray-400/50 hover:shadow-lg hover:shadow-0 duration-300">
                <div>
                    <h2 class="text-[30px]">
                        <?php if ($r["agree"]) : ?>
                            <span class="primary-btn text-[20px]">賛成</span>
                        <?php else : ?>
                            <span class="danger-btn text-[20px]">反対</span>
                        <?php endif; ?>
                        <!-- ここ上手くいく？ -->
                        <span class="text-gray-500"><?php echo $r["body"]; ?></span>
                    </h2>
                </div>
                <div class="text-gray-400">
                    Commented by <?php echo $r["nickname"]; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php
}
