<?php

namespace components;

use lib\Auth;

function topic_header_item($topic, $home)
{
    if (!isset($_SESSION["comment"]["body"])) {
        $_SESSION["comment"]["body"] = "";
    }
    if (!isset($_SESSION["comment"]["opinion"])) {
        $_SESSION["comment"]["opinion"] = null;
    }
?>
    <div class="mt-[20px] flex flex-col md:flex-row md:justify-between gap-[30px]">
        <!-- <div class="h-[400px] w-[400px] mr-[40px] bg-red-500 rounded-full"></div> -->
        <canvas width="400" height="400" data-likes="3" data-dislikes="2" style="background-color: gray;"></canvas>
        <div>
            <!-- ホームから来たかどうか -->
            <?php if ($home) : ?>
                <form action="<?php echo the_url("topic/detail"); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $topic['id']; ?>">
                    <!-- <input type="submit" value="<?php echo $topic['title']; ?>" class="w-[200px] text-[40px] text-gray-500 block hover:underline hover:cursor-pointer"> -->
                    <button class="text-left text-[40px] text-gray-500 block hover:underline hover:cursor-pointer" type="submit"><?php echo $topic["title"]; ?></button>
                </form>
            <?php else : ?>
                <span class="text-[40px] text-gray-500 block"><?php echo $topic["title"] ?></span>
            <?php endif; ?>
            <!-- innerjoin して表示する -->
            <span class="">Posted by <?php echo $topic["nickname"]; ?> • <?php echo $topic["views"] ?> views</span>
            <div class="text-[90px] flex gap-[50px] justify-around">
                <div class="text-center text-cyan-400"><?php echo $topic["likes"]; ?>
                    <p class="text-[15px]">賛成</p>
                </div>
                <div class="text-center text-red-400"><?php echo $topic["dislikes"]; ?>
                    <p class="text-[15px]">反対</p>
                </div>
            </div>
            <div class="mt-[30px]">
                <?php if (Auth::isLogin()) : ?>

                    <form action="<?php echo the_url("topic/push_comment"); ?>" method="post">
                        <span class="text-[25px]">あなたは賛成？それとも反対？</span>
                        <div>
                            <textarea class="w-full" name="body" id="body" rows="5"><?php echo $_SESSION["comment"]["body"]; ?></textarea>
                        </div>
                        <!-- label for は、idと同じもの  nameを揃えて、idとvalueを変える-->
                        <div class="flex items-center">

                            <!-- 成功した後、checked 消えない -->
                            <input type="radio" name="opinion" id="agree" value="1" <?php echo $_SESSION["comment"]["opinion"] == 1 ? "checked" : ""; ?>>
                            <label class="w-[60px]" for="agree">賛成</label>
                            <input type="radio" name="opinion" id="disagree" value="0" <?php echo $_SESSION["comment"]["opinion"] == 0 ? "checked" : ""; ?>>
                            <label class="w-[60px]" for="disagree">反対</label>

                            <!-- <input type="radio" name="opinion" id="agree" value="1" <?php echo "checked"; ?>>
                            <label class="w-[60px]" for="agree">賛成</label>
                            <input type="radio" name="opinion" id="disagree" value="0">
                            <label class="w-[60px]" for="disagree">反対</label> -->

                            <input type="hidden" name="id" value="<?php echo $topic['id']; ?>">
                            <input type="hidden" name="url" value="<?php echo CURRENT_URI; ?>">
                            <button class="primary-btn w-full" type="submit">
                                送信
                            </button>
                        </div>
                    </form>

                <?php else : ?>
                    <div class="text-center">
                        <p class="mb-[20px]">ログインしてアンケートに参加しよう。</p>
                        <a href="<?php the_url("login"); ?>" class="primary-btn">ログインはこちら！</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- <div class="flex flex-col md:flex-row md:justify-between gap-[30px]">
        <canvas width="400" height="400" data-likes="3" data-dislikes="2" style="background-color: gray;"></canvas>
        <div>
            <h1 class="text-[40px] text-gray-500">たこ焼きっておいしいですよね。</h1>
            <span class="">Posted by テストユーザー • 26 views</span>
            <div class="text-[90px] flex gap-[50px] justify-around">
                <div class="text-center text-cyan-400">2
                    <p class="text-[15px]">賛成</p>
                </div>
                <div class="text-center text-red-400">3
                    <p class="text-[15px]">反対</p>
                </div>
            </div>
            <div>
                <form action="" class="mt-[30px]">
                    <span class="text-[25px]">あなたは賛成？それとも反対？</span>
                    <div>
                        <textarea class="w-full" name="body" id="body" rows="5"></textarea>
                    </div>
    <div class="flex items-center">
        <input type="radio" name="opinion" id="agree" value="1">
        <label class="w-[60px]" for="agree">賛成</label>
        <input type="radio" name="opinion" id="disagree" value="0">
        <label class="w-[60px]" for="disagree">反対</label>
        <input class="primary-btn w-full" type="submit" value="送信">
    </div>
    </form>
    </div>
    </div>
    </div> -->

<?php
}
