<!-- <img src="./images/logo.svg" alt=""> -->
<h1 class="text-[100px] text-green-200">registeer</h1>
<form action="<?php echo CURRENT_URI; ?>" method="post">
    <div>
        id: <input type="text" name="id" id="" class="border border-black">
    </div>
    <div>
        pw: <input type="password" name="pwd" id="" class="border border-black">
    </div>
    <div>
        nickname: <input type="text" name="nickname" id="" class="border border-black">
    </div>
    <div>
        <input type="submit" value="登録" class="border border-black">
    </div>
</form>