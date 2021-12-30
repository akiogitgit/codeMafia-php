<?php

namespace view\topic\archive2;
// controll から、投稿の配列が渡る。
function index($topics)
{
?>
    <div class="space-y-[15px] mt-[20px]">
        <h1 class="text-[30px] text-gray-500">過去の投稿</h1>
        <div class="space-y-[20px]">
            <?php
            // 配列を全表示
            foreach ($topics as $topic) {
                // $url = get_url("topic/edit?topic_id=" . $topic["id"]);

                //                       archiveから来たからfalse
                \components\topic_list_item($topic, false);
            }
            ?>

        </div>
    </div>
<?php
}
