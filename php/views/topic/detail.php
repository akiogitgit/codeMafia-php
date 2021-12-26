<main class="text-gray-500">
    <div class="space-y-[15px] mt-[20px]">
        <div class="flex flex-col md:flex-row md:justify-between gap-[30px]">
            <!-- <div class="h-[400px] w-[400px] mr-[40px] bg-red-500 rounded-full"></div> -->
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
                        <!-- label のforに同じnameを入れると、ラベルタップでチェックつく -->
                        <div class="flex items-center">
                            <input type="radio" name="agree" id="agree" value="1">
                            <label class="w-[60px]" for="agree">賛成</label>
                            <input type="radio" name="disagree" id="disagree" value="0">
                            <label class="w-[60px]" for="disagree">反対</label>
                            <input class="primary-btn w-full" type="submit" value="送信">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <ul class="space-y-[20px]">
            <?php for ($i = 0; $i < 5; $i++) : ?>
                <li class="flex flex-col justify-center">
                    <div class="w-full mx-auto p-[25px] gap-[30px] flex items-center flex-col md:flex-row md:justify-between
                            bg-white rounded shadow-md shadow-gray-400/50 hover:shadow-lg hover:shadow-0 duration-300">
                        <div>
                            <h2 class="text-[30px]">
                                <a class="text-gray-500 hover:underline hover:cursor-pointer">犬も歩けば棒に当たりますか？</a>
                            </h2>
                        </div>
                        <div class="flex text-[40px] gap-[70px] justify-center">
                            <div class="text-center">25
                                <p class="text-[15px]">Views</p>
                            </div>
                            <div class="text-center text-cyan-400">25
                                <p class="text-[15px]">賛成</p>
                            </div>

                            <div class="text-center text-red-400">25
                                <p class="text-[15px]">反対</p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</main>